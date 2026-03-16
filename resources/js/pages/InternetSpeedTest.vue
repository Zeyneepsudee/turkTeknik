<script setup lang="ts">
/**
 * SpeedTest.vue — Paralel stream throughput ölçümü
 *
 * Ookla'nın yöntemi:
 *  - Aynı anda N paralel TCP bağlantısı açılır
 *  - Tüm stream'lerden gelen byte'lar tek sayaçta toplanır
 *  - Toplam byte / geçen süre = gerçek throughput
 *  - Düşük hızda az stream, yüksek hızda çok stream (adaptif)
 *
 * Bu bileşen:
 *  - Download: speed.cloudflare.com'dan paralel fetch, SharedArrayBuffer
 *    yerine closure üzerinden byte sayacı
 *  - Upload:   paralel POST istekleri
 *  - Ping:     8× HEAD → trimmed RTT
 *  - Süre:     download 12s, upload 10s (Ookla gibi)
 */

import { ref, onUnmounted } from 'vue'
import { Link } from '@inertiajs/vue3'
import AppLayout from '@/layouts/AppLayout.vue'
import SEO from '@/components/SEO.vue'

defineOptions({ layout: AppLayout })

type Phase = 'idle' | 'ping' | 'download' | 'upload' | 'done' | 'error'
type Tier  = 'fiber-1g' | 'fiber-100' | 'vdsl' | 'adsl' | 'low'

interface TestResult {
  download:  number
  upload:    number
  ping:      number
  jitter:    number
  tier:      Tier
  uploadEst: boolean
}

/* ── CDN ── */
const CF_DOWN = (bytes: number) =>
  `https://speed.cloudflare.com/__down?bytes=${bytes}&nocache=${Math.random()}`
const CF_UP   = 'https://speed.cloudflare.com/__up'
const CF_PING = 'https://speed.cloudflare.com/__down?bytes=0'

/* ── Adaptif ayarlar ── */
function streamConfig(mbps: number): { streams: number; chunkBytes: number } {
  // Ookla gibi: düşük hızda az stream + küçük chunk, yüksek hızda çok stream + büyük chunk
  if (mbps < 10)  return { streams: 2,  chunkBytes: 1   * 1024 * 1024 }
  if (mbps < 40)  return { streams: 4,  chunkBytes: 4   * 1024 * 1024 }
  if (mbps < 150) return { streams: 6,  chunkBytes: 10  * 1024 * 1024 }
  if (mbps < 500) return { streams: 8,  chunkBytes: 25  * 1024 * 1024 }
  return              { streams: 16, chunkBytes: 50  * 1024 * 1024 }
}

function getTier(dl: number): Tier {
  if (dl >= 450) return 'fiber-1g'
  if (dl >= 70)  return 'fiber-100'
  if (dl >= 20)  return 'vdsl'
  if (dl >= 4)   return 'adsl'
  return 'low'
}

function trimmedMean(arr: number[], pct = 0.2): number {
  if (!arr.length) return 0
  const s   = [...arr].sort((a, b) => a - b)
  const cut = Math.floor(s.length * pct)
  const k   = s.slice(cut, s.length - cut || undefined)
  return k.reduce((a, v) => a + v, 0) / k.length
}

/* ── State ── */
const phase         = ref<Phase>('idle')
const currentSpeed  = ref(0)
const statusText    = ref('Teste başlamak için butona tıklayın')
const liveLabel     = ref('')
const pingActive    = ref(false)
const pingPacketPos = ref(0)
const result        = ref<TestResult | null>(null)
const errorMsg      = ref('')

const dlVal      = ref<number | null>(null)
const ulVal      = ref<number | null>(null)
const pingVal    = ref<number | null>(null)
const jitterVal  = ref<number | null>(null)

/* ── Gauge ── */
const MAX_SPEED = 1000
const ARC_LEN   = 345.6
const needleDeg = ref(-90)
const arcOffset = ref(ARC_LEN)

let _rafId: number | null = null
let _targetMbps = 0
let _currentMbps = 0

function setNeedle(speed: number) {
  const pct       = Math.min(Math.log(Math.max(speed,0) + 1) / Math.log(MAX_SPEED + 1), 1)
  needleDeg.value = -90 + pct * 180
  arcOffset.value  = ARC_LEN * (1 - pct)
  currentSpeed.value = Math.round(speed)
  _currentMbps = speed
}

function animateTo(target: number) {
  _targetMbps = target
  if (_rafId) cancelAnimationFrame(_rafId)
  const step = () => {
    const diff = _targetMbps - _currentMbps
    if (Math.abs(diff) < 0.5) { setNeedle(_targetMbps); return }
    setNeedle(_currentMbps + diff * 0.15)
    _rafId = requestAnimationFrame(step)
  }
  _rafId = requestAnimationFrame(step)
}

/* ── Ping anim ── */
let _pingTimer: ReturnType<typeof setInterval> | null = null
function startPingAnim() { pingActive.value = true; _pingTimer = setInterval(() => { pingPacketPos.value = pingPacketPos.value === 0 ? 100 : 0 }, 400) }
function stopPingAnim()  { pingActive.value = false; if (_pingTimer) clearInterval(_pingTimer) }

const delay = (ms: number) => new Promise<void>(r => setTimeout(r, ms))

let abortCtrl: AbortController | null = null

/* ─────────────────────────────────────────
   PING
───────────────────────────────────────── */
async function measurePing() {
  const rtts: number[] = []
  for (let i = 0; i < 8; i++) {
    const t0 = performance.now()
    try { await fetch(CF_PING, { method: 'HEAD', cache: 'no-store' }) } catch { /* */ }
    rtts.push(performance.now() - t0)
    await delay(60)
  }
  rtts.sort((a, b) => a - b)
  const best   = rtts.slice(0, 5)
  const ping   = best.reduce((s, v) => s + v, 0) / best.length
  const jitter = rtts[4] - rtts[0]
  return { ping, jitter }
}

/* ─────────────────────────────────────────
   DOWNLOAD — paralel fetch streams
───────────────────────────────────────── */
async function measureDownload(
  onSample: (mbps: number) => void,
  durationMs = 12000
): Promise<number> {
  const samples: number[] = []
  const startMs = Date.now()

  // Önce tek stream ile hızı tahmin et (ilk 2 sn)
  let probeBytes = 0
  const probeStart = performance.now()
  try {
    const res    = await fetch(CF_DOWN(5 * 1024 * 1024), { cache: 'no-store' })
    const reader = res.body!.getReader()
    while (true) {
      const { done, value } = await reader.read()
      if (done) break
      probeBytes += value.byteLength
      const t = (performance.now() - probeStart) / 1000
      if (t > 0) onSample((probeBytes * 8) / (t * 1e6))
    }
  } catch { /* */ }
  const probeTime = (performance.now() - probeStart) / 1000
  const probeMbps = probeTime > 0 ? (probeBytes * 8) / (probeTime * 1e6) : 10
  samples.push(probeMbps)

  if (Date.now() - startMs > durationMs) return trimmedMean(samples)

  // Asıl paralel ölçüm
  const { streams, chunkBytes } = streamConfig(probeMbps)
  abortCtrl = new AbortController()
  const signal = abortCtrl.signal

  // Paylaşılan byte/zaman sayacı
  let totalBytes = 0
  const phaseStart = performance.now()

  // Ticker: her 200ms'de anlık Mbps hesapla
  const ticker = setInterval(() => {
    const elapsed = (performance.now() - phaseStart) / 1000
    if (elapsed > 0) {
      const mbps = (totalBytes * 8) / (elapsed * 1e6)
      samples.push(mbps)
      onSample(mbps)
    }
  }, 200)

  // Paralel stream worker'ı
  async function streamWorker() {
    while (!signal.aborted && Date.now() - startMs < durationMs) {
      try {
        const res    = await fetch(CF_DOWN(chunkBytes), { cache: 'no-store', signal })
        const reader = res.body!.getReader()
        while (true) {
          const { done, value } = await reader.read()
          if (done || signal.aborted) break
          totalBytes += value.byteLength
        }
      } catch { break }
    }
  }

  await Promise.all(Array.from({ length: streams }, streamWorker))
  clearInterval(ticker)
  abortCtrl.abort()

  // Son ölçüm
  const finalElapsed = (performance.now() - phaseStart) / 1000
  if (finalElapsed > 0) samples.push((totalBytes * 8) / (finalElapsed * 1e6))

  return trimmedMean(samples)
}

/* ─────────────────────────────────────────
   UPLOAD — paralel POST streams
───────────────────────────────────────── */
async function measureUpload(
  onSample: (mbps: number) => void,
  downloadMbps: number,
  durationMs = 10000
): Promise<{ value: number; estimated: boolean }> {
  const samples: number[] = []
  const startMs  = Date.now()
  const { streams, chunkBytes: ulChunk } = streamConfig(downloadMbps)

  // Upload chunk boyutu download'dan biraz küçük
  const uploadBytes = Math.min(ulChunk, 8 * 1024 * 1024)

  // Rastgele byte (sıkıştırma engeli)
  const buf = new Uint8Array(uploadBytes)
  for (let i = 0; i < Math.min(uploadBytes, 65536); i++) buf[i] = Math.random() * 256 | 0
  const blob = new Blob([buf])

  abortCtrl = new AbortController()
  const signal = abortCtrl.signal

  let totalBytes = 0
  const phaseStart = performance.now()
  let worked = false

  const ticker = setInterval(() => {
    const elapsed = (performance.now() - phaseStart) / 1000
    if (elapsed > 0 && totalBytes > 0) {
      const mbps = (totalBytes * 8) / (elapsed * 1e6)
      samples.push(mbps)
      onSample(mbps)
      worked = true
    }
  }, 200)

  async function uploadWorker() {
    while (!signal.aborted && Date.now() - startMs < durationMs) {
      const t0 = performance.now()
      try {
        await fetch(CF_UP, {
          method: 'POST', body: blob, cache: 'no-store', signal,
          // @ts-expect-error — duplex gerekli bazı tarayıcılarda
          duplex: 'half',
        })
        const elapsed = (performance.now() - t0) / 1000
        if (elapsed > 0.05) totalBytes += uploadBytes
      } catch { break }
    }
  }

  await Promise.all(Array.from({ length: Math.min(streams, 8) }, uploadWorker))
  clearInterval(ticker)
  abortCtrl.abort()

  if (samples.length >= 2 && worked) {
    return { value: trimmedMean(samples), estimated: false }
  }

  // Fallback tahmin
  const est = downloadMbps * (downloadMbps >= 450 ? 0.48 : downloadMbps >= 70 ? 0.44 : 0.38)
  return { value: est, estimated: true }
}

/* ─────────────────────────────────────────
   ANA TEST AKIŞI
───────────────────────────────────────── */
async function startTest() {
  if (!['idle','done','error'].includes(phase.value)) return

  result.value    = null
  dlVal.value     = null
  ulVal.value     = null
  pingVal.value   = null
  jitterVal.value = null
  errorMsg.value  = ''
  liveLabel.value = ''
  animateTo(0)

  try {
    // Ping
    phase.value      = 'ping'
    statusText.value = 'Sunucuya bağlanıyor...'
    startPingAnim()
    await delay(200)
    statusText.value = 'Ping ölçülüyor...'
    const { ping, jitter } = await measurePing()
    stopPingAnim()
    pingVal.value   = parseFloat(ping.toFixed(1))
    jitterVal.value = parseFloat(jitter.toFixed(1))
    liveLabel.value = `Ping: ${pingVal.value} ms  •  Jitter: ${jitterVal.value} ms`
    await delay(300)

    // Download
    phase.value      = 'download'
    statusText.value = 'İndirme hızı ölçülüyor...'
    liveLabel.value  = '↓ Başlatılıyor...'
    startPingAnim()
    animateTo(0)

    const dl = await measureDownload((mbps) => {
      animateTo(mbps)
      liveLabel.value = `↓ ${mbps.toFixed(1)} Mbps`
    }, 12000)

    stopPingAnim()
    dlVal.value = parseFloat(dl.toFixed(1))
    liveLabel.value = `↓ ${dlVal.value} Mbps — tamamlandı`
    animateTo(0)
    await delay(500)

    // Upload
    phase.value      = 'upload'
    statusText.value = 'Yükleme hızı ölçülüyor...'
    liveLabel.value  = '↑ Başlatılıyor...'
    startPingAnim()
    animateTo(0)

    const { value: ul, estimated } = await measureUpload((mbps) => {
      animateTo(mbps)
      liveLabel.value = `↑ ${mbps.toFixed(1)} Mbps`
    }, dl, 10000)

    stopPingAnim()
    ulVal.value = parseFloat(ul.toFixed(1))
    liveLabel.value = estimated
      ? `↑ ~${ulVal.value} Mbps (tahmini)`
      : `↑ ${ulVal.value} Mbps — tamamlandı`
    animateTo(0)

    // Done
    phase.value      = 'done'
    statusText.value = 'Test tamamlandı'

    result.value = {
      download:  dlVal.value!,
      upload:    ulVal.value!,
      ping:      pingVal.value!,
      jitter:    jitterVal.value!,
      tier:      getTier(dlVal.value!),
      uploadEst: estimated,
    }

  } catch {
    stopPingAnim()
    animateTo(0)
    phase.value      = 'error'
    errorMsg.value   = 'Bağlantı hatası. İnternet erişiminizi kontrol edin.'
    statusText.value = 'Hata'
  }
}

/* ── Tier metadata ── */
const tierMeta: Record<Tier, { label: string; color: string; bg: string; emoji: string; desc: string }> = {
  'fiber-1g':  { label: 'Gigabit Fiber',  color: '#16a34a', bg: 'rgba(22, 163, 74, 0.1)', emoji: '🚀', desc: 'Gigabit bağlantı tespit edildi. 4K/8K akış, 50+ eş zamanlı cihaz ve büyük bulut yedeklemeleri için ideal.' },
  'fiber-100': { label: 'Fiber 100 Mbps', color: '#2563eb', bg: 'rgba(37, 99, 235, 0.1)', emoji: '⚡', desc: '100 Mbps fiber altyapısı tespit edildi. Tüm ev cihazları için HD/4K yayın ve video konferans sorunsuz çalışır.' },
  'vdsl':      { label: 'VDSL',           color: '#7c3aed', bg: 'rgba(124, 58, 237, 0.1)', emoji: '📶', desc: 'Orta hız VDSL bağlantısı. Günlük kullanım ve HD yayın için yeterli; çok kullanıcılı 4K içerikte kısıtlama görülebilir.' },
  'adsl':      { label: 'ADSL',           color: '#d97706', bg: 'rgba(217, 119, 6, 0.1)', emoji: '📡', desc: 'Temel internet kullanımı için yeterli. Video konferans ve HD yayın zaman zaman takılabilir. Fiber geçişini değerlendirin.' },
  'low':       { label: 'Düşük Hız',      color: '#dc2626', bg: 'rgba(220, 38, 38, 0.1)', emoji: '⚠️', desc: 'Bağlantı hızınız çok düşük. Sayfa yüklenmeleri ve video akışlarında ciddi sorunlar yaşanabilir. Teknik destek alın.' },
}

const getRating = (t: Tier) => tierMeta[t]
const barPct    = (v: number, max: number) => Math.min((v / max) * 100, 100).toFixed(1) + '%'

onUnmounted(() => {
  if (_rafId) cancelAnimationFrame(_rafId)
  stopPingAnim()
  abortCtrl?.abort()
})
</script>

<template>
  <SEO
    title="İnternet Hız Testi - Fiber, ADSL, VDSL Hızını Ölç | TürkTeknik"
    description="Paralel stream (Ookla yöntemi) ile en doğru internet hız testi. İndirme, yükleme, ping ve jitter değerlerinizi saniyeler içinde ölçün. Altyapı analizi ve teknik destek için tıklayın."
    url="https://turkteknik.com.tr/internet-hiz-testi"
    keywords="hız testi, internet hız testi, speed test, fiber hız testi, türk teknik"
  />

  <section class="min-h-screen bg-[#020b18] py-20 px-4">
    <div class="max-w-2xl mx-auto">

      <!-- Header -->
      <div class="text-center mb-12">
        <span class="inline-flex items-center gap-2 bg-blue-500/10 border border-blue-500/20 text-blue-400 text-xs font-semibold px-4 py-1.5 rounded-full mb-4 uppercase tracking-wider">
          <span class="w-1.5 h-1.5 rounded-full bg-blue-500 animate-pulse inline-block"/>
          Gerçek Zamanlı Ölçüm (Paralel Stream)
        </span>
        <h1 class="text-4xl font-black text-white tracking-tight mb-3">İnternet Hız Testi</h1>
        <p class="text-slate-400 text-base max-w-md mx-auto leading-relaxed">
          Ookla yöntemiyle paralel TCP stream'ler üzerinden gerçek indirme/yükleme throughput'u ölçer.
        </p>
      </div>

      <!-- Test kartı -->
      <div class="bg-[#0a1628]/60 backdrop-blur-xl rounded-3xl shadow-2xl shadow-blue-500/10 border border-white/5 p-8 mb-4">

        <!-- Gauge -->
        <div class="relative w-72 mx-auto mb-4" style="height:162px">
          <svg width="100%" viewBox="0 0 288 168" class="overflow-visible">
            <defs>
              <linearGradient id="arcGrad" x1="0%" y1="0%" x2="100%" y2="0%">
                <stop offset="0%"   stop-color="#2563eb"/>
                <stop offset="55%"  stop-color="#06b6d4"/>
                <stop offset="100%" stop-color="#16a34a"/>
              </linearGradient>
            </defs>
            <path d="M24 144 A120 120 0 0 1 264 144" fill="none" stroke="rgba(255,255,255,0.05)" stroke-width="16" stroke-linecap="round"/>
            <path d="M24 144 A120 120 0 0 1 264 144" fill="none" stroke="url(#arcGrad)" stroke-width="16" stroke-linecap="round"
              :stroke-dasharray="ARC_LEN" :stroke-dashoffset="arcOffset"
              style="transition:stroke-dashoffset .1s linear;"/>
            <g stroke="rgba(255,255,255,0.2)" stroke-width="1">
              <line v-for="(deg,i) in [-90,-67.5,-45,-22.5,0,22.5,45,67.5,90]" :key="i"
                x1="144" :y1="i%2===0?28:32" x2="144" y2="38" :transform="`rotate(${deg},144,144)`"/>
            </g>
            <text x="20"  y="162" fill="#9ca3af" font-size="10" text-anchor="middle">0</text>
            <text x="72"  y="52"  fill="#9ca3af" font-size="10" text-anchor="middle">50</text>
            <text x="144" y="30"  fill="#9ca3af" font-size="10" text-anchor="middle">200</text>
            <text x="216" y="52"  fill="#9ca3af" font-size="10" text-anchor="middle">500</text>
            <text x="268" y="162" fill="#9ca3af" font-size="10" text-anchor="middle">1G</text>
            <g :style="`transform-origin:144px 144px;transform:rotate(${needleDeg}deg);transition:transform .08s linear;`">
              <line x1="144" y1="144" x2="144" y2="38" stroke="#00b4ff" stroke-width="2.5" stroke-linecap="round" opacity=".9"/>
              <circle cx="144" cy="144" r="7" fill="#00b4ff"/>
              <circle cx="144" cy="144" r="4" fill="white"/>
            </g>
          </svg>
          <div class="absolute bottom-0 left-1/2 -translate-x-1/2 text-center">
            <div class="text-5xl font-black text-white tabular-nums leading-none" style="letter-spacing:-2px">
              {{ currentSpeed.toLocaleString('tr-TR') }}
            </div>
            <div class="text-xs text-slate-400 mt-1 font-medium tracking-wide">Mbps</div>
          </div>
        </div>

        <!-- Live label -->
        <div class="h-6 flex items-center justify-center mb-4">
          <Transition enter-active-class="transition-all duration-200" enter-from-class="opacity-0 translate-y-1" enter-to-class="opacity-100 translate-y-0">
            <span v-if="liveLabel" class="text-xs font-mono text-blue-400 bg-blue-500/10 px-3 py-1 rounded-full border border-blue-500/20">{{ liveLabel }}</span>
          </Transition>
        </div>

        <!-- Phase dots -->
        <div class="flex items-center justify-center gap-2 mb-5">
          <template v-for="(p,i) in ['ping','download','upload']" :key="p">
            <div class="flex items-center gap-1.5">
              <div :class="['w-2 h-2 rounded-full transition-all duration-300',
                phase===p ? 'bg-blue-500 scale-125 animate-pulse'
                : (['done','error'].includes(phase)||(p==='ping'&&['download','upload','done'].includes(phase))||(p==='download'&&['upload','done'].includes(phase)))
                  ? 'bg-blue-400' : 'bg-slate-700'
              ]"/>
              <span class="text-xs text-slate-400">{{ p==='ping'?'Ping':p==='download'?'İndirme':'Yükleme' }}</span>
            </div>
            <span v-if="i<2" class="w-5 h-px bg-slate-800"/>
          </template>
        </div>

        <!-- Ping viz -->
        <div class="flex items-center justify-center gap-6 mb-6">
          <div class="flex flex-col items-center gap-2">
            <div class="relative w-10 h-10">
              <div v-if="pingActive" class="absolute inset-0 rounded-full border-2 border-blue-400 animate-ping opacity-60"/>
              <div class="relative w-full h-full rounded-full bg-blue-600 flex items-center justify-center shadow-lg shadow-blue-600/30">
                <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.75 17L9 20l-1 1h8l-1-1-.75-3M3 13h18M5 17h14a2 2 0 002-2V5a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                </svg>
              </div>
            </div>
            <span class="text-xs text-slate-500">Cihazınız</span>
          </div>
          <div class="relative flex-1 max-w-[120px] h-px bg-gradient-to-r from-blue-500/20 to-blue-500/50">
            <div v-if="pingActive"
              class="absolute top-1/2 -translate-y-1/2 w-3 h-3 rounded-full bg-white border-2 border-blue-500 shadow-sm transition-all duration-[380ms] ease-in-out"
              :style="`left:${pingPacketPos}%`"/>
            <div v-if="phase==='download'" class="absolute -top-4 left-1/2 -translate-x-1/2 text-[10px] text-blue-400 font-medium whitespace-nowrap">↓ veri</div>
            <div v-if="phase==='upload'"   class="absolute -top-4 left-1/2 -translate-x-1/2 text-[10px] text-cyan-400 font-medium whitespace-nowrap">↑ veri</div>
          </div>
          <div class="flex flex-col items-center gap-2">
            <div class="relative w-10 h-10">
              <div v-if="pingActive" class="absolute inset-0 rounded-full border-2 border-cyan-400 animate-ping opacity-60"/>
              <div class="relative w-full h-full rounded-full bg-cyan-500 flex items-center justify-center shadow-lg shadow-cyan-500/30">
                <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 12H3a9 9 0 1018 0h-2M12 3v9"/>
                </svg>
              </div>
            </div>
            <span class="text-xs text-slate-500">Cloudflare CDN</span>
          </div>
        </div>

        <!-- Status -->
        <div class="flex items-center justify-center gap-2 mb-7">
          <div :class="['w-2 h-2 rounded-full transition-colors', phase==='error'?'bg-red-400':phase!=='idle'&&phase!=='done'?'bg-green-400 animate-pulse':'bg-slate-700']"/>
          <span :class="['text-sm', phase==='error'?'text-red-400':'text-slate-400']">{{ phase==='error' ? errorMsg : statusText }}</span>
        </div>

        <!-- Buton -->
        <button
          :disabled="!['idle','done','error'].includes(phase)"
          :class="['w-full py-4 rounded-2xl font-bold text-base text-white transition-all duration-200',
            !['idle','done','error'].includes(phase)
              ? 'bg-slate-800 text-slate-500 cursor-not-allowed'
              : 'bg-gradient-to-r from-blue-600 to-blue-700 hover:from-blue-500 hover:to-blue-600 shadow-lg shadow-blue-600/20 hover:shadow-blue-600/40 hover:-translate-y-0.5'
          ]"
          @click="startTest"
        >
          <span v-if="phase==='idle'">Testi Başlat</span>
          <span v-else-if="['done','error'].includes(phase)">Tekrar Test Et</span>
          <span v-else class="flex items-center justify-center gap-3">
            <svg class="w-4 h-4 animate-spin" fill="none" viewBox="0 0 24 24">
              <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"/>
              <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4z"/>
            </svg>
            Test ediliyor...
          </span>
        </button>
        <p class="text-center text-xs text-slate-500 mt-3">Sunucu: <span class="font-mono text-blue-400">speed.cloudflare.com</span> · Test süresi ~25 sn</p>
      </div>

      <!-- Sonuçlar -->
      <Transition enter-active-class="transition-all duration-500 ease-out" enter-from-class="opacity-0 translate-y-4" enter-to-class="opacity-100 translate-y-0">
        <div v-if="dlVal !== null">
          <div class="grid grid-cols-2 sm:grid-cols-4 gap-3 mb-4">
            <div v-for="m in [
              { label:'İndirme', icon:'⬇', val:dlVal,     unit:'Mbps', pct:dlVal    ?barPct(dlVal,1000):'0%',                bar:'from-blue-500 to-cyan-400',    note:'' },
              { label:'Yükleme', icon:'⬆', val:ulVal,     unit:'Mbps', pct:ulVal    ?barPct(ulVal,500):'0%',                 bar:'from-violet-500 to-purple-400', note:result?.uploadEst?'~tahmin':'' },
              { label:'Ping',    icon:'◎', val:pingVal,   unit:'ms',   pct:pingVal  ?barPct(Math.max(0,150-pingVal),150):'0%',bar:'from-emerald-500 to-green-400', note:'' },
              { label:'Jitter',  icon:'≈', val:jitterVal, unit:'ms',   pct:jitterVal?barPct(Math.max(0,30-jitterVal),30):'0%',bar:'from-amber-500 to-yellow-400',  note:'' },
            ]" :key="m.label" class="bg-[#0a1628]/60 backdrop-blur-xl rounded-2xl border border-white/5 p-4 flex flex-col gap-2">
              <div class="flex items-center justify-between">
                <span class="text-xs text-slate-500 font-medium uppercase tracking-wide">{{ m.label }}</span>
                <span class="text-base leading-none">{{ m.icon }}</span>
              </div>
              <div class="text-2xl font-black text-white tabular-nums leading-none">
                {{ m.val !== null ? m.val : '—' }}<span class="text-xs font-medium text-slate-500 ml-0.5">{{ m.unit }}</span>
              </div>
              <div class="h-1.5 rounded-full bg-slate-800 overflow-hidden">
                <div class="h-full rounded-full bg-gradient-to-r transition-all duration-700" :class="m.bar" :style="`width:${m.val!==null?m.pct:'0%'}`"/>
              </div>
              <div v-if="m.note" class="text-[10px] text-slate-500 italic">{{ m.note }}</div>
            </div>
          </div>

          <Transition enter-active-class="transition-all duration-400 ease-out delay-200" enter-from-class="opacity-0 translate-y-3" enter-to-class="opacity-100 translate-y-0">
            <div v-if="result" class="bg-[#0a1628]/60 backdrop-blur-xl rounded-2xl border border-white/5 p-5 flex items-start gap-4 mb-4">
              <div class="w-11 h-11 rounded-xl flex items-center justify-center flex-shrink-0 text-xl" :style="`background:${getRating(result.tier).bg}`">
                {{ getRating(result.tier).emoji }}
              </div>
              <div class="flex-1 min-w-0">
                <div class="flex items-center gap-2 mb-1">
                  <span class="text-sm font-bold" :style="`color:${getRating(result.tier).color}`">{{ getRating(result.tier).label }}</span>
                  <span class="text-xs text-slate-500">— Bağlantı Analizi</span>
                </div>
                <p class="text-sm text-slate-400 leading-relaxed">{{ getRating(result.tier).desc }}</p>
              </div>
              <Link v-if="['low','adsl'].includes(result.tier)" :href="route('service-request')"
                class="flex-shrink-0 text-xs font-semibold text-blue-400 hover:text-blue-300 underline underline-offset-2">Destek Al →</Link>
            </div>
          </Transition>
        </div>
      </Transition>

      <!-- BİLGİ BÖLÜMÜ -->
      <div class="mt-16 space-y-10">
        <div class="text-center">
          <h2 class="text-2xl font-black text-white mb-2">Hız Testi Hakkında</h2>
          <p class="text-slate-400 text-sm max-w-lg mx-auto">Bağlantı hızınızı doğru yorumlamak için bilmeniz gerekenler.</p>
        </div>

        <div class="bg-[#0a1628]/40 rounded-2xl border border-white/5 p-6">
          <h3 class="text-base font-bold text-white mb-4 flex items-center gap-2">
            <span class="w-7 h-7 rounded-lg bg-blue-500/10 flex items-center justify-center text-sm">🔬</span>
            Test Nasıl Çalışır?
          </h3>
          <div class="grid sm:grid-cols-3 gap-4">
            <div v-for="s in [
              { n:'01', title:'Ping Kalibrasyonu', text:'8 HEAD isteği gönderilir, en iyi 5 değerin ortalaması RTT olarak alınır. Jitter en hızlı ile en yavaş farka göre hesaplanır.' },
              { n:'02', title:'Paralel İndirme',   text:'Hız bandına göre 2–16 paralel stream açılır. Tüm stream\'lerden gelen byte\'lar tek sayaçta toplanır. Alt ve üst %20 elenerek trimmed-mean hesaplanır.' },
              { n:'03', title:'Paralel Yükleme',   text:'Rastgele byte blob\'u paralel POST ile gönderilir. CORS izni varsa gerçek throughput, yoksa download oranıyla tahmin üretilir.' },
            ]" :key="s.n" class="bg-white/5 rounded-xl p-4">
              <div class="text-xs font-black text-blue-400 mb-2 tracking-widest">{{ s.n }}</div>
              <div class="text-sm font-bold text-white mb-1">{{ s.title }}</div>
              <p class="text-xs text-slate-400 leading-relaxed">{{ s.text }}</p>
            </div>
          </div>
        </div>

        <div class="bg-[#0a1628]/40 rounded-2xl border border-white/5 p-6">
          <h3 class="text-base font-bold text-white mb-4 flex items-center gap-2">
            <span class="w-7 h-7 rounded-lg bg-violet-500/10 flex items-center justify-center text-sm">⚡</span>
            Altyapı Karşılaştırması
          </h3>
          <div class="overflow-x-auto -mx-2 px-2">
            <table class="w-full text-sm min-w-[420px]">
              <thead>
                <tr class="border-b border-white/5">
                  <th class="text-left text-xs text-slate-500 font-medium pb-3 pr-3">Senaryo</th>
                  <th class="text-center text-xs font-bold text-violet-400 pb-3 px-2">1 Gbps</th>
                  <th class="text-center text-xs font-bold text-blue-400 pb-3 px-2">100 Mbps</th>
                  <th class="text-center text-xs font-bold text-purple-400 pb-3 px-2">VDSL ~35M</th>
                  <th class="text-center text-xs font-bold text-amber-400 pb-3 px-2">ADSL ~8M</th>
                </tr>
              </thead>
              <tbody class="divide-y divide-white/5">
                <tr v-for="row in [
                  { use:'4K Netflix (1 ekran)',          a:'✓',       b:'✓',          c:'✓',         d:'⚠ Takılır' },
                  { use:'4K (5 eş zamanlı ekran)',       a:'✓',       b:'⚠ Sınırda',  c:'✗',         d:'✗' },
                  { use:'1 GB dosya indirme',            a:'~8 sn',   b:'~80 sn',     c:'~4 dk',     d:'~17 dk' },
                  { use:'Online oyun (ping)',            a:'1–5 ms',  b:'5–15 ms',    c:'10–30 ms',  d:'30–80 ms' },
                  { use:'Video konferans (HD)',          a:'✓',       b:'✓',          c:'✓',         d:'⚠ Kalite düşer' },
                  { use:'Eş zamanlı cihaz kapasitesi',  a:'50+',     b:'10–15',      c:'4–8',       d:'2–3' },
                ]" :key="row.use" class="text-slate-400">
                  <td class="py-2.5 pr-3 text-sm">{{ row.use }}</td>
                  <td class="py-2.5 px-2 text-center text-xs font-medium text-violet-400 bg-violet-400/5">{{ row.a }}</td>
                  <td class="py-2.5 px-2 text-center text-xs font-medium text-blue-400 bg-blue-400/5">{{ row.b }}</td>
                  <td class="py-2.5 px-2 text-center text-xs font-medium text-purple-400 bg-purple-400/5">{{ row.c }}</td>
                  <td class="py-2.5 px-2 text-center text-xs font-medium text-amber-400 bg-amber-400/5">{{ row.d }}</td>
                </tr>
              </tbody>
            </table>
          </div>
        </div>

        <div class="bg-[#0a1628]/40 rounded-2xl border border-white/5 p-6">
          <h3 class="text-base font-bold text-white mb-4 flex items-center gap-2">
            <span class="w-7 h-7 rounded-lg bg-amber-500/10 flex items-center justify-center text-sm">📉</span>
            Hızınızı Etkileyen Faktörler
          </h3>
          <div class="grid sm:grid-cols-2 gap-3">
            <div v-for="item in [
              { icon:'📶', title:'Wi-Fi Mesafesi',   text:'Gigabit hat için ethernet zorunludur. Wi-Fi üzerinden 1G alamazsınız; mesafe ve duvarlar hızı dramatik düşürür.' },
              { icon:'🕐', title:'Saatlik Yoğunluk', text:'Akşam 20:00–23:00 arası ISP altyapısı yoğundur. Karşılaştırma için sabah saatlerinde de test yapın.' },
              { icon:'🔌', title:'Eski Ekipman',      text:'Cat5 kablo veya 100Mbps ethernet kartı gigabit hattı daraltır. VDSL hattı için bakır tesisat kalitesi kritiktir.' },
              { icon:'🏠', title:'İç Tesisat',        text:'VDSL ve ADSL için santrale mesafe önemlidir; eskimiş telefon hatları ve zayıf splitter\'lar sinyal kalitesini düşürür.' },
            ]" :key="item.title" class="flex items-start gap-3 bg-white/5 rounded-xl p-3">
              <span class="text-lg leading-none flex-shrink-0 mt-0.5">{{ item.icon }}</span>
              <div>
                <div class="text-sm font-bold text-white mb-0.5">{{ item.title }}</div>
                <p class="text-xs text-slate-400 leading-relaxed">{{ item.text }}</p>
              </div>
            </div>
          </div>
        </div>

        <div class="bg-gradient-to-r from-blue-600 to-blue-800 rounded-2xl p-7 text-white text-center">
          <p class="text-sm font-medium opacity-75 mb-1">Hızınızdan memnun değil misiniz?</p>
          <h3 class="text-xl font-black mb-3">Ücretsiz Teknik Değerlendirme Alın</h3>
          <p class="text-sm opacity-70 mb-6 max-w-sm mx-auto">Uzman ekibimiz hat kalitenizi yerinde analiz eder, fiber geçişi veya tesisat yenileme için çözüm önerisi sunar.</p>
          <div class="flex flex-col sm:flex-row gap-3 justify-center">
            <Link :href="route('service-request')" class="inline-flex items-center justify-center gap-2 bg-white text-blue-700 font-bold text-sm px-6 py-3 rounded-xl hover:bg-blue-50 transition-colors">
              Randevu Al
              <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"/>
              </svg>
            </Link>
            <a href="tel:05469118061" class="inline-flex items-center justify-center gap-2 bg-white/10 border border-white/20 text-white font-semibold text-sm px-6 py-3 rounded-xl hover:bg-white/20 transition-colors">
              <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/>
              </svg>
              0546 911 80 61
            </a>
          </div>
        </div>
      </div>

    </div>
  </section>
</template>
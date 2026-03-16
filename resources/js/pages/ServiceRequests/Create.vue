<script setup lang="ts">
/**
 * Create.vue — Modern Çok Adımlı Servis Talebi Formu (Design Update)
 * 
 * Bu sayfa hizmet detay sayfalarından (örn. İnternet Hizmetleri) yönlendirme ile gelindiğinde kullanılır.
 * Gelen props'lara göre kategori otomatik seçilebilir.
 */

import { ref, computed, onMounted } from 'vue'
import { useForm, Link } from '@inertiajs/vue3'
import AppLayout from '@/layouts/AppLayout.vue'
import SEO from '@/components/SEO.vue'

defineOptions({ layout: AppLayout })

const props = defineProps({
  serviceKey: { type: String, default: null },
  optionId:   { type: String, default: null },
  userData:   { type: Object, default: () => ({}) },
  products:   { type: Array,  default: () => [] }
})

const categories = [
  {
    id:    'internet',
    icon:  'wifi',
    title: 'İnternet Teknik Servis',
    desc:  'Fiber/ADSL kurulum, sinyal sorunu, yavaş bağlantı, modem arızası',
    accent: '#2563eb',
    glow:   'rgba(37,99,235,0.25)',
  },
  {
    id:    'elektrik',
    icon:  'bolt',
    title: 'Elektrik Teknik Servis',
    desc:  'Tesisat kurulumu, pano yenileme, aydınlatma, topraklama',
    accent: '#f59e0b',
    glow:   'rgba(245,158,11,0.2)',
  },
  {
    id:    'satellite',
    icon:  'satellite',
    title: 'Uydu & Merkezi Sistem',
    desc:  'Çanak anten montajı, merkezi uydu sistemi, sinyal arızası',
    accent: '#a855f7',
    glow:   'rgba(168,85,247,0.2)',
  },
  {
    id:    'camera',
    icon:  'camera',
    title: 'Güvenlik & Kamera',
    desc:  'Kamera kurulumu, NVR/DVR bakımı, altyapı çalışmaları',
    accent: '#10b981',
    glow:   'rgba(16,185,129,0.2)',
  },
]

type Phase = 1 | 2 | 3
const step             = ref<Phase>(1)
const selectedCategory = ref<string | null>(null)
const submitted        = ref(false)

const form = useForm({
  service_key:          '', // Backend expects service_key
  name:                 props.userData.name || '',
  phone:                props.userData.phone || '',
  email:                props.userData.email || '',
  address:              props.userData.address || '',
  district:             '',
  description:          '',
  urgency:              'normal' as 'normal' | 'urgent',
  option_id:            props.optionId || 'genel',
  other_service_option: '',
  product_id:           '',
  other_product_name:   '',
})

const step2Valid = computed(() =>
  form.name.trim().length >= 2 &&
  form.phone.replace(/\D/g, '').length >= 10 &&
  form.address.trim().length >= 5
)

function selectCategory(id: string) {
  selectedCategory.value = id
  form.service_key = id
}

function goStep(n: Phase) {
  step.value = n
  window.scrollTo({ top: 0, behavior: 'smooth' })
}

function submitForm() {
  form.post(route('service-requests.store'), {
    onSuccess: () => { submitted.value = true },
  })
}

const selectedCat = computed(() => categories.find(c => c.id === selectedCategory.value))

/* ── Pre-selection Logic ── */
onMounted(() => {
  if (props.serviceKey) {
    const exists = categories.find(c => c.id === props.serviceKey)
    if (exists) {
      selectCategory(exists.id)
      step.value = 2
    }
  }
})
</script>

<template>
  <SEO 
    title="Servis Talebi Oluştur - TürkTeknik" 
    description="İnternet, Elektrik, Uydu ve Kamera sistemleri için profesyonel teknik servis talebinizi 3 kolay adımda oluşturun."
    url="https://turkteknik.com.tr/servis-talebi/olustur"
    keywords="teknik servis, internet, elektrik, uydu, kamera, türk teknik"
  />

  <!-- ── Ana arka plan: projenin koyu mavi sistemi ── -->
  <section class="min-h-screen py-20 px-4" style="background: #060e1f;">

    <!-- Dekoratif arka plan ışıkları -->
    <div class="fixed inset-0 pointer-events-none overflow-hidden" aria-hidden="true">
      <div class="absolute top-0 left-1/4 w-96 h-96 rounded-full opacity-10"
        style="background: radial-gradient(circle, #2563eb 0%, transparent 70%); filter: blur(60px);"/>
      <div class="absolute bottom-1/3 right-1/4 w-80 h-80 rounded-full opacity-8"
        style="background: radial-gradient(circle, #7c3aed 0%, transparent 70%); filter: blur(80px);"/>
    </div>

    <div class="max-w-3xl mx-auto relative z-10">

      <!-- ── Başlık ── -->
      <div class="text-center mb-10">
        <span class="inline-flex items-center gap-2 text-xs font-semibold px-4 py-1.5 rounded-full mb-5 uppercase tracking-wider border"
          style="background: rgba(37,99,235,0.15); border-color: rgba(37,99,235,0.3); color: #60a5fa;">
          <span class="w-1.5 h-1.5 rounded-full bg-blue-400 animate-pulse inline-block"/>
          Hızlı Servis
        </span>
        <h1 class="text-4xl font-black tracking-tight mb-3" style="color: #f0f4ff;">
          Servis Talebi Oluştur
        </h1>
        <p class="text-base max-w-md mx-auto leading-relaxed" style="color: #6b7fa3;">
          Hizmet almak istediğiniz kategoriyi seçin, bilgilerinizi girin — ekibimiz en kısa sürede ulaşsın.
        </p>
      </div>

      <!-- ── Stepper ── -->
      <div v-if="!submitted" class="flex items-center justify-center gap-0 mb-10">
        <template v-for="(s, i) in [{ n:1, label:'Kategori' },{ n:2, label:'Bilgiler' },{ n:3, label:'Onay' }]" :key="s.n">
          <div class="flex items-center gap-2">
            <div :class="['w-9 h-9 rounded-full flex items-center justify-center text-sm font-bold transition-all duration-300']"
              :style="step > s.n
                ? 'background:#2563eb; color:#fff; box-shadow: 0 0 12px rgba(37,99,235,0.5)'
                : step === s.n
                  ? 'background:#2563eb; color:#fff; box-shadow: 0 0 20px rgba(37,99,235,0.6); transform:scale(1.1)'
                  : 'background:rgba(255,255,255,0.07); color:#4b6080; border: 1.5px solid rgba(255,255,255,0.1)'"
            >
              <svg v-if="step > s.n" class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7"/>
              </svg>
              <span v-else>{{ s.n }}</span>
            </div>
            <span class="text-sm font-medium transition-colors"
              :style="step === s.n ? 'color:#93c5fd' : 'color:#3d5070'">
              {{ s.label }}
            </span>
          </div>
          <div v-if="i < 2" class="w-12 h-px mx-2 transition-colors duration-300"
            :style="step > s.n ? 'background:#2563eb' : 'background:rgba(255,255,255,0.08)'"/>
        </template>
      </div>

      <!-- ════════════════════
           ADIM 1 — KATEGORİ
      ════════════════════ -->
      <Transition enter-active-class="transition-all duration-400 ease-out" enter-from-class="opacity-0 translate-x-6" enter-to-class="opacity-100 translate-x-0">
        <div v-if="step === 1 && !submitted">
          <div class="grid sm:grid-cols-2 gap-4 mb-8">
            <button
              v-for="cat in categories"
              :key="cat.id"
              type="button"
              class="text-left p-6 rounded-2xl transition-all duration-200 group relative overflow-hidden"
              :style="selectedCategory === cat.id
                ? `background: rgba(255,255,255,0.07); border: 1.5px solid ${cat.accent}; box-shadow: 0 0 24px ${cat.glow}`
                : 'background: rgba(255,255,255,0.04); border: 1.5px solid rgba(255,255,255,0.08);'"
              @click="selectCategory(cat.id)"
            >
              <!-- Seçilince glow spot -->
              <div v-if="selectedCategory === cat.id"
                class="absolute inset-0 opacity-10 pointer-events-none rounded-2xl"
                :style="`background: radial-gradient(circle at 20% 20%, ${cat.accent}, transparent 70%)`"/>

              <!-- İkon -->
              <div class="w-14 h-14 rounded-2xl flex items-center justify-center mb-4 transition-all duration-200"
                :style="selectedCategory === cat.id
                  ? `background: ${cat.accent}22; border: 1px solid ${cat.accent}44`
                  : 'background: rgba(255,255,255,0.06); border: 1px solid rgba(255,255,255,0.08)'"
              >
                <svg v-if="cat.id === 'internet'" class="w-7 h-7 transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                  :style="selectedCategory === cat.id ? `color: ${cat.accent}` : 'color: #4b6080'">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8.111 16.404a5.5 5.5 0 017.778 0M12 20h.01m-7.08-7.071c3.904-3.905 10.236-3.905 14.141 0M1.394 9.393c5.857-5.857 15.355-5.857 21.213 0"/>
                </svg>
                <svg v-if="cat.id === 'elektrik'" class="w-7 h-7 transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                  :style="selectedCategory === cat.id ? `color: ${cat.accent}` : 'color: #4b6080'">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"/>
                </svg>
                <svg v-if="cat.id === 'satellite'" class="w-7 h-7 transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                  :style="selectedCategory === cat.id ? `color: ${cat.accent}` : 'color: #4b6080'">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3.055 11H5a2 2 0 012 2v1a2 2 0 002 2 2 2 0 012 2v2.945M8 3.935V5.5A2.5 2.5 0 0010.5 8h.5a2 2 0 012 2 2 2 0 104 0 2 2 0 012-2h1.064M15 20.488V18a2 2 0 012-2h3.064"/>
                </svg>
                <svg v-if="cat.id === 'camera'" class="w-7 h-7 transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                  :style="selectedCategory === cat.id ? `color: ${cat.accent}` : 'color: #4b6080'">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 10l4.553-2.069A1 1 0 0121 8.878v6.244a1 1 0 01-1.447.894L15 14M5 18h8a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v8a2 2 0 002 2z"/>
                </svg>
              </div>

              <!-- Başlık + seçildi badge -->
              <div class="flex items-start justify-between mb-2 gap-2">
                <h3 class="font-bold text-base leading-tight transition-colors"
                  :style="selectedCategory === cat.id ? 'color:#e8f0ff' : 'color:#8fa3c0'">
                  {{ cat.title }}
                </h3>
                <div v-if="selectedCategory === cat.id"
                  class="text-[10px] font-bold px-2 py-0.5 rounded-full flex-shrink-0 mt-0.5"
                  :style="`background: ${cat.accent}22; color: ${cat.accent}; border: 1px solid ${cat.accent}44`">
                  ✓ Seçildi
                </div>
              </div>
              <p class="text-sm leading-relaxed" style="color:#4b6080;">{{ cat.desc }}</p>
            </button>
          </div>

          <button
            :disabled="!selectedCategory"
            class="w-full py-4 rounded-2xl font-bold text-base text-white transition-all duration-200"
            :style="selectedCategory
              ? 'background: linear-gradient(135deg,#1d4ed8,#2563eb); box-shadow: 0 8px 24px rgba(37,99,235,0.4)'
              : 'background: rgba(255,255,255,0.06); color: #3d5070; cursor: not-allowed'"
            @click="goStep(2)"
          >
            <span class="flex items-center justify-center gap-2">
              Devam Et
              <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M14 5l7 7m0 0l-7 7m7-7H3"/>
              </svg>
            </span>
          </button>
        </div>
      </Transition>

      <!-- ════════════════════
           ADIM 2 — BİLGİLER
      ════════════════════ -->
      <Transition enter-active-class="transition-all duration-400 ease-out" enter-from-class="opacity-0 translate-x-6" enter-to-class="opacity-100 translate-x-0">
        <div v-if="step === 2 && !submitted">

          <!-- Seçilen kategori özeti -->
          <div v-if="selectedCat" class="flex items-center gap-3 p-4 rounded-2xl mb-5 border"
            :style="`background: ${selectedCat.accent}12; border-color: ${selectedCat.accent}30`">
            <div class="w-9 h-9 rounded-xl flex items-center justify-center flex-shrink-0"
              :style="`background: ${selectedCat.accent}20`">
              <svg v-if="selectedCat.id==='internet'" class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" :style="`color:${selectedCat.accent}`"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8.111 16.404a5.5 5.5 0 017.778 0M12 20h.01m-7.08-7.071c3.904-3.905 10.236-3.905 14.141 0M1.394 9.393c5.857-5.857 15.355-5.857 21.213 0"/></svg>
              <svg v-if="selectedCat.id==='elektrik'" class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" :style="`color:${selectedCat.accent}`"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"/></svg>
              <svg v-if="selectedCat.id==='satellite'" class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" :style="`color:${selectedCat.accent}`"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3.055 11H5a2 2 0 012 2v1a2 2 0 002 2 2 2 0 012 2v2.945M8 3.935V5.5A2.5 2.5 0 0010.5 8h.5a2 2 0 012 2 2 2 0 104 0 2 2 0 012-2h1.064M15 20.488V18a2 2 0 012-2h3.064"/></svg>
              <svg v-if="selectedCat.id==='camera'" class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" :style="`color:${selectedCat.accent}`"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 10l4.553-2.069A1 1 0 0121 8.878v6.244a1 1 0 01-1.447.894L15 14M5 18h8a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v8a2 2 0 002 2z"/></svg>
            </div>
            <div class="flex-1 min-w-0">
              <div class="text-sm font-bold" style="color:#c8d8f0">{{ selectedCat.title }}</div>
              <div class="text-xs" style="color:#4b6080">Seçilen hizmet kategorisi</div>
            </div>
            <button class="text-xs font-semibold underline underline-offset-2 transition-colors"
              style="color:#60a5fa" @click="goStep(1)">Değiştir</button>
          </div>

          <!-- Form kartı -->
          <div class="rounded-3xl border p-8 mb-5"
            style="background: rgba(255,255,255,0.04); border-color: rgba(255,255,255,0.08); box-shadow: 0 24px 48px rgba(0,0,0,0.4)">

            <h2 class="text-lg font-black mb-6" style="color:#e8f0ff">İletişim Bilgileriniz</h2>

            <!-- Ad + Telefon -->
            <div class="grid sm:grid-cols-2 gap-4 mb-4">
              <div>
                <label class="block text-xs font-semibold mb-1.5 uppercase tracking-wide" style="color:#4b6080">
                  Ad Soyad <span style="color:#f87171">*</span>
                </label>
                <input v-model="form.name" type="text" placeholder="Ahmet Yılmaz"
                  class="w-full px-4 py-3 rounded-xl text-sm placeholder-gray-600 outline-none transition-all duration-200"
                  :style="form.errors.name
                    ? 'background:rgba(248,113,113,0.08); border: 1.5px solid rgba(248,113,113,0.4); color:#fca5a5'
                    : 'background:rgba(255,255,255,0.06); border: 1.5px solid rgba(255,255,255,0.1); color:#c8d8f0'"
                />
                <p v-if="form.errors.name" class="text-xs text-red-400 mt-1">{{ form.errors.name }}</p>
              </div>
              <div>
                <label class="block text-xs font-semibold mb-1.5 uppercase tracking-wide" style="color:#4b6080">
                  Telefon <span style="color:#f87171">*</span>
                </label>
                <input v-model="form.phone" type="tel" placeholder="0 5XX XXX XX XX"
                  class="w-full px-4 py-3 rounded-xl text-sm placeholder-gray-600 outline-none transition-all duration-200"
                  :style="form.errors.phone
                    ? 'background:rgba(248,113,113,0.08); border: 1.5px solid rgba(248,113,113,0.4); color:#fca5a5'
                    : 'background:rgba(255,255,255,0.06); border: 1.5px solid rgba(255,255,255,0.1); color:#c8d8f0'"
                />
                <p v-if="form.errors.phone" class="text-xs text-red-400 mt-1">{{ form.errors.phone }}</p>
              </div>
            </div>

            <!-- Email -->
            <div class="mb-4">
              <label class="block text-xs font-semibold mb-1.5 uppercase tracking-wide" style="color:#4b6080">
                E-posta <span class="normal-case font-normal" style="color:#2d3f5a">(isteğe bağlı)</span>
              </label>
              <input v-model="form.email" type="email" placeholder="ornek@email.com"
                class="w-full px-4 py-3 rounded-xl text-sm placeholder-gray-600 outline-none transition-all duration-200"
                style="background:rgba(255,255,255,0.06); border: 1.5px solid rgba(255,255,255,0.1); color:#c8d8f0"
              />
            </div>

            <!-- Adres + İlçe -->
            <div class="grid sm:grid-cols-3 gap-4 mb-4">
              <div class="sm:col-span-2">
                <label class="block text-xs font-semibold mb-1.5 uppercase tracking-wide" style="color:#4b6080">
                  Adres <span style="color:#f87171">*</span>
                </label>
                <input v-model="form.address" type="text" placeholder="Mahalle, Cadde, Sokak, Bina No"
                  class="w-full px-4 py-3 rounded-xl text-sm placeholder-gray-600 outline-none transition-all duration-200"
                  :style="form.errors.address
                    ? 'background:rgba(248,113,113,0.08); border: 1.5px solid rgba(248,113,113,0.4); color:#fca5a5'
                    : 'background:rgba(255,255,255,0.06); border: 1.5px solid rgba(255,255,255,0.1); color:#c8d8f0'"
                />
              </div>
              <div>
                <label class="block text-xs font-semibold mb-1.5 uppercase tracking-wide" style="color:#4b6080">İlçe</label>
                <input v-model="form.district" type="text" placeholder="İlçe"
                  class="w-full px-4 py-3 rounded-xl text-sm placeholder-gray-600 outline-none transition-all duration-200"
                  style="background:rgba(255,255,255,0.06); border: 1.5px solid rgba(255,255,255,0.1); color:#c8d8f0"
                />
              </div>
            </div>

            <!-- Açıklama -->
            <div class="mb-6">
              <label class="block text-xs font-semibold mb-1.5 uppercase tracking-wide" style="color:#4b6080">Sorun Açıklaması</label>
              <textarea v-model="form.description" rows="4"
                placeholder="Sorununuzu kısaca açıklayın..."
                class="w-full px-4 py-3 rounded-xl text-sm placeholder-gray-600 outline-none transition-all duration-200 resize-none leading-relaxed"
                style="background:rgba(255,255,255,0.06); border: 1.5px solid rgba(255,255,255,0.1); color:#c8d8f0"
              />
              <div class="flex justify-end mt-1">
                <span class="text-xs" style="color:#2d3f5a">{{ form.description.length }} / 500</span>
              </div>
            </div>

            <!-- Aciliyet -->
            <div>
              <label class="block text-xs font-semibold mb-3 uppercase tracking-wide" style="color:#4b6080">Aciliyet Durumu</label>
              <div class="grid grid-cols-2 gap-3">
                <button type="button"
                  class="flex items-center gap-3 p-4 rounded-xl border transition-all duration-200 text-left"
                  :style="form.urgency === 'normal'
                    ? 'background: rgba(37,99,235,0.12); border-color: rgba(37,99,235,0.4); box-shadow: 0 0 16px rgba(37,99,235,0.15)'
                    : 'background: rgba(255,255,255,0.04); border-color: rgba(255,255,255,0.08)'"
                  @click="form.urgency = 'normal'"
                >
                  <span class="text-xl">🕐</span>
                  <div>
                    <div class="text-sm font-bold" style="color:#c8d8f0">Normal</div>
                    <div class="text-xs" style="color:#4b6080">2–3 iş günü</div>
                  </div>
                </button>
                <button type="button"
                  class="flex items-center gap-3 p-4 rounded-xl border transition-all duration-200 text-left"
                  :style="form.urgency === 'urgent'
                    ? 'background: rgba(239,68,68,0.1); border-color: rgba(239,68,68,0.4); box-shadow: 0 0 16px rgba(239,68,68,0.1)'
                    : 'background: rgba(255,255,255,0.04); border-color: rgba(255,255,255,0.08)'"
                  @click="form.urgency = 'urgent'"
                >
                  <span class="text-xl">⚡</span>
                  <div>
                    <div class="text-sm font-bold" style="color:#c8d8f0">Acil</div>
                    <div class="text-xs" style="color:#4b6080">Aynı gün / 24 saat</div>
                  </div>
                </button>
              </div>
            </div>
          </div>

          <!-- Butonlar -->
          <div class="flex gap-3">
            <button type="button"
              class="flex items-center gap-2 px-6 py-4 rounded-2xl font-semibold text-sm transition-all duration-200"
              style="background: rgba(255,255,255,0.05); border: 1.5px solid rgba(255,255,255,0.1); color:#6b7fa3"
              @click="goStep(1)"
            >
              <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
              </svg>
              Geri
            </button>
            <button
              :disabled="!step2Valid"
              class="flex-1 py-4 rounded-2xl font-bold text-base text-white transition-all duration-200"
              :style="step2Valid
                ? 'background: linear-gradient(135deg,#1d4ed8,#2563eb); box-shadow: 0 8px 24px rgba(37,99,235,0.4)'
                : 'background: rgba(255,255,255,0.06); color: #3d5070; cursor: not-allowed'"
              @click="goStep(3)"
            >
              <span class="flex items-center justify-center gap-2">
                İncele & Gönder
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M14 5l7 7m0 0l-7 7m7-7H3"/>
                </svg>
              </span>
            </button>
          </div>
        </div>
      </Transition>

      <!-- ════════════════════
           ADIM 3 — ONAY
      ════════════════════ -->
      <Transition enter-active-class="transition-all duration-400 ease-out" enter-from-class="opacity-0 translate-x-6" enter-to-class="opacity-100 translate-x-0">
        <div v-if="step === 3 && !submitted">
          <div class="rounded-3xl border p-8 mb-5"
            style="background: rgba(255,255,255,0.04); border-color: rgba(255,255,255,0.08); box-shadow: 0 24px 48px rgba(0,0,0,0.4)">

            <h2 class="text-lg font-black mb-6 flex items-center gap-2" style="color:#e8f0ff">
              <svg class="w-5 h-5 text-blue-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
              </svg>
              Talebinizi İnceleyin
            </h2>

            <div class="space-y-3 mb-6">
              <!-- Kategori satırı -->
              <div v-if="selectedCat" class="flex items-center gap-4 p-4 rounded-2xl"
                style="background: rgba(255,255,255,0.04); border: 1px solid rgba(255,255,255,0.06)">
                <div class="w-10 h-10 rounded-xl flex items-center justify-center flex-shrink-0"
                  :style="`background: ${selectedCat.accent}20`">
                  <svg v-if="selectedCat.id==='internet'" class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" :style="`color:${selectedCat.accent}`"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8.111 16.404a5.5 5.5 0 017.778 0M12 20h.01m-7.08-7.071c3.904-3.905 10.236-3.905 14.141 0M1.394 9.393c5.857-5.857 15.355-5.857 21.213 0"/></svg>
                  <svg v-if="selectedCat.id==='elektrik'" class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" :style="`color:${selectedCat.accent}`"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"/></svg>
                  <svg v-if="selectedCat.id==='satellite'" class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" :style="`color:${selectedCat.accent}`"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3.055 11H5a2 2 0 012 2v1a2 2 0 002 2 2 2 0 012 2v2.945M8 3.935V5.5A2.5 2.5 0 0010.5 8h.5a2 2 0 012 2 2 2 0 104 0 2 2 0 012-2h1.064M15 20.488V18a2 2 0 012-2h3.064"/></svg>
                  <svg v-if="selectedCat.id==='camera'" class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" :style="`color:${selectedCat.accent}`"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 10l4.553-2.069A1 1 0 0121 8.878v6.244a1 1 0 01-1.447.894L15 14M5 18h8a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v8a2 2 0 002 2z"/></svg>
                </div>
                <div class="flex-1">
                  <div class="text-xs mb-0.5" style="color:#4b6080">Hizmet Kategorisi</div>
                  <div class="text-sm font-bold" style="color:#c8d8f0">{{ selectedCat.title }}</div>
                </div>
                <span class="text-xs font-bold px-2.5 py-1 rounded-full"
                  :style="form.urgency === 'urgent'
                    ? 'background: rgba(239,68,68,0.15); color:#fca5a5; border: 1px solid rgba(239,68,68,0.3)'
                    : 'background: rgba(37,99,235,0.15); color:#93c5fd; border: 1px solid rgba(37,99,235,0.3)'">
                  {{ form.urgency === 'urgent' ? '⚡ Acil' : '🕐 Normal' }}
                </span>
              </div>

              <!-- Kişisel bilgiler -->
              <div class="grid sm:grid-cols-2 gap-3">
                <div v-for="row in [
                  { label:'Ad Soyad', val:form.name, icon:'👤' },
                  { label:'Telefon',  val:form.phone, icon:'📞' },
                  { label:'E-posta',  val:form.email||'—', icon:'✉️' },
                  { label:'İlçe',     val:form.district||'—', icon:'📍' },
                ]" :key="row.label"
                  class="flex items-center gap-3 p-3.5 rounded-xl"
                  style="background: rgba(255,255,255,0.04); border: 1px solid rgba(255,255,255,0.06)"
                >
                  <span class="text-base leading-none">{{ row.icon }}</span>
                  <div class="min-w-0">
                    <div class="text-xs" style="color:#4b6080">{{ row.label }}</div>
                    <div class="text-sm font-medium truncate" style="color:#c8d8f0">{{ row.val }}</div>
                  </div>
                </div>
              </div>

              <!-- Adres -->
              <div class="flex items-start gap-3 p-3.5 rounded-xl"
                style="background: rgba(255,255,255,0.04); border: 1px solid rgba(255,255,255,0.06)">
                <span class="text-base leading-none mt-0.5">🏠</span>
                <div>
                  <div class="text-xs mb-0.5" style="color:#4b6080">Adres</div>
                  <div class="text-sm font-medium" style="color:#c8d8f0">{{ form.address }}{{ form.district ? ', ' + form.district : '' }}</div>
                </div>
              </div>

              <!-- Açıklama -->
              <div v-if="form.description" class="p-3.5 rounded-xl"
                style="background: rgba(255,255,255,0.04); border: 1px solid rgba(255,255,255,0.06)">
                <div class="text-xs mb-1.5" style="color:#4b6080">📝 Açıklama</div>
                <p class="text-sm leading-relaxed" style="color:#8fa3c0">{{ form.description }}</p>
              </div>
            </div>

            <!-- KVKK -->
            <div class="flex items-start gap-3 p-4 rounded-xl mb-6"
              style="background: rgba(37,99,235,0.08); border: 1px solid rgba(37,99,235,0.2)">
              <svg class="w-4 h-4 flex-shrink-0 mt-0.5" style="color:#60a5fa" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
              </svg>
              <p class="text-xs leading-relaxed" style="color:#60a5fa">
                Kişisel verileriniz yalnızca servis talebinizin işlenmesi amacıyla kullanılacak ve korunacaktır.
              </p>
            </div>

            <!-- Gönder -->
            <button
              :disabled="form.processing"
              class="w-full py-4 rounded-2xl font-bold text-base text-white transition-all duration-200"
              :style="!form.processing
                ? 'background: linear-gradient(135deg,#1d4ed8,#2563eb); box-shadow: 0 8px 28px rgba(37,99,235,0.45)'
                : 'background: rgba(255,255,255,0.07); cursor: not-allowed; color:#3d5070'"
              @click="submitForm"
            >
              <span v-if="!form.processing" class="flex items-center justify-center gap-2">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8"/>
                </svg>
                Talebi Gönder
              </span>
              <span v-else class="flex items-center justify-center gap-3">
                <svg class="w-4 h-4 animate-spin" fill="none" viewBox="0 0 24 24">
                  <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"/>
                  <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4z"/>
                </svg>
                Gönderiliyor...
              </span>
            </button>
          </div>

          <button type="button"
            class="flex items-center gap-2 text-sm mx-auto transition-colors font-medium"
            style="color:#3d5070"
            @click="goStep(2)"
          >
            ← Bilgileri düzenle
          </button>
        </div>
      </Transition>

      <!-- ════════════════════
           BAŞARI EKRANI
      ════════════════════ -->
      <Transition enter-active-class="transition-all duration-500 ease-out" enter-from-class="opacity-0 scale-95" enter-to-class="opacity-100 scale-100">
        <div v-if="submitted" class="text-center">
          <div class="rounded-3xl border p-12 mb-6"
            style="background: rgba(255,255,255,0.04); border-color: rgba(255,255,255,0.08); box-shadow: 0 24px 48px rgba(0,0,0,0.5)">

            <!-- Onay ikonu -->
            <div class="w-24 h-24 rounded-full flex items-center justify-center mx-auto mb-6 relative"
              style="background: rgba(16,185,129,0.12); border: 1.5px solid rgba(16,185,129,0.3)">
              <div class="absolute inset-0 rounded-full animate-ping opacity-20"
                style="background: rgba(16,185,129,0.3)"/>
              <svg class="w-12 h-12 relative z-10" fill="none" stroke="currentColor" viewBox="0 0 24 24" style="color:#34d399">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
              </svg>
            </div>

            <h2 class="text-3xl font-black mb-3" style="color:#e8f0ff">Talebiniz Alındı!</h2>
            <p class="mb-8 leading-relaxed max-w-sm mx-auto" style="color:#6b7fa3">
              Servis talebiniz ekibimize iletildi.
              <strong style="color:#93c5fd">{{ form.phone }}</strong>
              numaralı telefonunuzdan en kısa sürede arayacağız.
            </p>

            <!-- Bilgi kutuları -->
            <div class="grid grid-cols-3 gap-3 mb-8">
              <div v-for="info in [
                { icon:'📞', title:'2–3 saat', sub:'içinde arama' },
                { icon:'🔧', title:'Uzman',    sub:'teknisyen' },
                { icon:'✅', title:'Ücretsiz', sub:'keşif' },
              ]" :key="info.title"
                class="rounded-2xl p-4"
                style="background: rgba(255,255,255,0.04); border: 1px solid rgba(255,255,255,0.07)"
              >
                <div class="text-2xl mb-1">{{ info.icon }}</div>
                <div class="text-sm font-bold" style="color:#c8d8f0">{{ info.title }}</div>
                <div class="text-xs" style="color:#4b6080">{{ info.sub }}</div>
              </div>
            </div>

            <div class="flex flex-col sm:flex-row gap-3 justify-center">
              <Link href="/"
                class="inline-flex items-center justify-center gap-2 font-bold text-sm px-6 py-3 rounded-xl text-white transition-all shadow-lg"
                style="background: linear-gradient(135deg,#1d4ed8,#2563eb); box-shadow: 0 8px 24px rgba(37,99,235,0.4)">
                Ana Sayfaya Dön
              </Link>
              <a href="tel:05469118061"
                class="inline-flex items-center justify-center gap-2 font-semibold text-sm px-6 py-3 rounded-xl transition-all"
                style="background: rgba(255,255,255,0.06); border: 1.5px solid rgba(255,255,255,0.1); color:#93c5fd">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/>
                </svg>
                Hemen Ara
              </a>
            </div>
          </div>
        </div>
      </Transition>

    </div>
  </section>
</template>
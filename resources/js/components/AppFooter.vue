<script setup lang="ts">
import { ref } from 'vue'
import { Link } from '@inertiajs/vue3'

interface FooterLink {
  label: string
  href: string
  badge?: string
}

interface FooterColumn {
  title: string
  icon: string
  links: FooterLink[]
}

const columns: FooterColumn[] = [
  {
    title: 'Hizmetlerimiz',
    icon: '🌐',
    links: [
      { label: 'Fiber İnternet', href: route('services.internet') },
      { label: 'Uydu Sistemleri', href: route('services.satellite') },
      { label: 'Kamera Sistemleri', href: route('services.camera') },
      { label: 'Elektrik Servisi', href: route('services.elektrik') },
      { label: 'Hız Testi', href: route('internet-speed-test') },
      { label: 'Servis Talebi', href: route('service-request') },
    ],
  },
  {
    title: 'Hızlı Erişim',
    icon: '🚀',
    links: [
      { label: 'Ana Sayfa', href: route('home') },
      { label: 'Tüm Hizmetler', href: route('services.index') },
      { label: 'Referanslar', href: '/referanslar' },
      { label: 'Teknik Rehberler', href: '/rehberler' },
      { label: 'Hakkımızda', href: route('about') },
      { label: 'İletişim', href: route('contact') },
    ],
  },
  {
    title: 'Sorun Çözüm Merkezi',
    icon: '📖',
    links: [
      { label: 'ZTE Modem Kurulumu', href: '/rehberler/zte-modem-kurulumu' },
      { label: 'TP-Link Modem Kurulumu', href: '/rehberler/tp-link-modem-kurulumu' },
      { label: 'Çanak Anten Ayarı', href: '/rehberler/canak-anten-ayari' },
      { label: 'DiSEqC Ayarları', href: '/rehberler/diseqc-ayarlari' },
      { label: 'Kamera Uzaktan İzleme', href: '/rehberler/kamera-uzaktan-izleme' },
      { label: 'Vodafone Arızası', href: '/rehberler/vodafone-internet-arizasi' },
    ],
  },
  {
    title: 'İletişim & Destek',
    icon: '📞',
    links: [
      { label: 'Canlı Destek', href: '#' },
      { label: 'WhatsApp Hattı', href: 'https://wa.me/905469118061' },
      { label: 'Sıkça Sorulan Sorular', href: '#' },
      { label: 'Teknik Destek', href: '#' },
      { label: 'Bize Yazın', href: route('contact') },
    ],
  },
]

const socialLinks = [
  { name: 'Facebook', href: '#', icon: 'M18 2h-3a5 5 0 00-5 5v3H7v4h3v8h4v-8h3l1-4h-4V7a1 1 0 011-1h3z' },
  { name: 'Twitter/X', href: '#', icon: 'M23 3a10.9 10.9 0 01-3.14 1.53 4.48 4.48 0 00-7.86 3v1A10.66 10.66 0 013 4s-4 9 5 13a11.64 11.64 0 01-7 2c9 5 20 0 20-11.5a4.5 4.5 0 00-.08-.83A7.72 7.72 0 0023 3z' },
  { name: 'Instagram', href: '#', icon: 'M16 11.37A4 4 0 1112.63 8 4 4 0 0116 11.37z M17.5 6.5h.01 M7.8 2h8.4C19.4 2 22 4.6 22 7.8v8.4a5.8 5.8 0 01-5.8 5.8H7.8C4.6 22 2 19.4 2 16.2V7.8A5.8 5.8 0 017.8 2z' },
]

// İlçe linkleri — SEO iç linkleme için
const districts = [
  { slug: 'konak',      name: 'Konak' },
  { slug: 'bornova',    name: 'Bornova' },
  { slug: 'buca',       name: 'Buca' },
  { slug: 'karsiyaka',  name: 'Karşıyaka' },
  { slug: 'karabaglar', name: 'Karabağlar' },
  { slug: 'bayrakli',   name: 'Bayraklı' },
  { slug: 'cigli',      name: 'Çiğli' },
  { slug: 'balcova',    name: 'Balçova' },
  { slug: 'gaziemir',   name: 'Gaziemir' },
  { slug: 'narlidere',  name: 'Narlıdere' },
  { slug: 'menemen',    name: 'Menemen' },
  { slug: 'guzelbahce', name: 'Güzelbahçe' },
]

const email = ref('')
const subscribed = ref(false)

const subscribe = () => {
  if (email.value) {
    subscribed.value = true
    email.value = ''
  }
}
</script>

<template>
  <footer class="bg-[#020b18] text-slate-300 relative overflow-hidden">
    <!-- Top glow line -->
    <div class="h-px bg-gradient-to-r from-transparent via-[#00b4ff]/50 to-transparent"></div>

    <!-- Ambient background -->
    <div class="absolute inset-0 overflow-hidden pointer-events-none">
      <div class="absolute -top-40 -left-40 w-96 h-96 rounded-full bg-[#00b4ff]/3 blur-3xl"></div>
      <div class="absolute -bottom-40 -right-40 w-96 h-96 rounded-full bg-[#0066cc]/3 blur-3xl"></div>
    </div>

    <!-- Layer 1: Newsletter + Social -->
    <div class="relative border-b border-[#1e3a5f]/40">
      <div class="max-w-7xl mx-auto px-4 md:px-8 py-10">
        <div class="flex flex-col lg:flex-row items-center justify-between gap-8">
          <!-- Newsletter -->
          <div class="flex-1 max-w-xl">
            <div class="flex items-center gap-2 mb-3">
              <span class="text-[#00b4ff] text-xl">📧</span>
              <h3 class="text-white font-bold text-lg">Haber Bültenine Katılın</h3>
            </div>
            <p class="text-slate-500 text-sm mb-4">
              Kampanyalar, teknik duyurular ve özel fırsatlar için e-posta listemize kaydolun.
            </p>
            <div v-if="!subscribed" class="flex gap-2">
              <input
                v-model="email"
                type="email"
                placeholder="e-posta adresiniz"
                class="flex-1 px-4 py-3 bg-[#0a1e3d] border border-[#1e3a5f] rounded-lg text-sm text-white placeholder-slate-600 focus:outline-none focus:border-[#00b4ff]/60 transition-colors"
                @keydown.enter="subscribe"
              />
              <button
                class="px-5 py-3 bg-gradient-to-r from-[#00b4ff] to-[#0066cc] text-white text-sm font-semibold rounded-lg hover:opacity-90 transition-opacity whitespace-nowrap"
                @click="subscribe"
              >
                Kayıt Ol
              </button>
            </div>
            <div v-else class="flex items-center gap-2 text-[#34d399] text-sm font-medium">
              <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
              </svg>
              Başarıyla abone oldunuz!
            </div>
          </div>

          <!-- Divider -->
          <div class="hidden lg:block w-px h-20 bg-[#1e3a5f]"></div>

          <!-- Social links -->
          <div class="text-center lg:text-right">
            <p class="text-xs text-slate-500 uppercase tracking-widest mb-4">Takipte Kalın</p>
            <div class="flex items-center gap-3 justify-center lg:justify-end">
              <a
                v-for="social in socialLinks"
                :key="social.name"
                :href="social.href"
                :title="social.name"
                class="w-10 h-10 rounded-lg bg-[#0a1e3d] border border-[#1e3a5f] flex items-center justify-center text-slate-400 hover:text-[#00b4ff] hover:border-[#00b4ff]/40 hover:bg-[#00b4ff]/5 transition-all duration-200"
              >
                <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" :d="social.icon" />
                </svg>
              </a>
            </div>
            <!-- Contact quick -->
            <div class="mt-4 space-y-1">
              <a href="tel:+905469118061" class="flex items-center justify-center lg:justify-end gap-2 text-sm text-slate-400 hover:text-white transition-colors">
                <span class="text-[#00b4ff]">📞</span> 0546 911 80 61
              </a>
              <a href="mailto:destek@turkteknik.com.tr" class="flex items-center justify-center lg:justify-end gap-2 text-sm text-slate-400 hover:text-white transition-colors">
                <span class="text-[#00b4ff]">✉️</span> destek@turkteknik.com.tr
              </a>
            </div>
          </div>
        </div>
      </div>
    </div>

    <!-- Layer 2: Main Links Grid -->
    <div class="relative border-b border-[#1e3a5f]/40">
      <div class="max-w-7xl mx-auto px-4 md:px-8 py-12">
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-12">
          <!-- Brand column -->
          <div class="space-y-4">
            <Link :href="route('home')" class="flex items-center gap-3 group">
              <div class="w-10 h-10 rounded-lg bg-gradient-to-br from-[#00b4ff] to-[#0066cc] flex items-center justify-center shadow-[0_0_20px_rgba(0,180,255,0.3)]">
                <span class="text-white font-black text-lg leading-none">T</span>
              </div>
              <div class="flex flex-col leading-tight">
                <span class="text-white font-bold text-lg">TürkTeknik</span>
                <span class="text-[#00b4ff] text-[10px] font-medium tracking-widest uppercase">Teknik Çözümler</span>
              </div>
            </Link>
            <p class="text-slate-500 text-sm leading-relaxed">
              İnternet, uydu, güvenlik kamerası ve elektrik teknik servis alanlarında İzmir'in güvenilir çözüm ortağı. Profesyonel ekip ve 7/24 destek.
            </p>
          </div>

          <!-- Link columns -->
          <div
            v-for="col in columns"
            :key="col.title"
            class="space-y-4"
          >
            <h4 class="flex items-center gap-2 text-white font-semibold text-sm">
              <span>{{ col.icon }}</span>
              {{ col.title }}
            </h4>
            <ul class="space-y-2">
              <li v-for="link in col.links" :key="link.label">
                <Link
                  :href="link.href"
                  class="flex items-center gap-2 text-xs text-slate-500 hover:text-white transition-colors group"
                >
                  <span class="w-1 h-1 rounded-full bg-[#1e3a5f] group-hover:bg-[#00b4ff] transition-colors flex-shrink-0"></span>
                  {{ link.label }}
                  <span
                    v-if="link.badge"
                    class="ml-auto px-1.5 py-0.5 rounded text-[10px] font-bold leading-none bg-[#00b4ff]/20 text-[#00b4ff]"
                  >{{ link.badge }}</span>
                </Link>
              </li>
            </ul>
          </div>
        </div>
      </div>
    </div>

    <!-- Layer 2.5: Hizmet Bölgelerimiz (SEO iç linkleme) -->
    <div class="relative border-b border-[#1e3a5f]/40">
      <div class="max-w-7xl mx-auto px-4 md:px-8 py-8">
        <p class="text-xs text-slate-500 uppercase tracking-widest font-semibold mb-5 flex items-center gap-2">
          <span class="text-[#00b4ff]">📍</span> İzmir'de Hizmet Verdiğimiz İlçeler
        </p>
        <div class="flex flex-wrap gap-2">
          <a
            v-for="d in districts"
            :key="d.slug"
            :href="`/izmir/${d.slug}`"
            class="px-3 py-1.5 rounded-lg bg-[#0a1e3d] border border-[#1e3a5f] text-xs text-slate-400 hover:text-[#00b4ff] hover:border-[#00b4ff]/40 transition-all duration-150"
          >{{ d.name }}</a>
        </div>
      </div>
    </div>

    <!-- Layer 3: Bottom bar -->
    <div class="relative">
      <div class="max-w-7xl mx-auto px-4 md:px-8 py-6">
        <div class="flex flex-col md:flex-row items-center justify-between gap-4 text-xs text-slate-600">
          <div class="flex flex-wrap items-center justify-center md:justify-start gap-4">
            <span>© {{ new Date().getFullYear() }} TürkTeknik. Tüm hakları saklıdır.</span>
            <span class="hidden md:block text-slate-800">|</span>
            <a href="#" class="hover:text-slate-400 transition-colors">Gizlilik Politikası</a>
            <a href="#" class="hover:text-slate-400 transition-colors">Kullanım Koşulları</a>
          </div>
          <div class="flex items-center gap-2">
            <span class="flex items-center gap-1.5">
              <span class="w-2 h-2 rounded-full bg-[#34d399] animate-pulse"></span>
              <span class="text-[#34d399]">Sistemler Aktif</span>
            </span>
          </div>
        </div>
      </div>
    </div>
  </footer>
</template>

<script setup lang="ts">
import { ref, onMounted, onUnmounted } from 'vue'
import { Link, usePage, router } from '@inertiajs/vue3'

interface PageProps {
  auth: {
    user: { name: string; email: string; [key: string]: any } | null
  }
  [key: string]: any
}

const page = usePage<PageProps>()

// ──────────────────────────────────────────────
// State
// ──────────────────────────────────────────────
const scrolled      = ref(false)
const activeMenu    = ref<string | null>(null)  // desktop hover
const mobileOpen    = ref(false)
const mobileExpand  = ref<string | null>(null)  // mobile accordion

let closeTimer: ReturnType<typeof setTimeout> | null = null

const handleScroll = () => { scrolled.value = window.scrollY > 20 }
onMounted(() => { window.addEventListener('scroll', handleScroll) })
onUnmounted(() => { window.removeEventListener('scroll', handleScroll) })

// Close mobile on route change
router.on('navigate', () => { mobileOpen.value = false; mobileExpand.value = null })

// Desktop: hover with small delay before closing
const openMenu = (key: string) => {
  if (closeTimer) clearTimeout(closeTimer)
  activeMenu.value = key
}
const scheduleClose = () => {
  closeTimer = setTimeout(() => { activeMenu.value = null }, 120)
}
const keepOpen = () => {
  if (closeTimer) clearTimeout(closeTimer)
}

// Mobile accordion toggle
const toggleMobile = (key: string) => {
  mobileExpand.value = mobileExpand.value === key ? null : key
}
</script>

<template>
  <nav
    :class="[
      'fixed top-0 left-0 right-0 z-50 transition-all duration-300',
      scrolled
        ? 'bg-[#0a1628]/98 backdrop-blur-xl shadow-[0_4px_30px_rgba(0,180,255,0.12)]'
        : 'bg-gradient-to-b from-[#0a1628]/95 to-[#0a1628]/0',
    ]"
  >
    <div class="max-w-7xl mx-auto px-4 md:px-6">
      <div class="flex items-center justify-between h-18 py-3">

        <!-- ── LOGO ── -->
        <Link :href="route('home')" class="flex items-center gap-3 group flex-shrink-0">
          <div class="relative">
            <div class="w-9 h-9 rounded-lg bg-gradient-to-br from-[#00b4ff] to-[#0055cc] flex items-center justify-center shadow-[0_0_20px_rgba(0,180,255,0.35)] group-hover:shadow-[0_0_30px_rgba(0,180,255,0.6)] transition-all">
              <span class="text-white font-black text-base leading-none">T</span>
            </div>
            <span class="absolute -top-0.5 -right-0.5 w-2.5 h-2.5 bg-[#ff6b00] rounded-full animate-pulse"></span>
          </div>
          <div class="flex flex-col leading-tight">
            <span class="text-white font-bold text-base tracking-wide">TürkTeknik</span>
            <a href="tel:+905469118061" class="text-[#00b4ff] text-[10px] font-bold tracking-tight flex items-center gap-1 hover:text-[#33c6ff] transition-colors" @click.stop>
              <i class="fas fa-phone text-[8px]"></i> 0546 911 80 61
            </a>
          </div>
        </Link>

        <!-- ── DESKTOP NAV ── -->
        <div class="hidden lg:flex items-center gap-0.5">

          <!-- Hizmetler -->
          <div class="relative" @mouseenter="openMenu('hizmetler')" @mouseleave="scheduleClose">
            <button
              :class="['flex items-center gap-1 px-3 py-2 rounded-lg text-sm font-medium transition-all', activeMenu === 'hizmetler' ? 'text-[#00b4ff] bg-white/5' : 'text-slate-300 hover:text-white hover:bg-white/5']"
              @click="openMenu(activeMenu === 'hizmetler' ? '' : 'hizmetler')"
            >
              Hizmetler
              <i :class="['fas fa-chevron-down text-[9px] transition-transform', activeMenu === 'hizmetler' ? 'rotate-180 text-[#00b4ff]' : '']"></i>
            </button>
            <Transition enter-active-class="transition-all duration-200 ease-out" enter-from-class="opacity-0 translate-y-1 scale-95" enter-to-class="opacity-100 translate-y-0 scale-100" leave-active-class="transition-all duration-150" leave-from-class="opacity-100" leave-to-class="opacity-0 translate-y-1">
              <div v-if="activeMenu === 'hizmetler'" class="absolute top-full left-0 mt-1 w-52 bg-[#0a1e3d] border border-[#1e3a5f] rounded-xl shadow-2xl overflow-hidden" @mouseenter="keepOpen" @mouseleave="scheduleClose">
                <div class="p-2">
                  <Link v-for="s in [
                    { label: 'İnternet Teknik Servis', href: route('services.internet'), icon: '🌐' },
                    { label: 'Uydu & Çanak Anten', href: route('services.satellite'), icon: '📡' },
                    { label: 'Güvenlik Kamerası', href: route('services.camera'), icon: '📷' },
                    { label: 'Elektrik Tesisatı', href: route('services.elektrik'), icon: '⚡' },
                  ]" :key="s.label" :href="s.href"
                    class="flex items-center gap-2.5 px-3 py-2.5 rounded-lg text-sm text-slate-300 hover:text-white hover:bg-[#00b4ff]/10 transition-all group">
                    <span class="text-sm">{{ s.icon }}</span>
                    <span class="flex-1">{{ s.label }}</span>
                    <i class="fas fa-chevron-right text-[9px] text-[#00b4ff] opacity-0 group-hover:opacity-100 transition-opacity"></i>
                  </Link>
                  <div class="border-t border-[#1e3a5f] my-1.5"></div>
                  <Link :href="route('service-requests.create')"
                    class="flex items-center gap-2.5 px-3 py-2.5 rounded-lg text-sm text-[#00b4ff] hover:bg-[#00b4ff]/10 transition-all font-semibold">
                    <i class="fas fa-clipboard-list text-xs"></i>
                    Servis Talebi Oluştur
                  </Link>
                </div>
              </div>
            </Transition>
          </div>

          <!-- Bölgeler -->
          <div class="relative" @mouseenter="openMenu('bolgeler')" @mouseleave="scheduleClose">
            <button
              :class="['flex items-center gap-1 px-3 py-2 rounded-lg text-sm font-medium transition-all', activeMenu === 'bolgeler' ? 'text-[#00b4ff] bg-white/5' : 'text-slate-300 hover:text-white hover:bg-white/5']"
              @click="openMenu(activeMenu === 'bolgeler' ? '' : 'bolgeler')"
            >
              Bölgeler
              <i :class="['fas fa-chevron-down text-[9px] transition-transform', activeMenu === 'bolgeler' ? 'rotate-180 text-[#00b4ff]' : '']"></i>
            </button>
            <Transition enter-active-class="transition-all duration-200 ease-out" enter-from-class="opacity-0 translate-y-1 scale-95" enter-to-class="opacity-100 translate-y-0 scale-100" leave-active-class="transition-all duration-150" leave-from-class="opacity-100" leave-to-class="opacity-0">
              <div v-if="activeMenu === 'bolgeler'" class="absolute top-full left-0 mt-1 w-56 bg-[#0a1e3d] border border-[#1e3a5f] rounded-xl shadow-2xl overflow-hidden" @mouseenter="keepOpen" @mouseleave="scheduleClose">
                <div class="p-2">
                  <p class="text-[10px] text-slate-500 uppercase tracking-widest font-semibold px-3 pt-1 pb-2">İzmir İlçeleri</p>
                  <div class="grid grid-cols-2 gap-0.5">
                    <Link v-for="d in [
                      { name: 'Konak',      slug: 'konak' },
                      { name: 'Bornova',    slug: 'bornova' },
                      { name: 'Buca',       slug: 'buca' },
                      { name: 'Karşıyaka',  slug: 'karsiyaka' },
                      { name: 'Karabağlar', slug: 'karabaglar' },
                      { name: 'Bayraklı',   slug: 'bayrakli' },
                      { name: 'Çiğli',      slug: 'cigli' },
                      { name: 'Balçova',    slug: 'balcova' },
                      { name: 'Gaziemir',   slug: 'gaziemir' },
                      { name: 'Narlıdere',  slug: 'narlidere' },
                      { name: 'Menemen',    slug: 'menemen' },
                      { name: 'Güzelbahçe', slug: 'guzelbahce' },
                    ]" :key="d.slug" :href="`/izmir/${d.slug}`"
                      class="flex items-center gap-1.5 px-2.5 py-2 rounded-lg text-xs text-slate-300 hover:text-white hover:bg-[#00b4ff]/10 transition-all">
                      <i class="fas fa-map-marker-alt text-[9px] text-[#00b4ff]"></i>
                      {{ d.name }}
                    </Link>
                  </div>
                </div>
              </div>
            </Transition>
          </div>

          <!-- Rehberler -->
          <div class="relative" @mouseenter="openMenu('rehberler')" @mouseleave="scheduleClose">
            <button
              :class="['flex items-center gap-1 px-3 py-2 rounded-lg text-sm font-medium transition-all', activeMenu === 'rehberler' ? 'text-[#00b4ff] bg-white/5' : 'text-slate-300 hover:text-white hover:bg-white/5']"
              @click="openMenu(activeMenu === 'rehberler' ? '' : 'rehberler')"
            >
              Rehberler
              <i :class="['fas fa-chevron-down text-[9px] transition-transform', activeMenu === 'rehberler' ? 'rotate-180 text-[#00b4ff]' : '']"></i>
            </button>
            <Transition enter-active-class="transition-all duration-200 ease-out" enter-from-class="opacity-0 translate-y-1 scale-95" enter-to-class="opacity-100 translate-y-0 scale-100" leave-active-class="transition-all duration-150" leave-from-class="opacity-100" leave-to-class="opacity-0">
              <div v-if="activeMenu === 'rehberler'" class="absolute top-full left-0 mt-1 w-56 bg-[#0a1e3d] border border-[#1e3a5f] rounded-xl shadow-2xl overflow-hidden" @mouseenter="keepOpen" @mouseleave="scheduleClose">
                <div class="p-2">
                  <p class="text-[10px] text-slate-500 uppercase tracking-widest font-semibold px-3 pt-1 pb-2">Popüler Rehberler</p>
                  <Link v-for="g in [
                    { label: 'ZTE Modem Kurulumu',     href: '/rehberler/zte-modem-kurulumu',       icon: '🔧' },
                    { label: 'TP-Link Modem Kurulumu', href: '/rehberler/tp-link-modem-kurulumu',   icon: '🔧' },
                    { label: 'Çanak Anten Ayarı',      href: '/rehberler/canak-anten-ayari',        icon: '📡' },
                    { label: 'Kamera Uzaktan İzleme',  href: '/rehberler/kamera-uzaktan-izleme',    icon: '📱' },
                    { label: 'Türk Telekom Arızası',   href: '/rehberler/turk-telekom-arizasi',     icon: '⚠️' },
                  ]" :key="g.label" :href="g.href"
                    class="flex items-center gap-2 px-3 py-2 rounded-lg text-xs text-slate-300 hover:text-white hover:bg-[#00b4ff]/10 transition-all">
                    <span>{{ g.icon }}</span>
                    {{ g.label }}
                  </Link>
                  <div class="border-t border-[#1e3a5f] my-1.5"></div>
                  <Link href="/rehberler"
                    class="flex items-center gap-2 px-3 py-2.5 rounded-lg text-sm text-[#00b4ff] hover:bg-[#00b4ff]/10 transition-all font-semibold">
                    <i class="fas fa-book-open text-xs"></i>
                    Tüm Rehberler
                  </Link>
                </div>
              </div>
            </Transition>
          </div>

          <!-- Simple links -->
          <Link href="/referanslar" class="px-3 py-2 rounded-lg text-sm font-medium text-slate-300 hover:text-white hover:bg-white/5 transition-all">
            Referanslar
          </Link>
          <Link :href="route('about')" class="px-3 py-2 rounded-lg text-sm font-medium text-slate-300 hover:text-white hover:bg-white/5 transition-all">
            Hakkımızda
          </Link>
          <Link :href="route('contact')" class="px-3 py-2 rounded-lg text-sm font-medium text-slate-300 hover:text-white hover:bg-white/5 transition-all">
            İletişim
          </Link>
        </div>

        <!-- ── DESKTOP CTA ── -->
        <div class="hidden lg:flex items-center gap-2 flex-shrink-0">
          <Link :href="route('internet-speed-test')"
            class="px-3 py-2 text-xs text-slate-400 hover:text-[#00b4ff] transition-colors font-medium flex items-center gap-1">
            <i class="fas fa-tachometer-alt text-xs"></i> Hız Testi
          </Link>
          <template v-if="page.props.auth.user">
            <Link :href="route('logout')" method="post" as="button" class="px-3 py-2 text-sm text-red-400 hover:text-red-300 transition-colors">Çıkış</Link>
          </template>
          <template v-else>
            <Link :href="route('login')" class="px-3 py-2 text-sm text-slate-400 hover:text-white transition-colors">Giriş</Link>
          </template>
          <Link :href="route('service-requests.create')"
            class="px-4 py-2 bg-gradient-to-r from-[#00b4ff] to-[#0055cc] text-white text-sm font-bold rounded-lg hover:from-[#33c6ff] hover:to-[#0066dd] transition-all shadow-[0_0_15px_rgba(0,180,255,0.25)] hover:shadow-[0_0_25px_rgba(0,180,255,0.45)]">
            Servis Talebi
          </Link>
        </div>

        <!-- ── MOBILE HAMBURGER ── -->
        <button
          class="lg:hidden text-white p-2 rounded-lg hover:bg-white/10 transition-colors"
          @click="mobileOpen = !mobileOpen"
          aria-label="Menü"
        >
          <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path v-if="!mobileOpen" stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M4 6h16M4 12h16M4 18h16" />
            <path v-else stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M6 18L18 6M6 6l12 12" />
          </svg>
        </button>
      </div>
    </div>

    <!-- ── MOBILE MENU ── -->
    <Transition
      enter-active-class="transition-all duration-300 ease-out"
      enter-from-class="opacity-0 max-h-0"
      enter-to-class="opacity-100 max-h-screen"
      leave-active-class="transition-all duration-200 ease-in"
      leave-from-class="opacity-100 max-h-screen"
      leave-to-class="opacity-0 max-h-0"
    >
      <div v-if="mobileOpen" class="lg:hidden overflow-hidden bg-[#0a1628]/99 backdrop-blur-xl border-t border-[#1e3a5f]/50">
        <div class="max-w-7xl mx-auto px-4 py-3 space-y-0.5">

          <!-- Hizmetler accordion -->
          <div>
            <button @click="toggleMobile('hizmetler')" class="w-full flex items-center justify-between px-4 py-3 rounded-xl text-slate-200 hover:bg-white/5 text-sm font-semibold transition-all">
              <span class="flex items-center gap-2"><i class="fas fa-tools text-[#00b4ff] text-xs"></i> Hizmetler</span>
              <i :class="['fas fa-chevron-down text-[10px] text-slate-400 transition-transform', mobileExpand === 'hizmetler' ? 'rotate-180' : '']"></i>
            </button>
            <div v-if="mobileExpand === 'hizmetler'" class="ml-4 pb-1 space-y-0.5">
              <Link v-for="s in [
                { label: 'İnternet Teknik Servis', href: route('services.internet'), icon: '🌐' },
                { label: 'Uydu & Çanak Anten', href: route('services.satellite'), icon: '📡' },
                { label: 'Güvenlik Kamerası', href: route('services.camera'), icon: '📷' },
                { label: 'Elektrik Tesisatı', href: route('services.elektrik'), icon: '⚡' },
              ]" :key="s.label" :href="s.href"
                class="flex items-center gap-2.5 px-4 py-2.5 rounded-xl text-sm text-slate-400 hover:text-white hover:bg-white/5 transition-all"
                @click="mobileOpen = false">
                <span>{{ s.icon }}</span> {{ s.label }}
              </Link>
            </div>
          </div>

          <!-- Bölgeler accordion -->
          <div>
            <button @click="toggleMobile('bolgeler')" class="w-full flex items-center justify-between px-4 py-3 rounded-xl text-slate-200 hover:bg-white/5 text-sm font-semibold transition-all">
              <span class="flex items-center gap-2"><i class="fas fa-map-marker-alt text-[#00b4ff] text-xs"></i> Bölgeler</span>
              <i :class="['fas fa-chevron-down text-[10px] text-slate-400 transition-transform', mobileExpand === 'bolgeler' ? 'rotate-180' : '']"></i>
            </button>
            <div v-if="mobileExpand === 'bolgeler'" class="ml-4 pb-1">
              <div class="grid grid-cols-2 gap-0.5">
                <Link v-for="d in [
                  { name: 'Konak', slug: 'konak' }, { name: 'Bornova', slug: 'bornova' },
                  { name: 'Buca', slug: 'buca' }, { name: 'Karşıyaka', slug: 'karsiyaka' },
                  { name: 'Karabağlar', slug: 'karabaglar' }, { name: 'Bayraklı', slug: 'bayrakli' },
                  { name: 'Çiğli', slug: 'cigli' }, { name: 'Balçova', slug: 'balcova' },
                  { name: 'Gaziemir', slug: 'gaziemir' }, { name: 'Narlıdere', slug: 'narlidere' },
                  { name: 'Menemen', slug: 'menemen' }, { name: 'Güzelbahçe', slug: 'guzelbahce' },
                ]" :key="d.slug" :href="`/izmir/${d.slug}`"
                  class="px-3 py-2 rounded-xl text-xs text-slate-400 hover:text-white hover:bg-white/5 transition-all"
                  @click="mobileOpen = false">
                  {{ d.name }}
                </Link>
              </div>
            </div>
          </div>

          <!-- Rehberler accordion -->
          <div>
            <button @click="toggleMobile('rehberler')" class="w-full flex items-center justify-between px-4 py-3 rounded-xl text-slate-200 hover:bg-white/5 text-sm font-semibold transition-all">
              <span class="flex items-center gap-2"><i class="fas fa-book-open text-[#00b4ff] text-xs"></i> Rehberler</span>
              <i :class="['fas fa-chevron-down text-[10px] text-slate-400 transition-transform', mobileExpand === 'rehberler' ? 'rotate-180' : '']"></i>
            </button>
            <div v-if="mobileExpand === 'rehberler'" class="ml-4 pb-1 space-y-0.5">
              <Link v-for="g in [
                { label: 'ZTE Modem Kurulumu',     href: '/rehberler/zte-modem-kurulumu' },
                { label: 'TP-Link Modem Kurulumu', href: '/rehberler/tp-link-modem-kurulumu' },
                { label: 'Çanak Anten Ayarı',      href: '/rehberler/canak-anten-ayari' },
                { label: 'Kamera Uzaktan İzleme',  href: '/rehberler/kamera-uzaktan-izleme' },
                { label: 'Türk Telekom Arızası',   href: '/rehberler/turk-telekom-arizasi' },
                { label: 'Tüm Rehberler →',        href: '/rehberler' },
              ]" :key="g.label" :href="g.href"
                class="flex items-center gap-2 px-4 py-2.5 rounded-xl text-sm text-slate-400 hover:text-white hover:bg-white/5 transition-all"
                @click="mobileOpen = false">
                {{ g.label }}
              </Link>
            </div>
          </div>

          <!-- Simple links -->
          <Link href="/referanslar" class="flex items-center gap-2 px-4 py-3 rounded-xl text-sm font-semibold text-slate-200 hover:bg-white/5 transition-all" @click="mobileOpen = false">
            <i class="fas fa-star text-[#00b4ff] text-xs"></i> Referanslar
          </Link>
          <Link :href="route('about')" class="flex items-center gap-2 px-4 py-3 rounded-xl text-sm font-semibold text-slate-200 hover:bg-white/5 transition-all" @click="mobileOpen = false">
            <i class="fas fa-info-circle text-[#00b4ff] text-xs"></i> Hakkımızda
          </Link>
          <Link :href="route('contact')" class="flex items-center gap-2 px-4 py-3 rounded-xl text-sm font-semibold text-slate-200 hover:bg-white/5 transition-all" @click="mobileOpen = false">
            <i class="fas fa-envelope text-[#00b4ff] text-xs"></i> İletişim
          </Link>
          <Link :href="route('internet-speed-test')" class="flex items-center gap-2 px-4 py-3 rounded-xl text-sm font-semibold text-slate-200 hover:bg-white/5 transition-all" @click="mobileOpen = false">
            <i class="fas fa-tachometer-alt text-[#00b4ff] text-xs"></i> Hız Testi
          </Link>

          <!-- Mobile CTA strip -->
          <div class="pt-3 mt-2 border-t border-[#1e3a5f]/50 grid grid-cols-2 gap-2">
            <template v-if="page.props.auth.user">
              <Link :href="route('logout')" method="post" as="button" class="py-3 text-center text-sm text-red-400 hover:text-red-300 font-medium rounded-xl hover:bg-white/5 transition-all" @click="mobileOpen = false">Çıkış Yap</Link>
            </template>
            <template v-else>
              <Link :href="route('login')" class="py-3 text-center text-sm text-slate-300 hover:text-white font-medium rounded-xl hover:bg-white/5 transition-all" @click="mobileOpen = false">Giriş Yap</Link>
            </template>
            <Link :href="route('service-requests.create')" class="py-3 bg-gradient-to-r from-[#00b4ff] to-[#0055cc] text-white text-sm font-bold rounded-xl text-center shadow-lg" @click="mobileOpen = false">
              Servis Talebi
            </Link>
          </div>

        </div>
      </div>
    </Transition>
  </nav>

  <!-- ── FLOATING PHONE BUTTON (blue, above WP icon) ── -->
  <a
    href="tel:+905469118061"
    aria-label="Hemen Ara"
    class="fixed right-6 z-50 w-11 h-11 rounded-full flex items-center justify-center phone-float-btn"
    style="bottom: 4.5rem;"
  >
    <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-white" viewBox="0 0 24 24" fill="currentColor">
      <path d="M6.6 10.8c1.4 2.8 3.8 5.1 6.6 6.6l2.2-2.2c.3-.3.7-.4 1-.2 1.1.4 2.3.6 3.6.6.6 0 1 .4 1 1V20c0 .6-.4 1-1 1C10.6 21 3 13.4 3 4c0-.6.4-1 1-1h3.5c.6 0 1 .4 1 1 0 1.3.2 2.5.6 3.6.1.3 0 .7-.2 1L6.6 10.8z"/>
    </svg>
  </a>
</template>

<style scoped>
@keyframes float-bob {
  0%, 100% { transform: translateY(0); }
  50%       { transform: translateY(-6px); }
}
.phone-float-btn {
  background: #0ea5e9;
  box-shadow: 0 4px 16px rgba(14,165,233,0.45);
  animation: float-bob 2.8s ease-in-out infinite;
}
.phone-float-btn:hover {
  animation: none;
  transform: scale(1.12);
  box-shadow: 0 6px 24px rgba(14,165,233,0.65);
}
</style>

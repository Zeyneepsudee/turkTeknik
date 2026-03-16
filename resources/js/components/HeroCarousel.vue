<script setup lang="ts">
import { ref, onMounted, onUnmounted, computed } from 'vue'
import { Link } from '@inertiajs/vue3'

interface Slide {
  id: number
  tag: string
  title: string
  subtitle: string
  description: string
  cta: string
  ctaHref: string
  ctaSecondary: string
  ctaSecondaryHref: string
  gradient: string
  accent: string
  icon: string
  stats: { value: string; label: string }[]
}

const slides: Slide[] = [
  {
    id: 1,
    tag: 'Süper Hızlı İnternet',
    title: 'Kesintisiz Fiber\nBağlantı',
    subtitle: 'Türkiye\'nin her köşesine',
    description: 'Simetrik fiber altyapımızla yüksek hızlarla interneti yeniden keşfedin. Kurumsal ve bireysel paketlerimizle kesintisiz deneyim.',
    cta: 'Hizmetleri İncele',
    ctaHref: route('services.internet'),
    ctaSecondary: 'Hız Testi Yap',
    ctaSecondaryHref: route('internet-speed-test'),
    gradient: 'from-[#020b18] via-[#041830] to-[#020b18]',
    accent: '#00b4ff',
    icon: '🌐',
    stats: [
      { value: '1 Gbps', label: 'Maks. Hız' },
      { value: '%99.9', label: 'Uptime' },
      { value: '7/24', label: 'Destek' },
    ],
  },
  {
    id: 2,
    tag: 'Uydu Sistemleri',
    title: 'Kristal Netliğinde\nBağlantı',
    subtitle: 'Her yerde, her zaman',
    description: 'En uzak noktalara bile uydu internet çözümlerimizle kesintisiz bağlantı sağlıyoruz. Merkezi uydu sistemleri kurulumu ve bakımı.',
    cta: 'Uydu Çözümlerimiz',
    ctaHref: route('services.satellite'),
    ctaSecondary: 'Servis Talebi',
    ctaSecondaryHref: route('service-request'),
    gradient: 'from-[#020a1f] via-[#040d28] to-[#020a1f]',
    accent: '#a78bfa',
    icon: '🛰️',
    stats: [
      { value: '500+', label: 'Kurulum' },
      { value: 'Full HD', label: 'Yayın' },
      { value: '2sa', label: 'Müdahale' },
    ],
  },
  {
    id: 3,
    tag: 'Güvenlik Kameraları',
    title: 'Akıllı Güvenlik\nSistemleri',
    subtitle: 'Evinizi ve iş yerinizi koruyun',
    description: 'IP kamera sistemleri, NVR/DVR kurulumu ve uzaktan izleme teknolojileriyle 7/24 güvenlik sağlıyoruz.',
    cta: 'Kamera Sistemleri',
    ctaHref: route('services.camera'),
    ctaSecondary: 'Bilgi Al',
    ctaSecondaryHref: route('contact'),
    gradient: 'from-[#0a0f1a] via-[#101a2e] to-[#0a0f1a]',
    accent: '#34d399',
    icon: '📷',
    stats: [
      { value: '4K', label: 'Çözünürlük' },
      { value: '7/24', label: 'İzleme' },
      { value: 'AI', label: 'Analitik' },
    ],
  },
  {
    id: 4,
    tag: 'Elektrik & Teknik Servis',
    title: 'Güvenilir Elektrik\nÇözümleri',
    subtitle: 'Uzman ekibimizle yanınızdayız',
    description: 'Elektrik tesisatı, pano montajı ve genel teknik servis hizmetlerimizle altyapınızı güçlendiriyoruz.',
    cta: 'Hizmetlerimiz',
    ctaHref: route('services.elektrik'),
    ctaSecondary: 'Randevu Al',
    ctaSecondaryHref: route('service-request'),
    gradient: 'from-[#1a0f00] via-[#1f1500] to-[#1a0f00]',
    accent: '#fbbf24',
    icon: '⚡',
    stats: [
      { value: '1000+', label: 'Müşteri' },
      { value: '15 Yıl', label: 'Deneyim' },
      { value: 'Hızlı', label: 'Servis' },
    ],
  },
]

const current = ref(0)
const isTransitioning = ref(false)
const autoplayInterval = ref<ReturnType<typeof setInterval> | null>(null)
const direction = ref<'next' | 'prev'>('next')

const activeSlide = computed(() => slides[current.value])

const goTo = (index: number, dir: 'next' | 'prev' = 'next') => {
  if (isTransitioning.value) return
  direction.value = dir
  isTransitioning.value = true
  current.value = (index + slides.length) % slides.length
  setTimeout(() => (isTransitioning.value = false), 700)
}

const next = () => goTo(current.value + 1, 'next')
const prev = () => goTo(current.value - 1, 'prev')

const startAutoplay = () => {
  autoplayInterval.value = setInterval(next, 5500)
}
const stopAutoplay = () => {
  if (autoplayInterval.value) clearInterval(autoplayInterval.value)
}

onMounted(startAutoplay)
onUnmounted(stopAutoplay)
</script>

<template>
  <section
    class="relative min-h-[90vh] lg:min-h-screen overflow-hidden"
    @mouseenter="stopAutoplay"
    @mouseleave="startAutoplay"
  >
    <!-- Background slides -->
    <TransitionGroup name="slide-fade">
      <div
        v-for="(slide, index) in slides"
        v-show="index === current"
        :key="slide.id"
        :class="['absolute inset-0 bg-gradient-to-br transition-all duration-700', slide.gradient]"
      >
        <!-- Animated grid pattern -->
        <div
          class="absolute inset-0 opacity-[0.03]"
          style="background-image: linear-gradient(rgba(255,255,255,0.5) 1px, transparent 1px), linear-gradient(90deg, rgba(255,255,255,0.5) 1px, transparent 1px); background-size: 50px 50px;"
        ></div>

        <!-- Glow orbs -->
        <div
          :style="{ background: `radial-gradient(ellipse 60% 50% at 70% 50%, ${slide.accent}15, transparent)` }"
          class="absolute inset-0"
        ></div>
        <div
          :style="{ background: `radial-gradient(ellipse 40% 40% at 20% 80%, ${slide.accent}08, transparent)` }"
          class="absolute inset-0"
        ></div>
      </div>
    </TransitionGroup>

    <!-- Floating particles -->
    <div class="absolute inset-0 overflow-hidden pointer-events-none">
      <div
        v-for="i in 12"
        :key="i"
        class="absolute w-1 h-1 rounded-full opacity-20 animate-float"
        :style="{
          background: activeSlide.accent,
          left: `${(i * 8.3) % 100}%`,
          top: `${(i * 13.7) % 100}%`,
          animationDelay: `${i * 0.4}s`,
          animationDuration: `${4 + (i % 3)}s`,
        }"
      ></div>
    </div>

    <!-- Content -->
    <div class="relative z-10 max-w-7xl mx-auto px-4 md:px-8 min-h-[90vh] lg:min-h-screen flex flex-col justify-center pt-28 pb-20">
      <TransitionGroup name="content-fade">
        <div v-show="true" :key="current" class="grid lg:grid-cols-2 gap-12 items-center">
          <!-- Left content -->
          <div class="space-y-6">
            <!-- Tag badge -->
            <div
              class="inline-flex items-center gap-2 px-4 py-1.5 rounded-full border text-xs font-semibold uppercase tracking-widest"
              :style="{
                borderColor: activeSlide.accent + '40',
                color: activeSlide.accent,
                background: activeSlide.accent + '10',
              }"
            >
              <span class="text-base">{{ activeSlide.icon }}</span>
              {{ activeSlide.tag }}
            </div>

            <!-- Title -->
            <h1 class="text-4xl md:text-5xl lg:text-6xl font-black text-white leading-tight tracking-tight whitespace-pre-line">
              {{ activeSlide.title }}
            </h1>

            <!-- Subtitle -->
            <p class="text-lg font-medium" :style="{ color: activeSlide.accent }">
              {{ activeSlide.subtitle }}
            </p>

            <!-- Description -->
            <p class="text-slate-400 text-base leading-relaxed max-w-lg">
              {{ activeSlide.description }}
            </p>

            <!-- CTA buttons -->
            <div class="flex flex-wrap items-center gap-4 pt-2">
              <Link
                :href="activeSlide.ctaHref"
                class="group px-7 py-3.5 rounded-xl font-bold text-sm text-white transition-all duration-300 flex items-center gap-2"
                :style="{
                  background: `linear-gradient(135deg, ${activeSlide.accent}, ${activeSlide.accent}cc)`,
                  boxShadow: `0 0 30px ${activeSlide.accent}40`,
                }"
              >
                {{ activeSlide.cta }}
                <svg class="w-4 h-4 group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                </svg>
              </Link>
              <Link
                :href="activeSlide.ctaSecondaryHref"
                class="px-7 py-3.5 rounded-xl font-bold text-sm border transition-all duration-300 hover:bg-white/5"
                :style="{
                  borderColor: activeSlide.accent + '40',
                  color: activeSlide.accent,
                }"
              >
                {{ activeSlide.ctaSecondary }}
              </Link>
            </div>

            <!-- Stats -->
            <div class="flex flex-wrap gap-8 pt-4 border-t border-white/10">
              <div v-for="stat in activeSlide.stats" :key="stat.label" class="space-y-0.5">
                <div class="text-2xl font-black text-white">{{ stat.value }}</div>
                <div class="text-xs text-slate-500 uppercase tracking-wider">{{ stat.label }}</div>
              </div>
            </div>
          </div>

          <!-- Right visual -->
          <div class="hidden lg:flex items-center justify-center">
            <div class="relative">
              <!-- Outer ring -->
              <div
                class="w-72 h-72 rounded-full border-2 border-dashed animate-spin-slow opacity-30"
                :style="{ borderColor: activeSlide.accent }"
              ></div>
              <!-- Inner ring -->
              <div
                class="absolute inset-6 rounded-full border animate-spin-slow-reverse opacity-20"
                :style="{ borderColor: activeSlide.accent }"
              ></div>
              <!-- Center icon -->
              <div
                class="absolute inset-0 flex items-center justify-center"
              >
                <div
                  class="w-40 h-40 rounded-2xl flex items-center justify-center text-8xl"
                  :style="{
                    background: `radial-gradient(circle, ${activeSlide.accent}20, ${activeSlide.accent}05)`,
                    boxShadow: `0 0 60px ${activeSlide.accent}30, inset 0 0 40px ${activeSlide.accent}10`,
                    border: `1px solid ${activeSlide.accent}20`,
                  }"
                >
                  {{ activeSlide.icon }}
                </div>
              </div>
              <!-- Orbiting dots -->
              <div
                v-for="i in 3"
                :key="i"
                class="absolute w-4 h-4 rounded-full animate-orbit"
                :style="{
                  background: activeSlide.accent,
                  boxShadow: `0 0 10px ${activeSlide.accent}`,
                  animationDelay: `${(i - 1) * 1.5}s`,
                }"
              ></div>
            </div>
          </div>
        </div>
      </TransitionGroup>
    </div>

    <!-- Navigation arrows -->
    <button
      class="absolute left-4 md:left-8 top-1/2 -translate-y-1/2 z-20 w-12 h-12 rounded-full flex items-center justify-center bg-white/5 border border-white/10 text-white hover:bg-white/15 hover:border-white/30 transition-all duration-200 backdrop-blur-sm"
      @click="prev"
    >
      <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
      </svg>
    </button>
    <button
      class="absolute right-4 md:right-8 top-1/2 -translate-y-1/2 z-20 w-12 h-12 rounded-full flex items-center justify-center bg-white/5 border border-white/10 text-white hover:bg-white/15 hover:border-white/30 transition-all duration-200 backdrop-blur-sm"
      @click="next"
    >
      <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
      </svg>
    </button>

    <!-- Dots indicator -->
    <div class="absolute bottom-8 left-1/2 -translate-x-1/2 z-20 flex items-center gap-3">
      <button
        v-for="(slide, index) in slides"
        :key="slide.id"
        :class="[
          'transition-all duration-300 rounded-full',
          index === current ? 'w-8 h-2' : 'w-2 h-2 bg-white/30 hover:bg-white/50',
        ]"
        :style="index === current ? { background: activeSlide.accent, boxShadow: `0 0 10px ${activeSlide.accent}` } : {}"
        @click="goTo(index)"
      ></button>
    </div>

    <!-- Slide counter -->
    <div class="absolute bottom-8 right-8 z-20 text-xs text-slate-500 font-mono">
      <span class="text-white font-bold">{{ String(current + 1).padStart(2, '0') }}</span>
      <span class="mx-1">/</span>
      {{ String(slides.length).padStart(2, '0') }}
    </div>
  </section>
</template>

<style scoped>
.slide-fade-enter-active,
.slide-fade-leave-active {
  transition: all 0.7s ease;
}
.slide-fade-enter-from {
  opacity: 0;
}
.slide-fade-leave-to {
  opacity: 0;
}

.content-fade-enter-active {
  transition: all 0.6s ease;
  transition-delay: 0.1s;
}
.content-fade-enter-from {
  opacity: 0;
  transform: translateY(20px);
}

@keyframes float {
  0%, 100% { transform: translateY(0px) scale(1); }
  50% { transform: translateY(-20px) scale(1.5); }
}
.animate-float {
  animation: float linear infinite;
}

@keyframes spin-slow {
  from { transform: rotate(0deg); }
  to { transform: rotate(360deg); }
}
.animate-spin-slow {
  animation: spin-slow 20s linear infinite;
}
.animate-spin-slow-reverse {
  animation: spin-slow 15s linear infinite reverse;
}

@keyframes orbit {
  0% { transform: rotate(0deg) translateX(144px) rotate(0deg); }
  100% { transform: rotate(360deg) translateX(144px) rotate(-360deg); }
}
.animate-orbit {
  top: 50%;
  left: 50%;
  margin: -8px;
  animation: orbit 4s linear infinite;
}
</style>

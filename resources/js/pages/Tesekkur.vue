<script setup lang="ts">
import { Link } from '@inertiajs/vue3'
import AppLayout from '@/layouts/AppLayout.vue'
import SEO from '@/components/SEO.vue'

defineOptions({ layout: AppLayout })
</script>

<template>
  <SEO
    title="Talebiniz Alındı - TürkTeknik"
    description="Servis talebiniz başarıyla alındı. Ekibimiz en kısa sürede sizinle iletişime geçecektir."
    url="https://turkteknik35.com/tesekkur"
    keywords="türk teknik, servis talebi alındı, teşekkür"
  />

  <section class="min-h-screen flex items-center justify-center py-20 px-4" style="background: #060e1f;">

    <div class="fixed inset-0 pointer-events-none overflow-hidden" aria-hidden="true">
      <div class="absolute top-0 left-1/4 w-96 h-96 rounded-full opacity-10"
        style="background: radial-gradient(circle, #10b981 0%, transparent 70%); filter: blur(60px);"/>
      <div class="absolute bottom-1/3 right-1/4 w-80 h-80 rounded-full opacity-8"
        style="background: radial-gradient(circle, #2563eb 0%, transparent 70%); filter: blur(80px);"/>
    </div>

    <div class="max-w-xl w-full relative z-10 text-center">
      <div class="rounded-3xl border p-12 mb-6"
        style="background: rgba(255,255,255,0.04); border-color: rgba(255,255,255,0.08); box-shadow: 0 24px 48px rgba(0,0,0,0.5)">

        <!-- Başarı ikonu -->
        <div class="w-24 h-24 rounded-full flex items-center justify-center mx-auto mb-6 relative"
          style="background: rgba(16,185,129,0.12); border: 1.5px solid rgba(16,185,129,0.3)">
          <div class="absolute inset-0 rounded-full animate-ping opacity-20"
            style="background: rgba(16,185,129,0.3)"/>
          <svg class="w-12 h-12 relative z-10" fill="none" stroke="currentColor" viewBox="0 0 24 24"
            style="color:#34d399">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
          </svg>
        </div>

        <h1 class="text-3xl font-black mb-3" style="color:#e8f0ff">Talebiniz Alındı!</h1>
        <p class="mb-8 leading-relaxed max-w-sm mx-auto" style="color:#6b7fa3">
          Servis talebiniz ekibimize iletildi. En kısa sürede sizinle
          <strong style="color:#93c5fd">iletişime geçeceğiz.</strong>
        </p>

        <!-- Bilgi kartları -->
        <div class="grid grid-cols-3 gap-3 mb-8">
          <div v-for="info in [
            { icon:'📞', title:'2–3 saat', sub:'içinde arama' },
            { icon:'🔧', title:'Uzman', sub:'teknisyen' },
            { icon:'✅', title:'Ücretsiz', sub:'keşif' }
          ]" :key="info.title" class="rounded-2xl p-4"
            style="background: rgba(255,255,255,0.04); border: 1px solid rgba(255,255,255,0.07)">
            <div class="text-2xl mb-1">{{ info.icon }}</div>
            <div class="text-sm font-bold" style="color:#c8d8f0">{{ info.title }}</div>
            <div class="text-xs" style="color:#4b6080">{{ info.sub }}</div>
          </div>
        </div>

        <!-- Aksiyon butonları -->
        <div class="flex flex-col sm:flex-row gap-3 justify-center">
          <Link
            href="/"
            class="inline-flex items-center justify-center gap-2 font-bold text-sm px-6 py-3 rounded-xl text-white transition-all shadow-lg"
            style="background: linear-gradient(135deg,#1d4ed8,#2563eb); box-shadow: 0 8px 24px rgba(37,99,235,0.4)"
          >
            Ana Sayfaya Dön
          </Link>
          <a
            href="tel:05469118061"
            class="inline-flex items-center justify-center gap-2 font-semibold text-sm px-6 py-3 rounded-xl transition-all"
            style="background: rgba(255,255,255,0.06); border: 1.5px solid rgba(255,255,255,0.1); color:#93c5fd"
          >
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/>
            </svg>
            Hemen Ara
          </a>
        </div>
      </div>
    </div>
  </section>
</template>

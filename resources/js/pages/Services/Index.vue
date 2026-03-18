<template>
  <div class="min-h-screen bg-slate-900 flex flex-col pt-24 pb-12 px-4 overflow-hidden">
    <TopBar />
    <SEO
      title="Hizmetlerimiz | TürkTeknik"
      description="TürkTeknik'in sunduğu tüm teknik servis hizmetleri. İnternet, Elektrik, Uydu ve Güvenlik sistemleri için profesyonel çözümler."
      url="https://turkteknik.com.tr/hizmetlerimiz"
    />

    <div class="max-w-6xl mx-auto w-full flex-grow flex flex-col justify-center items-center">
      <!-- Compact Header -->
      <div class="mb-6 text-center">
        <h1 class="text-2xl md:text-3xl font-extrabold text-white mb-1 tracking-tight">Hizmetlerimiz</h1>
        <p class="text-gray-400 text-xs md:text-sm font-medium leading-relaxed">
          Tüm teknik servis ihtiyaçlarınız için profesyonel ve garantili çözümler.
        </p>
      </div>

      <!-- 2x2 Compact Services Grid -->
      <div class="grid grid-cols-1 md:grid-cols-2 gap-4 lg:gap-6 w-full max-w-5xl">
        <div
          v-for="service in services"
          :key="service.slug"
          class="group bg-slate-800 rounded-3xl p-5 border border-slate-700/50 hover:border-blue-400/30 transition-all duration-300 relative overflow-hidden shadow-sm hover:shadow-xl flex flex-col h-full"
        >
          <div class="relative z-10 flex flex-col h-full">
            <!-- Header: Icon + Title (Flex Row) -->
            <div class="flex items-center gap-4 mb-4">
              <div :class="[
                'w-12 h-12 rounded-2xl flex items-center justify-center transition-all duration-300 shadow-sm shrink-0',
                service.iconBg
              ]">
                <i :class="[service.icon, service.iconColor]" class="text-xl"></i>
              </div>
              <h2 class="text-lg font-bold text-white leading-tight">
                {{ service.title }}
              </h2>
            </div>

            <!-- Tight Features List -->
            <ul class="space-y-1.5 mb-5 flex-grow">
              <li 
                v-for="(feature, fIndex) in service.features" 
                :key="fIndex"
                class="flex items-start gap-2.5 group/item"
              >
                <span class="text-blue-400 flex-shrink-0 mt-0.5 text-xs">✓</span>
                <span class="text-[13px] font-medium text-gray-400 group-hover/item:text-gray-200 transition-colors">
                  {{ feature }}
                </span>
              </li>
            </ul>

            <!-- Action Buttons -->
            <div class="flex flex-col sm:flex-row gap-2 mt-auto">
              <Link 
                :href="route('service-requests.create', { service: service.serviceKey })"
                class="flex-1 bg-blue-600 hover:bg-blue-700 text-white py-2 px-4 rounded-xl font-bold text-[12px] shadow-md shadow-blue-600/10 transition-all transform active:scale-95 flex items-center justify-center gap-2"
              >
                Talep Oluştur
                <span class="transition-transform duration-300 group-hover:translate-x-1">&rarr;</span>
              </Link>
              <Link 
                :href="
                  service.slug === 'kamera-sistemleri' ? route('services.camera') :
                  service.slug === 'internet-hizmetleri' ? route('services.internet') :
                  service.slug === 'uydu-sistemleri' ? route('services.satellite') :
                  service.slug === 'elektrik-servisi' ? route('services.elektrik') :
                  route('services.show', service.slug)
                "
                class="flex-1 bg-slate-700/50 text-gray-300 py-2 px-4 rounded-xl font-bold text-[12px] border border-slate-700 hover:bg-slate-700 transition-all flex items-center justify-center"
              >
                Detaylı Bilgi
              </Link>
            </div>
          </div>
        </div>
      </div>

      <!-- Compact Trust Bar -->
      <div class="mt-10 flex flex-wrap justify-center gap-6 text-center opacity-70">
        <div class="flex items-center gap-2">
          <i class="fas fa-shield-alt text-blue-400 text-xs text-center"></i>
          <span class="text-[10px] font-bold text-white uppercase tracking-widest text-center">Garantili Hizmet</span>
        </div>
        <div class="flex items-center gap-2">
          <i class="fas fa-clock text-emerald-400 text-xs text-center"></i>
          <span class="text-[10px] font-bold text-white uppercase tracking-widest text-center">Hızlı Müdahale</span>
        </div>
        <div class="flex items-center gap-2">
          <i class="fas fa-tools text-amber-400 text-xs text-center"></i>
          <span class="text-[10px] font-bold text-white uppercase tracking-widest text-center">Orijinal Parça</span>
        </div>
      </div>
    </div>
  </div>
</template>

<script setup lang="ts">
import { Link } from '@inertiajs/vue3';
import SEO from '@/components/SEO.vue';
import TopBar from '@/components/TopBar.vue';

const services = [
  {
    title: 'İnternet Teknik Servis',
    slug: 'internet-hizmetleri',
    serviceKey: 'internet',
    icon: 'fas fa-wifi',
    iconBg: 'bg-blue-900/20',
    iconColor: 'text-blue-400',
    features: [
      'Fiber, ADSL, VDSL Arıza Tespit ve Hat Analizi',
      'Modem / Router Kurulumu ve Yapılandırma',
      'Access Point ve Mesh Wi-Fi Kurulumu',
      'Wi-Fi Analizi ve Sinyal Optimizasyonu',
      'Ethernet (CAT6 / CAT7) Altyapı Kurulumu',
      'Switch ve Ağ Dağıtım Kurulumu',
      'IP Yapılandırması ve Ağ Güvenlik Ayarları',
      'Hız Sorunları ve Ping / Latency Çözümleri'
    ]
  },
  {
    title: 'Elektrik Teknik Servis',
    slug: 'elektrik-servisi',
    serviceKey: 'elektrik',
    icon: 'fas fa-bolt',
    iconBg: 'bg-amber-900/20',
    iconColor: 'text-amber-400',
    features: [
      'Elektrik Tesisatı Arıza Tespit ve Onarımı',
      'Sigorta Panosu Kurulumu ve Bakımı',
      'Kaçak Akım Rölesi Kurulumu',
      'LED ve Profesyonel Aydınlatma Sistemleri',
      'Elektrik Tesisatı Yenileme',
      'Enerji Dağıtım Planlaması (Ofis & Ev)',
      'Priz, Anahtar ve Hat Değişimi',
      'Topraklama Kontrolü ve Yük Analizi'
    ]
  },
  {
    title: 'Uydu & Merkezi Sistemler',
    slug: 'uydu-sistemleri',
    serviceKey: 'satellite',
    icon: 'fas fa-satellite-dish',
    iconBg: 'bg-emerald-900/20',
    iconColor: 'text-emerald-400',
    features: [
      'Çanak Anten Kurulum ve Yön Ayarı',
      'Merkezi Uydu Sistemi Kurulumu (SMATV)',
      'Apartman ve Site Merkezi Altyapısı',
      'LNB, Multiswitch ve Splitter Değişimi',
      'Uydu Sinyal Ölçümü ve Optimizasyonu',
      'TV ve Receiver Kanal Kurulumu',
      'Headend Sistem Kurulumu',
      'Kablolama ve Sinyal Kesintisi Giderilmesi'
    ]
  },
  {
    title: 'Güvenlik & Kamera',
    slug: 'kamera-sistemleri',
    serviceKey: 'camera',
    icon: 'fas fa-video',
    iconBg: 'bg-indigo-900/20',
    iconColor: 'text-indigo-400',
    features: [
      'IP ve AHD Güvenlik Kamera Kurulumu',
      'Mekanlar İçin Kamera Projelendirme',
      'NVR / DVR Kayıt Cihazı Kurulumu',
      'Uzaktan İzleme (Telefon/PC) Kurulumu',
      'Harddisk ve Kayıt Sistemi Çözümleri',
      'Görüntü Kalite Optimizasyonu',
      'Alarm ve Güvenlik Entegrasyonu',
      'Kamera Altyapı ve Periyodik Bakım'
    ]
  }
];
</script>
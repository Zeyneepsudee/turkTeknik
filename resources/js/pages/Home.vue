<script setup lang="ts">
import { Link, usePage } from '@inertiajs/vue3';
import { useHead } from '@vueuse/head';
import SEO from '@/components/SEO.vue';
import { ref, watch } from 'vue';

useHead({
  script: [
    {
      type: 'application/ld+json',
      innerHTML: JSON.stringify({
        '@context': 'https://schema.org',
        '@type': 'FAQPage',
        mainEntity: [
          {
            '@type': 'Question',
            name: 'İzmir\'de en iyi teknik servis hangisidir?',
            acceptedAnswer: {
              '@type': 'Answer',
              text: 'TürkTeknik, 2016\'dan bu yana İzmir genelinde internet, güvenlik kamerası, çanak anten ve elektrik teknik servis hizmetleri sunmaktadır. Sertifikalı teknisyenler, aynı gün servis ve %100 memnuniyet garantisi ile hizmet vermektedir.',
            },
          },
          {
            '@type': 'Question',
            name: 'İzmir\'de internet arızası için nereye başvurulur?',
            acceptedAnswer: {
              '@type': 'Answer',
              text: 'İzmir\'de internet arızanız için TürkTeknik\'i 0546 911 80 61 numaralı hattan arayabilir ya da WhatsApp üzerinden iletişime geçebilirsiniz. Fiber, VDSL ve Wi-Fi sorunlarınızı aynı gün çözüyoruz.',
            },
          },
          {
            '@type': 'Question',
            name: 'İzmir\'de güvenlik kamerası kurulumu ne kadar sürer?',
            acceptedAnswer: {
              '@type': 'Answer',
              text: 'Standart bir 4 kameralı sistem kurulumu genellikle yarım ile bir tam gün arasında tamamlanır. Kamera sayısı ve kablolama gereksinimine bağlı olarak süre değişebilir.',
            },
          },
          {
            '@type': 'Question',
            name: 'Çanak anten kurulumu için İzmir\'de kim aranır?',
            acceptedAnswer: {
              '@type': 'Answer',
              text: 'TürkTeknik olarak İzmir\'in tüm ilçelerinde çanak anten montajı, LNB değişimi ve uydu yön ayarı yapıyoruz. 0546 911 80 61 numaralı hattan ulaşabilirsiniz.',
            },
          },
        ],
      }),
      key: 'faq-home',
    },
  ],
});
import AppLayout from '@/layouts/AppLayout.vue';
import HeroCarousel from '@/components/HeroCarousel.vue';
import NotificationCard from '@/components/NotificationCard.vue';

defineOptions({ layout: AppLayout });

const services = [
    {
        title: 'İnternet Teknik Servis',
        description: 'İnternet arızaları, daire içi veri kablolama ve Wi-Fi sinyal güçlendirme çözümleri.',
        icon: 'fas fa-wifi',
        slug: 'internet-hizmetleri'
    },
    {
        title: 'Elektrik Teknik Servis',
        description: 'Genel elektrik arızaları, aydınlatma onarımı, pano bakımı ve cihaz montajı.',
        icon: 'fas fa-bolt',
        slug: 'elektrik-servisi'
    },
    {
        title: 'Uydu & Merkezi Sistemler',
        description: 'Merkezi uydu kurulumu, çanak anten montajı ve TV ünitesi asma işlemleri.',
        icon: 'fas fa-satellite-dish',
        slug: 'uydu-sistemleri'
    },
    {
        title: 'Güvenlik & Kamera',
        description: 'Güvenlik kamera sistemleri kurulumu, altyapı yenileme ve DVR/NVR onarımı.',
        icon: 'fas fa-video',
        slug: 'kamera-sistemleri'
    }
];

const page = usePage();
const successMessage = ref(null);

const referenceStats = [
  { value: '500+', label: 'Tamamlanan Proje' },
  { value: '4.9/5', label: 'Müşteri Puanı' },
  { value: '12', label: 'İzmir İlçesi' },
  { value: '7/24', label: 'Hizmet' },
];

const miniTestimonials = [
  {
    text: 'Çanak antenimi tamir ettiler, fiyat makuldü ve garantili iş çıkardılar.',
    name: 'Mehmet Y.',
    district: 'Konak',
    service: 'Uydu Tamiri',
    initials: 'MY',
    color: 'bg-blue-500',
  },
  {
    text: 'Apartmanımıza 8 kameralı güvenlik sistemi kurulumu yaptırdık. Çok memnun kaldık.',
    name: 'Ayşe K.',
    district: 'Bornova',
    service: 'Güvenlik Kamerası',
    initials: 'AK',
    color: 'bg-indigo-500',
  },
  {
    text: 'İnternet sürekli kesiliyor, eski kablolara baktılar ve hemen düzelttiler. Artık hiç kopmadan çalışıyor.',
    name: 'Hasan D.',
    district: 'Karabağlar',
    service: 'İnternet Hat Tamiri',
    initials: 'HD',
    color: 'bg-emerald-500',
  },
];

const featuredGuides = [
  {
    title: 'ZTE Modem Kurulumu',
    desc: 'PPPoE ayarı, Wi-Fi şifre ve optimizasyon',
    icon: 'fas fa-ethernet',
    iconColor: 'text-blue-400',
    bg: 'bg-blue-500/10',
    href: '/rehberler/zte-modem-kurulumu',
  },
  {
    title: 'TP-Link Deco Mesh Kurulumu',
    desc: 'Ev genelinde kesintisiz Wi-Fi için Mesh sistemi',
    icon: 'fas fa-project-diagram',
    iconColor: 'text-cyan-400',
    bg: 'bg-cyan-500/10',
    href: '/rehberler/mesh-wifi-sistemi-kurulumu',
  },
  {
    title: 'Çanak Anten Yön Ayarı',
    desc: 'İzmir\'de Türksat için azimut ve elevasyon',
    icon: 'fas fa-satellite-dish',
    iconColor: 'text-emerald-400',
    bg: 'bg-emerald-500/10',
    href: '/rehberler/canak-anten-ayari',
  },
  {
    title: 'Kamera Uzaktan İzleme',
    desc: 'Telefondan P2P ve port yönlendirme ile izleme',
    icon: 'fas fa-mobile-alt',
    iconColor: 'text-indigo-400',
    bg: 'bg-indigo-500/10',
    href: '/rehberler/kamera-uzaktan-izleme',
  },
];

watch(() => page.props.flash?.success, (newVal) => {
  if (newVal) {
    successMessage.value = newVal;
    setTimeout(() => {
      successMessage.value = null;
    }, 5000);
  }
}, { immediate: true });
</script>

<template>
  <div>
    <SEO
      title="İzmir Teknik Servis | Güvenlik Kamerası, Uydu, İnternet, Elektrik | TürkTeknik"
      description="İzmir'de profesyonel teknik servis. Bornova, Buca, Karşıyaka, Konak ve tüm İzmir ilçelerine güvenlik kamerası kurulumu, çanak anten montajı, internet arızası ve elektrik hizmetleri. 7/24 servis ☎ 0546 911 80 61"
      keywords="izmir teknik servis, izmir güvenlik kamerası kurulumu, izmir çanak anten kurulumu, izmir uydu servisi, izmir internet arızası, izmir elektrik servisi, bornova teknik servis, buca teknik servis, karşıyaka teknik servis, konak teknik servis, çiğli kamera kurulumu, gaziemir uydu servisi, türkteknik izmir, izmir kamera sistemi, izmir wifi kurulumu"
      url="https://turkteknik.com.tr"
    />


    <!-- Hero Carousel -->
    <HeroCarousel />

    <!-- Services Section -->
    <div class="py-20 bg-[#020b18] relative overflow-hidden">
      <!-- Background highlights -->
      <div class="absolute top-0 left-1/4 w-96 h-96 bg-blue-600/5 blur-[120px] pointer-events-none"></div>
      <div class="absolute bottom-0 right-1/4 w-96 h-96 bg-indigo-600/5 blur-[120px] pointer-events-none"></div>

      <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
        <div class="text-center mb-16" data-aos="fade-up">
          <h2 class="text-3xl font-black text-white sm:text-4xl md:text-5xl tracking-tight mb-4">
            Profesyonel Hizmetlerimiz
          </h2>
          <div class="h-1.5 w-24 bg-blue-600 mx-auto rounded-full mb-6"></div>
          <p class="max-w-2xl mx-auto text-lg text-slate-400">
            Tüm teknik servis ihtiyaçlarınız için İzmir genelinde hızlı ve garantili çözümler sunuyoruz.
          </p>
        </div>

        <div class="grid grid-cols-1 gap-8 sm:grid-cols-2 lg:grid-cols-4">
          <Link
            v-for="(service, index) in services"
            :key="service.slug"
            :href="
              service.slug === 'kamera-sistemleri' ? route('services.camera') :
              service.slug === 'internet-hizmetleri' ? route('services.internet') :
              service.slug === 'uydu-sistemleri' ? route('services.satellite') :
              service.slug === 'elektrik-servisi' ? route('services.elektrik') :
              route('services.show', service.slug)
            "
            :data-aos="'fade-up'"
            :data-aos-delay="index * 100"
            class="
              bg-slate-900/40 backdrop-blur-sm
              border border-slate-800/50 hover:border-blue-500/50
              rounded-2xl p-8 
              transition-all duration-500 hover:-translate-y-2
              group relative overflow-hidden
            "
          >
            <!-- Hover Gradient -->
            <div class="absolute inset-0 bg-gradient-to-br from-blue-600/10 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-500"></div>

            <div class="relative z-10 text-center">
              <div class="mb-6 inline-flex">
                <div class="p-4 bg-slate-800/80 rounded-2xl group-hover:bg-blue-600 transition-all duration-500 shadow-xl group-hover:shadow-blue-600/20">
                  <i :class="service.icon" class="text-3xl text-blue-500 group-hover:text-white transition-colors duration-500 h-8 w-8 flex items-center justify-center"></i>
                </div>
              </div>
              <h3 class="text-xl font-bold text-white mb-3 group-hover:text-blue-400 transition-colors">
                {{ service.title }}
              </h3>
              <p class="text-sm text-slate-400 leading-relaxed mb-6">
                {{ service.description }}
              </p>
              <div class="flex items-center justify-center text-blue-500 font-bold text-xs uppercase tracking-widest gap-2">
                Detayları Gör
                <i class="fas fa-arrow-right text-[10px] group-hover:translate-x-1 transition-transform"></i>
              </div>
            </div>
          </Link>
        </div>
      </div>
    </div>

    <!-- Features Section -->
    <div class="py-20 bg-[#050d1a] border-y border-slate-900">
      <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid md:grid-cols-2 lg:grid-cols-4 gap-12">
          <div class="flex flex-col items-center text-center group" data-aos="fade-up" data-aos-delay="100">
            <div class="w-16 h-16 rounded-2xl bg-blue-600/10 flex items-center justify-center mb-6 group-hover:bg-blue-600 transition-all duration-300">
              <i class="fas fa-clock text-2xl text-blue-500 group-hover:text-white"></i>
            </div>
            <h3 class="text-lg font-bold text-white mb-2">Hızlı Servis</h3>
            <p class="text-sm text-slate-500">Çağrınıza en kısa sürede yanıt veriyor, yerinde müdahale ediyoruz.</p>
          </div>

          <div class="flex flex-col items-center text-center group" data-aos="fade-up" data-aos-delay="200">
            <div class="w-16 h-16 rounded-2xl bg-purple-600/10 flex items-center justify-center mb-6 group-hover:bg-purple-600 transition-all duration-300">
              <i class="fas fa-tools text-2xl text-purple-500 group-hover:text-white"></i>
            </div>
            <h3 class="text-lg font-bold text-white mb-2">Uzman Ekip</h3>
            <p class="text-sm text-slate-500">Alanında eğitimli ve sertifikalı profesyonel teknik kadro.</p>
          </div>

          <div class="flex flex-col items-center text-center group" data-aos="fade-up" data-aos-delay="300">
            <div class="w-16 h-16 rounded-2xl bg-emerald-600/10 flex items-center justify-center mb-6 group-hover:bg-emerald-600 transition-all duration-300">
              <i class="fas fa-shield-alt text-2xl text-emerald-500 group-hover:text-white"></i>
            </div>
            <h3 class="text-lg font-bold text-white mb-2">Garantili Hizmet</h3>
            <p class="text-sm text-slate-500">Parça ve işçilikte %100 memnuniyet garantisi sunuyoruz.</p>
          </div>

          <div class="flex flex-col items-center text-center group" data-aos="fade-up" data-aos-delay="400">
            <div class="w-16 h-16 rounded-2xl bg-amber-600/10 flex items-center justify-center mb-6 group-hover:bg-amber-600 transition-all duration-300">
              <i class="fas fa-hand-holding-usd text-2xl text-amber-500 group-hover:text-white"></i>
            </div>
            <h3 class="text-lg font-bold text-white mb-2">Uygun Fiyat</h3>
            <p class="text-sm text-slate-500">Yüksek kaliteyi en rekabetçi fiyatlarla sunuyoruz.</p>
          </div>
        </div>
      </div>
    </div>

    <!-- Referanslar & Güven Bölümü -->
    <div class="py-16 bg-[#030d1e] border-y border-slate-900">
      <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-12" data-aos="fade-up">
          <h2 class="text-3xl font-black text-white sm:text-4xl tracking-tight mb-4">
            Müşterilerimiz Hakkımızda
          </h2>
          <div class="h-1.5 w-24 bg-blue-600 mx-auto rounded-full mb-6"></div>
          <p class="max-w-2xl mx-auto text-slate-400 text-base">
            İzmir genelinde 500'den fazla tamamlanan proje ve memnun müşterilerimizden birkaç yorum.
          </p>
        </div>

        <!-- Stat Chips -->
        <div class="flex flex-wrap justify-center gap-4 mb-12">
          <div v-for="stat in referenceStats" :key="stat.label" class="bg-slate-800/60 border border-slate-700 rounded-2xl px-6 py-4 text-center min-w-[120px]">
            <div class="text-2xl font-extrabold text-white">{{ stat.value }}</div>
            <div class="text-slate-400 text-xs mt-1">{{ stat.label }}</div>
          </div>
        </div>

        <!-- Mini Testimonials -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-10">
          <div v-for="t in miniTestimonials" :key="t.name" class="bg-slate-800/40 border border-slate-700 rounded-2xl p-6">
            <div class="flex gap-1 mb-3">
              <i v-for="s in 5" :key="s" class="fas fa-star text-amber-400 text-xs"></i>
            </div>
            <p class="text-slate-300 text-sm leading-relaxed mb-4">"{{ t.text }}"</p>
            <div class="flex items-center gap-3">
              <div :class="['w-9 h-9 rounded-full flex items-center justify-center text-white text-xs font-bold flex-shrink-0', t.color]">{{ t.initials }}</div>
              <div>
                <p class="text-white text-sm font-semibold">{{ t.name }}</p>
                <p class="text-slate-500 text-xs">{{ t.district }} · {{ t.service }}</p>
              </div>
            </div>
          </div>
        </div>

        <div class="text-center">
          <Link href="/referanslar" class="inline-flex items-center gap-2 px-6 py-3 bg-slate-800 hover:bg-slate-700 border border-slate-600 text-white rounded-xl text-sm font-semibold transition">
            Tüm Referansları Gör <i class="fas fa-arrow-right text-xs"></i>
          </Link>
        </div>
      </div>
    </div>

    <!-- Sorun Çözüm Merkezi (Guides) -->
    <div class="py-20 bg-[#020b18]">
      <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-12" data-aos="fade-up">
          <h2 class="text-3xl font-black text-white sm:text-4xl tracking-tight mb-4">
            Sorun Çözüm Merkezi
          </h2>
          <div class="h-1.5 w-24 bg-blue-600 mx-auto rounded-full mb-6"></div>
          <p class="max-w-2xl mx-auto text-slate-400 text-base">
            Modem kurulumu, anten ayarı veya kamera sorununuz mu var? Adım adım rehberlerimizle çözüme ulaşın.
          </p>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-5 mb-10">
          <Link
            v-for="guide in featuredGuides"
            :key="guide.href"
            :href="guide.href"
            class="group bg-slate-800/40 border border-slate-700 hover:border-blue-500/50 rounded-2xl p-6 transition-all duration-300 hover:-translate-y-1"
          >
            <div :class="['w-12 h-12 rounded-xl flex items-center justify-center mb-4 text-xl', guide.bg]">
              <i :class="[guide.icon, guide.iconColor]"></i>
            </div>
            <h3 class="text-white font-semibold text-sm mb-2 group-hover:text-blue-400 transition-colors leading-snug">{{ guide.title }}</h3>
            <p class="text-slate-500 text-xs leading-relaxed">{{ guide.desc }}</p>
          </Link>
        </div>

        <div class="text-center">
          <Link href="/rehberler" class="inline-flex items-center gap-2 px-6 py-3 bg-blue-600 hover:bg-blue-500 text-white rounded-xl text-sm font-semibold transition">
            Tüm Rehberlere Gözat <i class="fas fa-book-open text-xs"></i>
          </Link>
        </div>
      </div>
    </div>

    <!-- CTA Section -->
    <div class="relative py-24 overflow-hidden">
      <!-- Background Gradient -->
      <div class="absolute inset-0 bg-[#020b18]"></div>
      <div class="absolute inset-0 bg-gradient-to-r from-blue-600/20 to-indigo-600/20 opacity-40"></div>
      
      <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10 text-center">
        <h2 class="text-3xl md:text-5xl font-black text-white mb-8 tracking-tight" data-aos="fade-up">
          Hemen Servis Talebi Oluşturun
        </h2>
        <p class="text-lg text-slate-300 mb-12 max-w-2xl mx-auto" data-aos="fade-up" data-aos-delay="100">
          7/24 hizmetinizdeyiz. Profesyonel ekibimiz bir tık uzağınızda.
        </p>
        <div class="flex flex-wrap items-center justify-center gap-6" data-aos="fade-up" data-aos-delay="200">
          <Link :href="route('service-request')" class="px-8 py-4 bg-blue-600 hover:bg-blue-500 text-white font-bold rounded-xl transition-all shadow-xl shadow-blue-600/20 hover:scale-105">
            Servis Talebi Oluştur
          </Link>
          <a href="tel:+905469118061" class="px-8 py-4 bg-slate-800/80 hover:bg-slate-700 text-white font-bold rounded-xl border border-slate-700 transition-all hover:scale-105">
            Hemen Ara: 0546 911 80 61
          </a>
        </div>
      </div>
    </div>

    <!-- Notification -->
    <NotificationCard />

    <!-- WhatsApp Floating -->
    <a
      href="https://wa.me/905469118061?text=Merhaba! TürkTeknik hizmetleri hakkında bilgi almak istiyorum."
      target="_blank"
      rel="noopener noreferrer"
      class="fixed bottom-6 right-6 z-50 text-white w-11 h-11 rounded-full flex items-center justify-center float-wp"
      aria-label="WhatsApp ile İletişim"
    >
      <i class="fab fa-whatsapp text-2xl"></i>
    </a>
  </div>
</template>

<style scoped>
@keyframes float-bob {
  0%, 100% { transform: translateY(0); }
  50%       { transform: translateY(-6px); }
}
.float-wp {
  background: #25d366;
  box-shadow: 0 4px 16px rgba(37,211,102,0.5);
  animation: float-bob 2.8s ease-in-out infinite;
}
.float-wp:hover {
  animation: none;
  transform: scale(1.12);
  box-shadow: 0 6px 24px rgba(37,211,102,0.65);
}
</style>
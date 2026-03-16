<template>
  <div class="min-h-screen bg-gray-50 dark:bg-slate-900 flex flex-col pt-24 pb-12 px-4">
    <TopBar />
    <SEO
      title="İzmir Güvenlik Kamera Sistemleri Kurulumu | TürkTeknik"
      description="İzmir'de profesyonel güvenlik kamera kurulumu. IP ve AHD kamera sistemi montajı, DVR/NVR kurulumu, uzaktan mobil izleme. 7/24 teknik servis. Hemen arayın: 0546 911 80 61"
      url="https://turkteknik.com.tr/hizmetler/kamera-sistemleri"
      keywords="izmir güvenlik kamerası kurulumu, izmir kamera sistemi, ip kamera montajı izmir, dvr nvr kurulumu izmir, güvenlik kamerası tamiri izmir, kamera servisi izmir, türkteknik kamera"
    />


    <div class="max-w-6xl mx-auto w-full flex-grow">
      <!-- Hero Section -->
      <div class="relative rounded-[3rem] overflow-hidden bg-slate-900 mb-12 py-16 px-8 md:px-16 border border-slate-800 shadow-2xl">
        <div class="absolute inset-0 opacity-20">
          <div class="absolute top-0 -left-20 w-80 h-80 bg-indigo-500 rounded-full blur-[100px]"></div>
          <div class="absolute bottom-0 -right-20 w-80 h-80 bg-blue-600 rounded-full blur-[100px]"></div>
        </div>

        <div class="relative z-10 flex flex-col md:flex-row items-center gap-12">
          <div class="flex-1 text-center md:text-left">
            <div class="inline-flex items-center gap-2 px-4 py-2 rounded-full bg-indigo-500/10 border border-indigo-500/20 text-indigo-500 text-xs font-bold uppercase tracking-widest mb-6">
              <i class="fas fa-video"></i> Güvenlik & Kamera — İzmir
            </div>
            <h1 class="text-4xl md:text-6xl font-extrabold text-white mb-6 tracking-tight leading-tight">
              7/24 <span class="text-indigo-500">Güvende</span> Kalın
            </h1>
            <p class="text-slate-400 text-lg md:text-xl font-medium mb-8 leading-relaxed max-w-2xl">
              İzmir'de evinizi ve iş yerinizi akıllı telefonunuzdan yüksek çözünürlükte izleyin. Profesyonel kayıt sistemleri ile güvenliğinizi şansa bırakmayın.
            </p>
            <div class="flex flex-wrap justify-center md:justify-start gap-4">
              <Link
                :href="route('service-requests.create', { service: 'camera' })"
                class="bg-indigo-600 hover:bg-indigo-700 text-white px-8 py-4 rounded-2xl font-bold text-base shadow-xl shadow-indigo-500/20 transition transform active:scale-95 flex items-center gap-3"
              >
                Servis Talebi Oluştur
                <i class="fas fa-arrow-right text-sm"></i>
              </Link>
            </div>
          </div>
          <div class="w-full md:w-1/3 flex justify-center">
            <div class="relative">
              <div class="absolute inset-0 bg-indigo-500 blur-[60px] opacity-20 animate-pulse"></div>
              <i class="fas fa-video text-[120px] md:text-[180px] text-indigo-500 relative z-10 drop-shadow-2xl"></i>
            </div>
          </div>
        </div>
      </div>

      <!-- Features Grid -->
      <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 mb-16">
        <div v-for="(feature, index) in features" :key="index"
             class="bg-white dark:bg-slate-800/50 p-8 rounded-3xl border border-gray-100 dark:border-slate-800 hover:border-indigo-500/30 transition-all duration-300 group">
          <div class="w-14 h-14 rounded-2xl bg-indigo-500/10 flex items-center justify-center mb-6 group-hover:scale-110 transition-transform duration-300 shadow-sm">
            <i :class="[feature.icon, 'text-2xl text-indigo-500']"></i>
          </div>
          <h3 class="text-xl font-bold text-gray-900 dark:text-white mb-4">{{ feature.title }}</h3>
          <p class="text-gray-500 dark:text-slate-400 leading-relaxed text-sm">
            {{ feature.description }}
          </p>
        </div>
      </div>

      <!-- Remote Monitoring Banner -->
      <div class="bg-blue-600 rounded-[2.5rem] p-8 md:p-12 text-white relative overflow-hidden shadow-xl mb-16">
        <div class="relative z-10 flex flex-col md:flex-row items-center justify-between gap-8">
          <div class="text-center md:text-left max-w-2xl">
            <h2 class="text-2xl md:text-3xl font-bold mb-4">Her An, Her Yerden Kontrol</h2>
            <p class="text-blue-100 text-base md:text-lg opacity-90">
              Gelişmiş mobil uygulama entegrasyonu ile kameralarınızı canlı izleyebilir, geçmiş kayıtları saniyeler içinde telefonunuza indirebilirsiniz. Statik IP ve port yönlendirme ile tam erişim.
            </p>
          </div>
          <div class="flex-shrink-0">
             <i class="fas fa-mobile-alt text-[80px] opacity-20"></i>
          </div>
        </div>
      </div>

      <!-- FAQ Section -->
      <div class="max-w-4xl mx-auto">
        <h2 class="text-3xl font-bold text-gray-900 dark:text-white text-center mb-10">Sıkça Sorulan Sorular</h2>
        <div class="space-y-4">
          <div v-for="(faq, index) in faqs" :key="index" class="bg-white dark:bg-slate-800 rounded-2xl border border-gray-100 dark:border-slate-800 overflow-hidden">
            <button class="w-full px-6 py-5 text-left flex justify-between items-center group">
              <span class="font-bold text-gray-700 dark:text-slate-300 group-hover:text-indigo-500 transition-colors">{{ faq.question }}</span>
              <i class="fas fa-chevron-down text-slate-500 text-xs"></i>
            </button>
            <div class="px-6 pb-5 text-gray-500 dark:text-slate-400 text-sm leading-relaxed border-t border-gray-50 dark:border-slate-700/50 pt-4">
              {{ faq.answer }}
            </div>
          </div>
        </div>
      </div>
    </div>

    <!-- WhatsApp Floating Button -->
    <a href="https://wa.me/905469118061" target="_blank" class="fixed bottom-8 right-8 bg-emerald-500 text-white w-14 h-14 rounded-full flex items-center justify-center shadow-2xl hover:scale-110 transition-transform z-50">
      <i class="fab fa-whatsapp text-3xl"></i>
    </a>
  </div>
</template>

<script setup>
import { Link } from '@inertiajs/vue3';
import { useHead } from '@vueuse/head';
import SEO from '@/components/SEO.vue';
import TopBar from '@/components/TopBar.vue';

useHead({
  script: [
    {
      type: 'application/ld+json',
      innerHTML: JSON.stringify({
        '@context': 'https://schema.org',
        '@type': 'BreadcrumbList',
        itemListElement: [
          { '@type': 'ListItem', position: 1, name: 'Ana Sayfa', item: 'https://turkteknik.com.tr/' },
          { '@type': 'ListItem', position: 2, name: 'Hizmetler', item: 'https://turkteknik.com.tr/hizmetler' },
          { '@type': 'ListItem', position: 3, name: 'Güvenlik Kamera Sistemleri', item: 'https://turkteknik.com.tr/hizmetler/kamera-sistemleri' },
        ],
      }),
      key: 'breadcrumb-camera',
    },
    {
      type: 'application/ld+json',
      innerHTML: JSON.stringify({
        '@context': 'https://schema.org',
        '@type': 'FAQPage',
        mainEntity: [
          {
            '@type': 'Question',
            name: 'Kamera kayıtları geriye dönük ne kadar süre saklanır?',
            acceptedAnswer: {
              '@type': 'Answer',
              text: 'Bu tamamen hard disk kapasitenize, kamera sayınıza ve görüntü kalitesine bağlıdır. Standart sistemlerde 15-30 gün arası saklama hedeflenir, ihtiyaca göre bu süre artırılabilir.',
            },
          },
          {
            '@type': 'Question',
            name: 'İnternet kesilirse kameralar kayıt yapmaya devam eder mi?',
            acceptedAnswer: {
              '@type': 'Answer',
              text: 'Evet, kayıt cihazı (DVR/NVR) elektriğe bağlı olduğu sürece kayıt yapmaya devam eder. Sadece internet olmadığında cepten canlı izleme yapamazsınız.',
            },
          },
          {
            '@type': 'Question',
            name: 'Kamera görüntü kalitesi neden bozulur?',
            acceptedAnswer: {
              '@type': 'Answer',
              text: 'Lenslerin kirlenmesi, kabloların eskimesi veya güç kaynağının (adaptörün) voltaj düşürmesi en yaygın nedenlerdir. Periyodik bakım ile görüntü kalitesi ilk günkü haline getirilebilir.',
            },
          },
        ],
      }),
      key: 'faq-camera',
    },
    {
      type: 'application/ld+json',
      innerHTML: JSON.stringify({
        '@context': 'https://schema.org',
        '@type': 'Service',
        name: 'Güvenlik Kamera Sistemleri Kurulumu',
        description: 'İzmir\'de profesyonel IP ve AHD güvenlik kamera kurulumu, DVR/NVR çözümleri ve uzaktan izleme sistemleri.',
        provider: {
          '@type': 'LocalBusiness',
          name: 'TürkTeknik',
          telephone: '+905469118061',
          address: { '@type': 'PostalAddress', addressLocality: 'İzmir', addressCountry: 'TR' },
        },
        areaServed: { '@type': 'City', name: 'İzmir' },
        serviceType: 'Güvenlik Kamera Sistemleri',
      }),
      key: 'service-camera',
    },
  ],
});

const features = [
  {
    title: 'IP & AHD Sistemler',
    description: '4K çözünürlüğe kadar yüksek netlik sunan modern IP ve ekonomik AHD kamera altyapısı kurulumu sağlıyoruz.',
    icon: 'fas fa-shield-alt'
  },
  {
    title: 'Uzaktan İzleme',
    description: 'Kayıt cihazlarınızı akıllı telefon (iOS/Android) ve PC üzerinden 7/24 izlenebilir hale getiriyoruz.',
    icon: 'fas fa-mobile-screen-button'
  },
  {
    title: 'NVR / DVR Çözümleri',
    description: 'Yüksek kapasiteli, sarsıntıya dayanıklı güvenlik diskleri ile kesintisiz kayıt ve yedekleme sistemleri.',
    icon: 'fas fa-hdd'
  },
  {
    title: 'Gece Görüş & Hareket',
    description: 'Smart IR ve renkli gece görüş özellikli kameralarla zifiri karanlıkta bile net detaylar yakalayın.',
    icon: 'fas fa-eye'
  },
  {
    title: 'Altyapı Yenileme',
    description: 'Mevcut kamera kablolarınızın değişimi, sinyal kaybı giderilmesi ve bağlantı noktalarının revizesi.',
    icon: 'fas fa-tools'
  },
  {
    title: 'Alarm Entegrasyonu',
    description: 'Kamera sistemlerinizi alarm ve hareket sensörleri ile eşleştirerek tam kapsamlı bir koruma kalkanı oluşturuyoruz.',
    icon: 'fas fa-bell'
  }
];

const faqs = [
  {
    question: 'Kamera kayıtları geriye dönük ne kadar süre saklanır?',
    answer: 'Bu tamamen hard disk kapasitenize, kamera sayınıza ve görüntü kalitesine bağlıdır. Standart sistemlerde 15-30 gün arası saklama hedeflenir, ihtiyaca göre bu süre artırılabilir.'
  },
  {
    question: 'İnternet kesilirse kameralar kayıt yapmaya devam eder mi?',
    answer: 'Evet, kayıt cihazı (DVR/NVR) elektriğe bağlı olduğu sürece kayıt yapmaya devam eder. Sadece internet olmadığında cepten canlı izleme yapamazsınız.'
  },
  {
    question: 'Kamera görüntü kalitesi neden bozulur?',
    answer: 'Lenslerin kirlenmesi, kabloların eskimesi veya güç kaynağının (adaptörün) voltaj düşürmesi en yaygın nedenlerdir. Periyodik bakım ile görüntü kalitesi ilk günkü haline getirilebilir.'
  }
];
</script>

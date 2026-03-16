<template>
  <div class="min-h-screen bg-gray-50 dark:bg-slate-900 flex flex-col pt-24 pb-12 px-4">
    <TopBar />
    <SEO
      title="İzmir Çanak Anten & Uydu Sistemi Kurulumu | TürkTeknik"
      description="İzmir'de çanak anten montajı, merkezi uydu sistemi (SMATV), LNB değişimi ve sinyal güçlendirme hizmetleri. Yağmurda sinyal giden anten sorunları çözülür. 0546 911 80 61"
      url="https://turkteknik.com.tr/hizmetler/uydu-sistemleri"
      keywords="izmir çanak anten kurulumu, izmir uydu servisi, çanak anten tamiri izmir, merkezi uydu sistemi izmir, sinyal güçlendirme izmir, lnb değişimi izmir, türkteknik uydu"
    />


    <div class="max-w-6xl mx-auto w-full flex-grow">
      <!-- Hero Section -->
      <div class="relative rounded-[3rem] overflow-hidden bg-slate-900 mb-12 py-16 px-8 md:px-16 border border-slate-800 shadow-2xl">
        <div class="absolute inset-0 opacity-20">
          <div class="absolute top-0 -left-20 w-80 h-80 bg-emerald-500 rounded-full blur-[100px]"></div>
          <div class="absolute bottom-0 -right-20 w-80 h-80 bg-blue-600 rounded-full blur-[100px]"></div>
        </div>
        
        <div class="relative z-10 flex flex-col md:flex-row items-center gap-12">
          <div class="flex-1 text-center md:text-left">
            <div class="inline-flex items-center gap-2 px-4 py-2 rounded-full bg-emerald-500/10 border border-emerald-500/20 text-emerald-500 text-xs font-bold uppercase tracking-widest mb-6">
              <i class="fas fa-satellite-dish"></i> Uydu & Merkezi Sistemler
            </div>
            <h1 class="text-4xl md:text-6xl font-extrabold text-white mb-6 tracking-tight leading-tight">
              Kristal Netliğinde <span class="text-emerald-500">Görüntü</span> Keyfi
            </h1>
            <p class="text-slate-400 text-lg md:text-xl font-medium mb-8 leading-relaxed max-w-2xl">
              Merkezi uydu sistemlerinden çanak anten ayarlarına kadar, TV keyfinizin kesilmemesi için en hassas sinyal ölçüm cihazlarıyla hizmet veriyoruz.
            </p>
            <div class="flex flex-wrap justify-center md:justify-start gap-4">
              <Link 
                :href="route('service-requests.create', { service: 'satellite' })"
                class="bg-emerald-600 hover:bg-emerald-700 text-white px-8 py-4 rounded-2xl font-bold text-base shadow-xl shadow-emerald-500/20 transition transform active:scale-95 flex items-center gap-3"
              >
                Servis Talebi Oluştur
                <i class="fas fa-arrow-right text-sm"></i>
              </Link>
            </div>
          </div>
          <div class="w-full md:w-1/3 flex justify-center">
            <div class="relative">
              <div class="absolute inset-0 bg-emerald-500 blur-[60px] opacity-20 animate-pulse"></div>
              <i class="fas fa-satellite-dish text-[120px] md:text-[180px] text-emerald-500 relative z-10 drop-shadow-2xl"></i>
            </div>
          </div>
        </div>
      </div>

      <!-- Features Grid -->
      <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 mb-16">
        <div v-for="(feature, index) in features" :key="index" 
             class="bg-white dark:bg-slate-800/50 p-8 rounded-3xl border border-gray-100 dark:border-slate-800 hover:border-emerald-500/30 transition-all duration-300 group">
          <div class="w-14 h-14 rounded-2xl bg-emerald-500/10 flex items-center justify-center mb-6 group-hover:scale-110 transition-transform duration-300 shadow-sm">
            <i :class="[feature.icon, 'text-2xl text-emerald-500']"></i>
          </div>
          <h3 class="text-xl font-bold text-gray-900 dark:text-white mb-4">{{ feature.title }}</h3>
          <p class="text-gray-500 dark:text-slate-400 leading-relaxed text-sm">
            {{ feature.description }}
          </p>
        </div>
      </div>

      <!-- Image Quality Banner -->
      <div class="bg-blue-600 rounded-[2.5rem] p-8 md:p-12 text-white relative overflow-hidden shadow-xl mb-16">
        <div class="relative z-10 flex flex-col md:flex-row items-center justify-between gap-8">
          <div class="text-center md:text-left max-w-2xl">
            <h2 class="text-2xl md:text-3xl font-bold mb-4">Kesintisiz 4K Yayın Keyfi</h2>
            <p class="text-blue-100 text-base md:text-lg opacity-90">
              Hava şartlarından etkilenmeyen sağlam montaj ve doğru LNB seçimi ile zayıf sinyal ve donma sorunlarını tamamen ortadan kaldırıyoruz.
            </p>
          </div>
          <div class="flex-shrink-0">
             <i class="fas fa-tv text-[80px] opacity-20"></i>
          </div>
        </div>
      </div>

      <!-- FAQ Section -->
      <div class="max-w-4xl mx-auto">
        <h2 class="text-3xl font-bold text-gray-900 dark:text-white text-center mb-10">Sıkça Sorulan Sorular</h2>
        <div class="space-y-4">
          <div v-for="(faq, index) in faqs" :key="index" class="bg-white dark:bg-slate-800 rounded-2xl border border-gray-100 dark:border-slate-800 overflow-hidden">
            <button class="w-full px-6 py-5 text-left flex justify-between items-center group">
              <span class="font-bold text-gray-700 dark:text-slate-300 group-hover:text-emerald-500 transition-colors">{{ faq.question }}</span>
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

<script setup lang="ts">
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
          { '@type': 'ListItem', position: 3, name: 'Uydu & Çanak Anten', item: 'https://turkteknik.com.tr/hizmetler/uydu-sistemleri' },
        ],
      }),
      key: 'breadcrumb-satellite',
    },
    {
      type: 'application/ld+json',
      innerHTML: JSON.stringify({
        '@context': 'https://schema.org',
        '@type': 'FAQPage',
        mainEntity: [
          {
            '@type': 'Question',
            name: 'Yağmurlu havalarda yayın neden gider?',
            acceptedAnswer: {
              '@type': 'Answer',
              text: 'Eğer çanak anten montajınız tam sağlam değilse veya LNB koruyucu kapağı eskimişse, nem ve su sinyal kaybına neden olur. Özellikle F-konnektörlerin su alması bu sorunun ana kaynağıdır.',
            },
          },
          {
            '@type': 'Question',
            name: 'Merkezi sistemde sadece benim dairemde yayın yok, neden?',
            acceptedAnswer: {
              '@type': 'Answer',
              text: 'Bu durum genellikle dairenize gelen kablodaki bir temassızlıktan, evinizdeki priz arızasından veya multiswitch üzerindeki çıkış portunun bozulmasından kaynaklanır.',
            },
          },
          {
            '@type': 'Question',
            name: '4K yayın alabilmek için özel bir çanak gerekir mi?',
            acceptedAnswer: {
              '@type': 'Answer',
              text: '4K yayınlar için standart uydular kullanılır, ancak LNB kalitesi ve kablo kaybının düşük olması 4K yayının stabilitesi için çok kritiktir.',
            },
          },
        ],
      }),
      key: 'faq-satellite',
    },
    {
      type: 'application/ld+json',
      innerHTML: JSON.stringify({
        '@context': 'https://schema.org',
        '@type': 'Service',
        name: 'Uydu & Çanak Anten Sistemleri',
        description: 'İzmir\'de çanak anten montajı, merkezi uydu sistemi (SMATV), LNB değişimi ve sinyal güçlendirme hizmetleri.',
        provider: {
          '@type': 'LocalBusiness',
          name: 'TürkTeknik',
          telephone: '+905469118061',
          address: { '@type': 'PostalAddress', addressLocality: 'İzmir', addressCountry: 'TR' },
        },
        areaServed: { '@type': 'City', name: 'İzmir' },
        serviceType: 'Uydu ve Çanak Anten Servisi',
      }),
      key: 'service-satellite',
    },
  ],
});

const features = [
  {
    title: 'Çanak Anten Yön Ayarı',
    description: 'Profesyonel uydu bulucu cihazlar ile Türksat, Hotbird, Eutelsat ve diğer uydular için milimetrik hassasiyette yön ayarı yapıyoruz.',
    icon: 'fas fa-up-down-left-right'
  },
  {
    title: 'Merkezi Sistem (SMATV)',
    description: 'Apartman, site ve oteller için Multiswitch destekli merkezi uydu altyapısı kurulumu ve periyodik bakım hizmetleri.',
    icon: 'fas fa-building'
  },
  {
    title: 'LNB & Multiswitch Değişimi',
    description: 'Sinyali bozan veya yanan LNB, Multiswitch ve Splitter gibi parçaların orijinal ve garantili yedekleriyle değişimi.',
    icon: 'fas fa-microchip'
  },
  {
    title: 'Sinyal Güçlendirme',
    description: 'Zayıf sinyal ve görüntü kırılmasına son! Kablo kalitesi ölçümü ve sinyal amfisi (booster) kullanımıyla net görüntü sağlıyoruz.',
    icon: 'fas fa-signal'
  },
  {
    title: 'TV & Panel Montajı',
    description: 'Yeni nesil LED/OLED TV\'lerinizin duvara asılması, kablo gizleme ve kanal kurulumu işlemlerini profesyonelce yapıyoruz.',
    icon: 'fas fa-laptop'
  },
  {
    title: 'Uydu Kablolama',
    description: 'Dış şartlara dayanıklı, düşük kayıplı RG6 uydu kabloları ile bina içi ve dışı estetik bir kablolama altyapısı kuruyoruz.',
    icon: 'fas fa-network-wired'
  }
];

const faqs = [
  {
    question: 'Yağmurlu havalarda yayın neden gider?',
    answer: 'Eğer çanak anten montajınız tam sağlam değilse veya LNB koruyucu kapağı eskimişse, nem ve su sinyal kaybına neden olur. Özellikle F-konnektörlerin su alması bu sorunun ana kaynağıdır.'
  },
  {
    question: 'Merkezi sistemde sadece benim dairemde yayın yok, neden?',
    answer: 'Bu durum genellikle dairenize gelen kablodaki bir temassızlıktan, evinizdeki priz arızasından veya multiswitch üzerindeki çıkış portunun bozulmasından kaynaklanır.'
  },
  {
    question: '4K yayın alabilmek için özel bir çanak gerekir mi?',
    answer: '4K yayınlar için standart uydular kullanılır, ancak LNB kalitesi ve kablo kaybının düşük olması 4K yayının stabilitesi için çok kritiktir.'
  }
];
</script>
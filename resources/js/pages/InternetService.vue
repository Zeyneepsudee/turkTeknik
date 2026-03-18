<template>
  <div class="min-h-screen bg-gray-50 dark:bg-slate-900 flex flex-col pt-24 pb-12 px-4">
    <TopBar />
    <SEO
      title="İzmir İnternet Teknik Servis | Fiber & Wi-Fi Arıza | TürkTeknik"
      description="İzmir'de internet arızası, yavaş bağlantı ve Wi-Fi problemi mi yaşıyorsunuz? Fiber/VDSL arıza tespiti, modem kurulumu, Mesh Wi-Fi ve Access Point çözümleri. 0546 911 80 61"
      url="https://turkteknik.com.tr/hizmetler/internet-hizmetleri"
      keywords="izmir internet arızası, izmir wifi teknik servis, fiber internet arıza izmir, modem kurulumu izmir, mesh wifi izmir, internet hız sorunu izmir, türkteknik internet"
    />


    <div class="max-w-6xl mx-auto w-full flex-grow">
      <!-- Hero Section -->
      <div class="relative rounded-[3rem] overflow-hidden bg-slate-900 mb-12 py-16 px-8 md:px-16 border border-slate-800 shadow-2xl">
        <div class="absolute inset-0 opacity-20">
          <div class="absolute top-0 -left-20 w-80 h-80 bg-blue-500 rounded-full blur-[100px]"></div>
          <div class="absolute bottom-0 -right-20 w-80 h-80 bg-indigo-600 rounded-full blur-[100px]"></div>
        </div>
        
        <div class="relative z-10 flex flex-col md:flex-row items-center gap-12">
          <div class="flex-1 text-center md:text-left">
            <div class="inline-flex items-center gap-2 px-4 py-2 rounded-full bg-blue-500/10 border border-blue-500/20 text-blue-500 text-xs font-bold uppercase tracking-widest mb-6">
              <i class="fas fa-wifi"></i> İnternet Teknik Servis — İzmir
            </div>
            <h1 class="text-4xl md:text-6xl font-extrabold text-white mb-6 tracking-tight leading-tight">
              Kesintisiz ve <span class="text-blue-500">Işık Hızında</span> Bağlantı
            </h1>
            <p class="text-slate-400 text-lg md:text-xl font-medium mb-8 leading-relaxed max-w-2xl">
              İzmir'de fiber ve VDSL arıza tespitinden, evinizin her köşesinde tam çeken Mesh Wi-Fi sistemlerine kadar internet altyapınızı profesyonellerle optimize edin.
            </p>
            <div class="flex flex-wrap justify-center md:justify-start gap-4">
              <a
                href="tel:+905469118061"
                class="bg-blue-500 hover:bg-blue-400 text-white px-8 py-4 rounded-2xl font-bold text-base shadow-xl shadow-blue-500/20 transition transform active:scale-95 flex items-center gap-3"
              >
                <i class="fas fa-phone text-sm"></i>
                Hemen Ara
              </a>
              <Link 
                :href="route('service-requests.create', { service: 'internet' })"
                class="bg-blue-600 hover:bg-blue-700 text-white px-8 py-4 rounded-2xl font-bold text-base shadow-xl shadow-blue-500/20 transition transform active:scale-95 flex items-center gap-3"
              >
                Servis Talebi Oluştur
                <i class="fas fa-arrow-right text-sm"></i>
              </Link>
            </div>
          </div>
          <div class="w-full md:w-1/3 flex justify-center">
            <div class="relative">
              <div class="absolute inset-0 bg-blue-500 blur-[60px] opacity-20 animate-pulse"></div>
              <i class="fas fa-wifi text-[120px] md:text-[180px] text-blue-500 relative z-10 drop-shadow-2xl"></i>
            </div>
          </div>
        </div>
      </div>

      <!-- Features Grid -->
      <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 mb-16">
        <div v-for="(feature, index) in features" :key="index" 
             class="bg-white dark:bg-slate-800/50 p-8 rounded-3xl border border-gray-100 dark:border-slate-800 hover:border-blue-500/30 transition-all duration-300 group">
          <div class="w-14 h-14 rounded-2xl bg-blue-500/10 flex items-center justify-center mb-6 group-hover:scale-110 transition-transform duration-300 shadow-sm">
            <i :class="[feature.icon, 'text-2xl text-blue-500']"></i>
          </div>
          <h3 class="text-xl font-bold text-gray-900 dark:text-white mb-4">{{ feature.title }}</h3>
          <p class="text-gray-500 dark:text-slate-400 leading-relaxed text-sm">
            {{ feature.description }}
          </p>
        </div>
      </div>

      <!-- Speed Optimization Banner -->
      <div class="bg-indigo-600 rounded-[2.5rem] p-8 md:p-12 text-white relative overflow-hidden shadow-xl mb-16">
        <div class="relative z-10 flex flex-col md:flex-row items-center justify-between gap-8">
          <div class="text-center md:text-left max-w-2xl">
            <h2 class="text-2xl md:text-3xl font-bold mb-4">Hızınızı En Üst Seviyeye Çıkarın</h2>
            <p class="text-indigo-100 text-base md:text-lg opacity-90">
              Latency (gecikme) ve kopma sorunları genelde bina içi kablolamadan kaynaklanır. Uzman ekibimizle hat analizinizi yapalım, fiber hızınızı gerçek kapasitesinde kullanın.
            </p>
          </div>
          <div class="flex-shrink-0">
             <i class="fas fa-tachometer-alt text-[80px] opacity-20"></i>
          </div>
        </div>
      </div>

      <!-- FAQ Section -->
      <div class="max-w-4xl mx-auto">
        <h2 class="text-3xl font-bold text-gray-900 dark:text-white text-center mb-10">Sıkça Sorulan Sorular</h2>
        <div class="space-y-4">
          <div v-for="(faq, index) in faqs" :key="index" class="bg-white dark:bg-slate-800 rounded-2xl border border-gray-100 dark:border-slate-800 overflow-hidden">
            <button @click="openFaqIndex = openFaqIndex === index ? null : index" class="w-full px-6 py-5 text-left flex justify-between items-center group">
              <span class="font-bold text-gray-700 dark:text-slate-300 group-hover:text-blue-500 transition-colors">{{ faq.question }}</span>
              <i class="fas fa-chevron-down text-slate-500 text-xs transition-transform duration-300" :class="{ 'rotate-180': openFaqIndex === index }"></i>
            </button>
            <div v-show="openFaqIndex === index" class="px-6 pb-5 text-gray-500 dark:text-slate-400 text-sm leading-relaxed border-t border-gray-50 dark:border-slate-700/50 pt-4">
              {{ faq.answer }}
            </div>
          </div>
        </div>
      </div>
    </div>
    
    <!-- WhatsApp Floating Button -->
    <a href="https://wa.me/905469118061" target="_blank" rel="noopener noreferrer"
       class="float-wp fixed bottom-6 right-6 text-white w-11 h-11 rounded-full flex items-center justify-center z-50"
       aria-label="WhatsApp ile İletişim">
      <i class="fab fa-whatsapp text-2xl"></i>
    </a>
  </div>
</template>

<script setup lang="ts">
import { ref } from 'vue';
import { Link } from '@inertiajs/vue3';
import { useHead } from '@vueuse/head';
import SEO from '@/components/SEO.vue';
import TopBar from '@/components/TopBar.vue';

const openFaqIndex = ref<number | null>(null);

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
          { '@type': 'ListItem', position: 3, name: 'İnternet Teknik Servis', item: 'https://turkteknik.com.tr/hizmetler/internet-hizmetleri' },
        ],
      }),
      key: 'breadcrumb-internet',
    },
    {
      type: 'application/ld+json',
      innerHTML: JSON.stringify({
        '@context': 'https://schema.org',
        '@type': 'FAQPage',
        mainEntity: [
          {
            '@type': 'Question',
            name: 'İnternet hızım neden paketiyle uyumlu değil?',
            acceptedAnswer: {
              '@type': 'Answer',
              text: 'Hız düşüklüğünün en yaygın sebepleri; eski iç tesisat kabloları, oksitlenmiş bağlantı noktaları veya Wi-Fi sinyal çakışmalarıdır. Profesyonel bir hat ölçümü ile dar boğazın nerede olduğu bulunabilir.',
            },
          },
          {
            '@type': 'Question',
            name: 'Farklı odalarda internet neden kesiliyor?',
            acceptedAnswer: {
              '@type': 'Answer',
              text: 'Wi-Fi sinyalleri duvarlar, beyaz eşyalar ve aynalar tarafından engellenir. Bu durumda Mesh Wi-Fi veya Access Point sistemleri kurarak kesintisiz bir kapsama alanı oluşturulmalıdır.',
            },
          },
          {
            '@type': 'Question',
            name: 'Modem kurulumunu kendim yapabilir miyim?',
            acceptedAnswer: {
              '@type': 'Answer',
              text: 'Temel kurulumları yapabilirsiniz, ancak PPP ayarları, kanal frekans optimizasyonu ve güvenlik duvarı yapılandırması gibi detaylar uzmanlık gerektirir. Yanlış ayarlar güvenlik açığı oluşturabilir.',
            },
          },
        ],
      }),
      key: 'faq-internet',
    },
    {
      type: 'application/ld+json',
      innerHTML: JSON.stringify({
        '@context': 'https://schema.org',
        '@type': 'Service',
        name: 'İnternet Teknik Servis',
        description: 'İzmir\'de fiber ve VDSL arıza tespiti, modem kurulumu, Mesh Wi-Fi ve Access Point çözümleri.',
        provider: {
          '@type': 'LocalBusiness',
          name: 'TürkTeknik',
          telephone: '+905469118061',
          address: { '@type': 'PostalAddress', addressLocality: 'İzmir', addressCountry: 'TR' },
        },
        areaServed: { '@type': 'City', name: 'İzmir' },
        serviceType: 'İnternet Teknik Servis',
      }),
      key: 'service-internet',
    },
  ],
});

const features = [
  {
    title: 'Arıza Tespit & Onarım',
    description: 'Fiber, VDSL ve ADSL hatlarınızdaki kopma, düşük hız ve sinyal gürültüsü sorunlarını profesyonel test cihazları ile tespit edip onarıyoruz.',
    icon: 'fas fa-search-plus'
  },
  {
    title: 'Modem & Kurulum',
    description: 'Yeni nesil modemlerinizin kurulumu, yazılım güncellemeleri ve güvenli şifreleme ayarları ile baştan sona yapılandırma sağlıyoruz.',
    icon: 'fas fa-ethernet'
  },
  {
    title: 'Mesh Wi-Fi Çözümleri',
    description: 'TP-Link Deco ve benzeri Mesh teknolojileri ile evinizin her odasında, sinyal kaybı yaşamadan sınırsız internet keyfi sunuyoruz.',
    icon: 'fas fa-project-diagram'
  },
  {
    title: 'Access Point Kurulumu',
    description: 'Geniş ofis ve dubleks evler için kablolu altyapı destekli Access Point kurulumları ile kör noktaları tamamen ortadan kaldırıyoruz.',
    icon: 'fas fa-broadcast-tower'
  },
  {
    title: 'Data Kablolama',
    description: 'CAT6 ve CAT7 standartlarında, bina içi yüksek hızlı veri transferine uygun profesyonel ethernet kablolama hizmeti.',
    icon: 'fas fa-network-wired'
  },
  {
    title: 'Ping & Hız Optimizasyonu',
    description: 'Online oyunlar ve video konferanslar için kritik olan latency (ping) değerlerini düşürmek için hat stabilizasyonu yapıyoruz.',
    icon: 'fas fa-tachometer-alt'
  }
];

const faqs = [
  {
    question: 'İnternet hızım neden paketiyle uyumlu değil?',
    answer: 'Hız düşüklüğünün en yaygın sebepleri; eski iç tesisat kabloları, oksitlenmiş bağlantı noktaları veya Wi-Fi sinyal çakışmalarıdır. Profesyonel bir hat ölçümü ile dar boğazın nerede olduğu bulunabilir.'
  },
  {
    question: 'Farklı odalarda internet neden kesiliyor?',
    answer: 'Wi-Fi sinyalleri duvarlar, beyaz eşyalar ve aynalar tarafından engellenir. Bu durumda Mesh Wi-Fi veya Access Point sistemleri kurarak kesintisiz bir kapsama alanı oluşturulmalıdır.'
  },
  {
    question: 'Modem kurulumunu kendim yapabilir miyim?',
    answer: 'Temel kurulumları yapabilirsiniz, ancak PPP ayarları, kanal frekans optimizasyonu ve güvenlik duvarı yapılandırması gibi detaylar uzmanlık gerektirir. Yanlış ayarlar güvenlik açığı oluşturabilir.'
  }
];
</script>

<style scoped>
@keyframes float-bob {
  0%, 100% { transform: translateY(0); }
  50%       { transform: translateY(-6px); }
}
.float-wp { background:#25d366; box-shadow:0 4px 16px rgba(37,211,102,0.5); animation: float-bob 2.8s ease-in-out infinite; }
.float-wp:hover { animation: none; transform:scale(1.12); box-shadow:0 6px 24px rgba(37,211,102,0.65); }
</style>
<template>
  <div class="min-h-screen bg-gray-50 dark:bg-slate-900 flex flex-col pt-24 pb-12 px-4">
    <TopBar />
    <SEO
      title="İzmir Elektrik Teknik Servis | Tesisat & Pano | TürkTeknik"
      description="İzmir'de elektrik arızası, sigorta panosu, kaçak akım rölesi kurulumu ve LED aydınlatma hizmetleri. Sertifikalı elektrikçi ekibi. Aynı gün servis. 0546 911 80 61"
      url="https://turkteknik.com.tr/hizmetler/elektrik-servisi"
      keywords="izmir elektrik servisi, elektrikçi izmir, sigorta panosu izmir, kaçak akım rölesi izmir, elektrik tesisatı izmir, led aydınlatma izmir, elektrik arızası izmir, türkteknik elektrik"
    />


    <div class="max-w-6xl mx-auto w-full flex-grow">
      <!-- Hero Section -->
      <div class="relative rounded-[3rem] overflow-hidden bg-slate-900 mb-12 py-16 px-8 md:px-16 border border-slate-800 shadow-2xl">
        <div class="absolute inset-0 opacity-20">
          <div class="absolute top-0 -left-20 w-80 h-80 bg-amber-500 rounded-full blur-[100px]"></div>
          <div class="absolute bottom-0 -right-20 w-80 h-80 bg-blue-600 rounded-full blur-[100px]"></div>
        </div>
        
        <div class="relative z-10 flex flex-col md:flex-row items-center gap-12">
          <div class="flex-1 text-center md:text-left">
            <div class="inline-flex items-center gap-2 px-4 py-2 rounded-full bg-amber-500/10 border border-amber-500/20 text-amber-500 text-xs font-bold uppercase tracking-widest mb-6">
              <i class="fas fa-bolt"></i> Elektrik Teknik Servis
            </div>
            <h1 class="text-4xl md:text-6xl font-extrabold text-white mb-6 tracking-tight leading-tight">
              Güvenli ve <span class="text-amber-500">Verimli</span> Enerji Altyapısı
            </h1>
            <p class="text-slate-400 text-lg md:text-xl font-medium mb-8 leading-relaxed max-w-2xl">
              Ev ve iş yeriniz için sigorta panosundan aydınlatmaya, tesisat yenilemeden kaçak akım kontrolüne kadar tüm elektrik ihtiyaçlarınızda uzman çözümler sunuyoruz.
            </p>
            <div class="flex flex-wrap justify-center md:justify-start gap-4">
              <a
                href="tel:+905469118061"
                class="bg-amber-500 hover:bg-amber-400 text-slate-900 px-8 py-4 rounded-2xl font-bold text-base shadow-xl shadow-amber-500/20 transition transform active:scale-95 flex items-center gap-3"
              >
                <i class="fas fa-phone text-sm"></i>
                Hemen Ara
              </a>
              <Link 
                :href="route('service-requests.create', { service: 'elektrik' })"
                class="bg-amber-500 hover:bg-amber-600 text-slate-900 px-8 py-4 rounded-2xl font-bold text-base shadow-xl shadow-amber-500/20 transition transform active:scale-95 flex items-center gap-3"
              >
                Servis Talebi Oluştur
                <i class="fas fa-arrow-right text-sm"></i>
              </Link>
            </div>
          </div>
          <div class="w-full md:w-1/3 flex justify-center">
            <div class="relative">
              <div class="absolute inset-0 bg-amber-500 blur-[60px] opacity-20 animate-pulse"></div>
              <i class="fas fa-bolt text-[120px] md:text-[180px] text-amber-500 relative z-10 drop-shadow-2xl"></i>
            </div>
          </div>
        </div>
      </div>

      <!-- Features Grid -->
      <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 mb-16">
        <div v-for="(feature, index) in features" :key="index" 
             class="bg-white dark:bg-slate-800/50 p-8 rounded-3xl border border-gray-100 dark:border-slate-800 hover:border-amber-500/30 transition-all duration-300 group">
          <div class="w-14 h-14 rounded-2xl bg-amber-500/10 flex items-center justify-center mb-6 group-hover:scale-110 transition-transform duration-300 shadow-sm">
            <i :class="[feature.icon, 'text-2xl text-amber-500']"></i>
          </div>
          <h3 class="text-xl font-bold text-gray-900 dark:text-white mb-4">{{ feature.title }}</h3>
          <p class="text-gray-500 dark:text-slate-400 leading-relaxed text-sm">
            {{ feature.description }}
          </p>
        </div>
      </div>

      <!-- Safety & Efficiency Banner -->
      <div class="bg-blue-600 rounded-[2.5rem] p-8 md:p-12 text-white relative overflow-hidden shadow-xl mb-16">
        <div class="relative z-10 flex flex-col md:flex-row items-center justify-between gap-8">
          <div class="text-center md:text-left max-w-2xl">
            <h2 class="text-2xl md:text-3xl font-bold mb-4">Güvenliğiniz Önceliğimizdir</h2>
            <p class="text-blue-100 text-base md:text-lg opacity-90">
              Eski tesisatlar ve hatalı sigorta bağlantıları yangın riskini artırır. Kaçak akım rölesi kurulumu ve periyodik tesisat kontrolleri ile yaşam alanınızı güvence altına alın.
            </p>
          </div>
          <div class="flex-shrink-0">
             <i class="fas fa-shield-alt text-[80px] opacity-20"></i>
          </div>
        </div>
      </div>

      <!-- FAQ Section -->
      <div class="max-w-4xl mx-auto">
        <h2 class="text-3xl font-bold text-gray-900 dark:text-white text-center mb-10">Sıkça Sorulan Sorular</h2>
        <div class="space-y-4">
          <div v-for="(faq, index) in faqs" :key="index" class="bg-white dark:bg-slate-800 rounded-2xl border border-gray-100 dark:border-slate-800 overflow-hidden">
            <button @click="openFaqIndex = openFaqIndex === index ? null : index" class="w-full px-6 py-5 text-left flex justify-between items-center group">
              <span class="font-bold text-gray-700 dark:text-slate-300 group-hover:text-amber-500 transition-colors">{{ faq.question }}</span>
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
          { '@type': 'ListItem', position: 3, name: 'Elektrik Teknik Servis', item: 'https://turkteknik.com.tr/hizmetler/elektrik-servisi' },
        ],
      }),
      key: 'breadcrumb-elektrik',
    },
    {
      type: 'application/ld+json',
      innerHTML: JSON.stringify({
        '@context': 'https://schema.org',
        '@type': 'FAQPage',
        mainEntity: [
          {
            '@type': 'Question',
            name: 'Sigorta panosu neden ısınır veya ses çıkarır?',
            acceptedAnswer: {
              '@type': 'Answer',
              text: 'Isınma ve ses (vızıltı), genelde gevşek bağlantılardan veya sigortanın taşıyabileceğinden fazla akım geçmesinden kaynaklanır. Bu ciddi bir yangın riskidir ve acil müdahale gerektirir.',
            },
          },
          {
            '@type': 'Question',
            name: 'Kaçak akım rölesi neden sürekli atıyor?',
            acceptedAnswer: {
              '@type': 'Answer',
              text: 'Evinizde bir cihazda kaçak olabilir, nötr-toprak çakışması yaşanıyor olabilir veya rölenin kendisi arızalı olabilir. Profesyonel bir ölçümle ana kaynağın bulunması gerekir.',
            },
          },
          {
            '@type': 'Question',
            name: 'Eski tesisatın değişmesi şart mı?',
            acceptedAnswer: {
              '@type': 'Answer',
              text: 'Kullanılan kabloların ömrü ortalama 15-20 yıldır. Isınan veya sertleşen kablolar izolasyonunu kaybeder ve kısa devre riskini artırır. Güvenliğiniz için periyodik kontrol önerilir.',
            },
          },
        ],
      }),
      key: 'faq-elektrik',
    },
    {
      type: 'application/ld+json',
      innerHTML: JSON.stringify({
        '@context': 'https://schema.org',
        '@type': 'Service',
        name: 'Elektrik Teknik Servis',
        description: 'İzmir\'de sigorta panosu kurulumu, kaçak akım rölesi, LED aydınlatma montajı ve elektrik tesisatı yenileme hizmetleri.',
        provider: {
          '@type': 'LocalBusiness',
          name: 'TürkTeknik',
          telephone: '+905469118061',
          address: { '@type': 'PostalAddress', addressLocality: 'İzmir', addressCountry: 'TR' },
        },
        areaServed: { '@type': 'City', name: 'İzmir' },
        serviceType: 'Elektrik Teknik Servis',
      }),
      key: 'service-elektrik',
    },
  ],
});

const features = [
  {
    title: 'Sigorta Panosu & Bakım',
    description: 'Eski tip sigortaların yenilenmesi, pano temizliği ve yük dengeleme hizmetleri ile sisteminizi koruma altına alın.',
    icon: 'fas fa-shield-virus'
  },
  {
    title: 'Kaçak Akım Rölesi',
    description: 'Hayat kurtaran kaçak akım rölesi kurulumu ve hassasiyet testleri ile elektrik çarpmalarına karşı önlem alın.',
    icon: 'fas fa-user-shield'
  },
  {
    title: 'LED Aydınlatma',
    description: 'Modern tasarımlı LED ve spot aydınlatma kurulumları ile enerjiden %80\'e varan tasarruf sağlayın.',
    icon: 'fas fa-lightbulb'
  },
  {
    title: 'Tesisat Yenileme',
    description: 'Eskimiş kabloların yanmaz (halojen free) kablolarla değişimi ve altyapı güçlendirme çalışmaları.',
    icon: 'fas fa-tools'
  },
  {
    title: 'Arıza Tespit & Onarım',
    description: 'Termal kameralar ve ölçüm cihazları ile noktasal arıza tespiti yaparak gereksiz kırma dökme işlemlerini önlüyoruz.',
    icon: 'fas fa-search'
  },
  {
    title: 'Enerji Planlama',
    description: 'Ofis ve evleriniz için cihaz yük analizine göre enerji dağıtım projeleri hazırlıyoruz.',
    icon: 'fas fa-project-diagram'
  }
];

const faqs = [
  {
    question: 'Sigorta panosu neden ısınır veya ses çıkarır?',
    answer: 'Isınma ve ses (vızıltı), genelde gevşek bağlantılardan veya sigortanın taşıyabileceğinden fazla akım geçmesinden kaynaklanır. Bu ciddi bir yangın riskidir ve acil müdahale gerektirir.'
  },
  {
    question: 'Kaçak akım rölesi neden sürekli atıyor?',
    answer: 'Evinizde bir cihazda kaçak olabilir, nötr-toprak çakışması yaşanıyor olabilir veya rölenin kendisi arızalı olabilir. Profesyonel bir ölçümle ana kaynağın bulunması gerekir.'
  },
  {
    question: 'Eski tesisatın değişmesi şart mı?',
    answer: 'Kullanılan kabloların ömrü ortalama 15-20 yıldır. Isınan veya sertleşen kablolar izolasyonunu kaybeder ve kısa devre riskini artırır. Güvenliğiniz için periyodik kontrol önerilir.'
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

<template>
  <div class="min-h-screen bg-slate-900 flex flex-col pt-24 pb-12 px-4">
    <TopBar />

    <!-- SEO Meta -->
    <SEO
      :title="district.seoTitle"
      :description="district.seoDesc"
      :url="`https://turkteknik.com.tr/izmir/${districtSlug}`"
      :keywords="district.keywords"
    />


    <div class="max-w-6xl mx-auto w-full flex-grow">

      <!-- Hero Section -->
      <div class="relative rounded-[3rem] overflow-hidden bg-slate-900 mb-12 py-16 px-8 md:px-16 border border-slate-800 shadow-2xl">
        <div class="absolute inset-0 opacity-20">
          <div class="absolute top-0 -left-20 w-80 h-80 bg-blue-500 rounded-full blur-[100px]"></div>
          <div class="absolute bottom-0 -right-20 w-80 h-80 bg-indigo-600 rounded-full blur-[100px]"></div>
        </div>

        <div class="relative z-10 text-center md:text-left">
          <div class="inline-flex items-center gap-2 px-4 py-2 rounded-full bg-blue-500/10 border border-blue-500/20 text-blue-400 text-xs font-bold uppercase tracking-widest mb-6">
            <i class="fas fa-map-marker-alt"></i> İzmir / {{ district.name }}
          </div>
          <h1 class="text-4xl md:text-5xl font-extrabold text-white mb-4 leading-tight">
            {{ district.name }}'da <span class="text-blue-400">Teknik Servis</span>
          </h1>
          <p class="text-slate-400 text-lg md:text-xl mb-8 max-w-3xl leading-relaxed">
            {{ district.description }} Aynı gün servis, garantili işçilik ve şeffaf fiyatlandırma ile hizmetinizdeyiz.
          </p>
          <div class="flex flex-wrap gap-4 justify-center md:justify-start">
            <a
              href="tel:+905469118061"
              class="bg-blue-600 hover:bg-blue-700 text-white px-8 py-4 rounded-2xl font-bold text-base shadow-xl transition flex items-center gap-3"
            >
              <i class="fas fa-phone"></i> Hemen Ara
            </a>
            <Link
              :href="route('service-requests.create')"
              class="bg-slate-700 hover:bg-slate-600 text-white px-8 py-4 rounded-2xl font-bold text-base transition flex items-center gap-3"
            >
              <i class="fas fa-clipboard-list"></i> Servis Talebi Oluştur
            </Link>
          </div>
        </div>
      </div>

      <!-- Hizmet Kartları -->
      <div class="mb-16">
        <h2 class="text-2xl font-bold text-white mb-8 text-center">
          {{ district.name }}'da Verdiğimiz Hizmetler
        </h2>
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
          <Link
            v-for="service in services"
            :key="service.slug"
            :href="route(service.route)"
            class="group bg-slate-800 rounded-3xl p-7 border border-slate-700 hover:border-blue-400/40 hover:shadow-lg transition-all duration-300 flex flex-col items-start gap-4"
          >
            <div :class="['w-14 h-14 rounded-2xl flex items-center justify-center text-2xl', service.bg]">
              <i :class="[service.icon, service.color]"></i>
            </div>
            <div>
              <h3 class="text-base font-bold text-white group-hover:text-blue-500 transition-colors mb-1">
                {{ district.name }} {{ service.name }}
              </h3>
              <p class="text-sm text-slate-400 leading-relaxed">{{ service.desc }}</p>
            </div>
            <span class="mt-auto text-xs font-semibold text-blue-500 flex items-center gap-1">
              Detaylı Bilgi <i class="fas fa-arrow-right text-[10px]"></i>
            </span>
          </Link>
        </div>
      </div>

      <!-- Neden Biz -->
      <div class="bg-slate-800 rounded-3xl p-10 md:p-14 border border-slate-700 mb-16">
        <h2 class="text-2xl font-bold text-white mb-8 text-center">
          Neden {{ district.name }} İçin TürkTeknik?
        </h2>
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
          <div v-for="reason in reasons" :key="reason.title" class="flex items-start gap-4">
            <div class="w-10 h-10 rounded-xl bg-blue-500/10 flex items-center justify-center flex-shrink-0">
              <i :class="[reason.icon, 'text-blue-500']"></i>
            </div>
            <div>
              <p class="font-bold text-white text-sm mb-1">{{ reason.title }}</p>
              <p class="text-slate-400 text-sm leading-relaxed">{{ reason.desc }}</p>
            </div>
          </div>
        </div>
      </div>

      <!-- SSS -->
      <div class="max-w-3xl mx-auto mb-16">
        <h2 class="text-2xl font-bold text-white text-center mb-8">
          {{ district.name }} İçin Sıkça Sorulan Sorular
        </h2>
        <div class="space-y-4">
          <div
            v-for="(faq, i) in faqs"
            :key="i"
            class="bg-slate-800 rounded-2xl border border-slate-700 overflow-hidden"
          >
            <button
              @click="openFaq = openFaq === i ? null : i"
              class="w-full px-6 py-5 text-left flex justify-between items-center group"
            >
              <span class="font-bold text-slate-200 text-sm group-hover:text-blue-500 transition-colors">
                {{ faq.q.replace('{district}', district.name) }}
              </span>
              <i :class="['fas fa-chevron-down text-slate-400 text-xs transition-transform', openFaq === i ? 'rotate-180' : '']"></i>
            </button>
            <div v-if="openFaq === i" class="px-6 pb-5 text-slate-400 text-sm leading-relaxed border-t border-slate-700 pt-4">
              {{ faq.a.replace('{district}', district.name) }}
            </div>
          </div>
        </div>
      </div>

      <!-- Diğer İlçeler -->
      <div class="mb-8">
        <h2 class="text-xl font-bold text-white mb-5 text-center">
          İzmir'de Hizmet Verdiğimiz Diğer İlçeler
        </h2>
        <div class="flex flex-wrap gap-3 justify-center">
          <Link
            v-for="d in otherDistricts"
            :key="d.slug"
            :href="`/izmir/${d.slug}`"
            class="px-4 py-2 bg-slate-800 border border-slate-700 rounded-xl text-sm font-medium text-slate-300 hover:border-blue-400 hover:text-blue-500 transition"
          >
            {{ d.name }}
          </Link>
        </div>
      </div>

    </div>

    <!-- WhatsApp Floating Button -->
    <a href="https://wa.me/905469118061" target="_blank" rel="noopener noreferrer"
       class="float-wp fixed bottom-6 right-6 w-11 h-11 rounded-full flex items-center justify-center z-50"
       aria-label="WhatsApp ile İletişim">
      <i class="fab fa-whatsapp text-2xl text-white"></i>
    </a>
  </div>
</template>

<script setup lang="ts">
import { computed, ref } from 'vue';
import { Link, usePage } from '@inertiajs/vue3';
import { useHead } from '@vueuse/head';
import SEO from '@/components/SEO.vue';
import TopBar from '@/components/TopBar.vue';

interface District {
  name: string;
  title: string;
  description: string;
  seoTitle: string;
  seoDesc: string;
  keywords: string;
}

interface DistrictItem {
  slug: string;
  name: string;
}

const props = defineProps<{
  district: District;
  allDistricts: DistrictItem[];
}>();

const page = usePage();
// URL'den slug çıkar: /izmir/konak → konak
const districtSlug = computed(() => {
  const path = page.url;
  return path.split('/').pop() ?? '';
});

const otherDistricts = computed(() =>
  props.allDistricts.filter(d => d.slug !== districtSlug.value)
);

useHead(computed(() => ({
  script: [
    {
      type: 'application/ld+json',
      innerHTML: JSON.stringify({
        '@context': 'https://schema.org',
        '@type': 'LocalBusiness',
        name: `TürkTeknik - ${props.district.name} Teknik Servis`,
        description: props.district.description,
        telephone: '+905469118061',
        url: `https://turkteknik.com.tr/izmir/${districtSlug.value}`,
        areaServed: [
          { '@type': 'City', name: 'İzmir' },
          { '@type': 'Place', name: props.district.name },
        ],
        address: {
          '@type': 'PostalAddress',
          addressLocality: props.district.name,
          addressRegion: 'İzmir',
          addressCountry: 'TR',
        },
        hasOfferCatalog: {
          '@type': 'OfferCatalog',
          name: `${props.district.name} Teknik Servis Hizmetleri`,
          itemListElement: [
            { '@type': 'Offer', itemOffered: { '@type': 'Service', name: `${props.district.name} İnternet Teknik Servis` } },
            { '@type': 'Offer', itemOffered: { '@type': 'Service', name: `${props.district.name} Güvenlik Kamera Kurulumu` } },
            { '@type': 'Offer', itemOffered: { '@type': 'Service', name: `${props.district.name} Çanak Anten Montajı` } },
            { '@type': 'Offer', itemOffered: { '@type': 'Service', name: `${props.district.name} Elektrik Teknik Servis` } },
          ],
        },
      }),
      key: 'local-business-location',
    },
    {
      type: 'application/ld+json',
      innerHTML: JSON.stringify({
        '@context': 'https://schema.org',
        '@type': 'FAQPage',
        mainEntity: [
          {
            '@type': 'Question',
            name: `${props.district.name}'da internet arızası için kim aranır?`,
            acceptedAnswer: {
              '@type': 'Answer',
              text: `${props.district.name}'da internet arızanız için TürkTeknik'i arayabilirsiniz: 0546 911 80 61. Aynı gün servis veriyoruz.`,
            },
          },
          {
            '@type': 'Question',
            name: `${props.district.name}'da güvenlik kamerası kurulumu yapıyor musunuz?`,
            acceptedAnswer: {
              '@type': 'Answer',
              text: `Evet, ${props.district.name}'da IP kamera ve AHD güvenlik kamera sistemi kurulumu, DVR/NVR montajı ve uzaktan izleme ayarlarını yapıyoruz.`,
            },
          },
          {
            '@type': 'Question',
            name: `${props.district.name}'da çanak anten bozulunca ne yapmalıyım?`,
            acceptedAnswer: {
              '@type': 'Answer',
              text: `TürkTeknik olarak ${props.district.name}'da çanak anten tamiri, LNB değişimi ve uydu yön ayarı yapıyoruz. 0546 911 80 61 numaralı hattı arayın.`,
            },
          },
        ],
      }),
      key: 'faq-location',
    },
  ],
})));

const openFaq = ref<number | null>(null);

const services = [
  {
    name: 'İnternet Servisi',
    desc: 'Fiber/VDSL arıza, modem kurulumu, Mesh Wi-Fi ve hız optimizasyonu.',
    icon: 'fas fa-wifi',
    color: 'text-blue-500',
    bg: 'bg-blue-500/10',
    route: 'services.internet',
    slug: 'internet',
  },
  {
    name: 'Güvenlik Kamerası',
    desc: 'IP/AHD kamera kurulumu, DVR/NVR montajı, uzaktan mobil izleme.',
    icon: 'fas fa-video',
    color: 'text-indigo-500',
    bg: 'bg-indigo-500/10',
    route: 'services.camera',
    slug: 'kamera',
  },
  {
    name: 'Uydu & Anten',
    desc: 'Çanak anten montajı, LNB değişimi, merkezi sistem (SMATV).',
    icon: 'fas fa-satellite-dish',
    color: 'text-emerald-500',
    bg: 'bg-emerald-500/10',
    route: 'services.satellite',
    slug: 'uydu',
  },
  {
    name: 'Elektrik Servisi',
    desc: 'Sigorta panosu, kaçak akım rölesi, LED aydınlatma, tesisat yenileme.',
    icon: 'fas fa-bolt',
    color: 'text-amber-500',
    bg: 'bg-amber-500/10',
    route: 'services.elektrik',
    slug: 'elektrik',
  },
];

const reasons = [
  { icon: 'fas fa-clock', title: 'Aynı Gün Servis', desc: '{district}\'da en kısa sürede yerinde müdahale ediyoruz.' },
  { icon: 'fas fa-shield-alt', title: 'Garantili İşçilik', desc: 'Tüm hizmetlerimizde %100 memnuniyet ve işçilik garantisi.' },
  { icon: 'fas fa-tag', title: 'Şeffaf Fiyat', desc: 'Gizli ücret yok. Fiyat önceden belirlenir, sürpriz olmaz.' },
  { icon: 'fas fa-user-tie', title: 'Sertifikalı Ekip', desc: 'Alanında eğitimli ve deneyimli teknisyenler.' },
  { icon: 'fas fa-phone', title: '7/24 Destek', desc: 'Hafta sonu ve tatil günlerinde de ulaşabilirsiniz.' },
  { icon: 'fas fa-map-marker-alt', title: 'Yerel Servis', desc: '{district} ve çevresine özel hızlı ulaşım.' },
];

const faqs = [
  {
    q: '{district}\'da internet arızası için kim aranır?',
    a: '{district}\'da internet arızanız için TürkTeknik\'i arayabilirsiniz: 0546 911 80 61. Aynı gün servis garantisi veriyoruz. Fiber, VDSL ve Wi-Fi sorunlarınızı çözüyoruz.',
  },
  {
    q: '{district}\'da güvenlik kamerası kurulumu yapıyor musunuz?',
    a: 'Evet, {district}\'da ev ve iş yeri için IP kamera, AHD kamera sistemi kurulumu, DVR/NVR montajı ve mobil izleme yapılandırması hizmeti veriyoruz.',
  },
  {
    q: '{district}\'da çanak anten tamiri yapıyor musunuz?',
    a: '{district}\'da çanak anten yön ayarı, LNB değişimi, kablo onarımı ve merkezi uydu sistemi bakımı yapıyoruz. Yağmurda sinyal gidiyorsa da yardımcı oluruz.',
  },
  {
    q: '{district}\'da elektrikçi hizmeti veriyor musunuz?',
    a: '{district}\'da sigorta panosu kurulumu, kaçak akım rölesi değişimi, LED aydınlatma montajı ve elektrik tesisat yenileme hizmetleri veriyoruz.',
  },
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

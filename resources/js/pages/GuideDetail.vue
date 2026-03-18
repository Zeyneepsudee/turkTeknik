<template>
  <div class="min-h-screen bg-slate-900 flex flex-col pt-24 pb-16 px-4">
    <TopBar />

    <SEO
      :title="guide.seoTitle"
      :description="guide.seoDesc"
      :url="`https://turkteknik.com.tr/rehberler/${guide.slug}`"
      :keywords="guide.keywords"
    />

    <div class="max-w-5xl mx-auto w-full flex-grow">

      <!-- Breadcrumb -->
      <nav class="flex items-center gap-2 text-sm text-slate-400 mb-8" aria-label="Breadcrumb">
        <Link href="/" class="hover:text-blue-500 transition-colors">Ana Sayfa</Link>
        <i class="fas fa-chevron-right text-[10px]"></i>
        <Link href="/rehberler" class="hover:text-blue-500 transition-colors">Rehberler</Link>
        <i class="fas fa-chevron-right text-[10px]"></i>
        <span class="text-slate-300 font-medium truncate">{{ guide.title }}</span>
      </nav>

      <div class="grid grid-cols-1 lg:grid-cols-[1fr_300px] gap-8">

        <!-- Main Article -->
        <article>

          <!-- Article Header -->
          <div class="bg-slate-800 rounded-3xl border border-slate-700 p-8 mb-6">
            <div class="flex items-center gap-3 mb-5">
              <div :class="['w-12 h-12 rounded-2xl flex items-center justify-center flex-shrink-0', `bg-${guide.color}-500/10`]">
                <i :class="[guide.icon, `text-${guide.color}-500`, 'text-2xl']"></i>
              </div>
              <span :class="[`text-${guide.color}-500`, 'text-sm font-semibold uppercase tracking-wider']">
                {{ categoryLabel }}
              </span>
            </div>
            <h1 class="text-2xl md:text-4xl font-extrabold text-white mb-5 leading-tight">
              {{ guide.title }}
            </h1>
            <p class="text-slate-300 text-lg leading-relaxed">
              {{ guide.intro }}
            </p>
          </div>

          <!-- Sections -->
          <div class="space-y-5 mb-8">
            <div
              v-for="(section, i) in guide.sections"
              :key="i"
              class="bg-slate-800 rounded-3xl border border-slate-700 p-7"
            >
              <h2 class="text-lg font-bold text-white mb-4 flex items-center gap-2">
                <span :class="[`bg-${guide.color}-500`, 'w-1.5 h-6 rounded-full flex-shrink-0']"></span>
                {{ section.heading }}
              </h2>
              <p class="text-slate-300 leading-relaxed mb-4">
                {{ section.content }}
              </p>
              <!-- Tips -->
              <div v-if="section.tips && section.tips.length" class="space-y-2 mt-4">
                <div
                  v-for="(tip, ti) in section.tips"
                  :key="ti"
                  class="flex items-start gap-2 text-sm text-slate-400 bg-slate-700/50 rounded-xl px-4 py-3"
                >
                  <i :class="[`text-${guide.color}-400`, 'fas fa-lightbulb flex-shrink-0 mt-0.5 text-xs']"></i>
                  <span>{{ tip }}</span>
                </div>
              </div>
            </div>
          </div>

          <!-- FAQ Section -->
          <div class="bg-slate-800 rounded-3xl border border-slate-700 p-8 mb-6">
            <h2 class="text-xl font-bold text-white mb-6">Sıkça Sorulan Sorular</h2>
            <div class="space-y-4">
              <div
                v-for="(faq, fi) in guide.faqs"
                :key="fi"
                class="border border-slate-700 rounded-2xl overflow-hidden"
              >
                <button
                  @click="openFaq = openFaq === fi ? null : fi"
                  class="w-full px-5 py-4 text-left flex justify-between items-center group"
                >
                  <span class="font-semibold text-slate-200 text-sm group-hover:text-blue-500 transition-colors pr-4">
                    {{ faq.q }}
                  </span>
                  <i :class="['fas fa-chevron-down text-slate-400 text-xs transition-transform flex-shrink-0', openFaq === fi ? 'rotate-180' : '']"></i>
                </button>
                <div v-if="openFaq === fi" class="px-5 pb-5 pt-1 text-slate-400 text-sm leading-relaxed border-t border-slate-700">
                  {{ faq.a }}
                </div>
              </div>
            </div>
          </div>

          <!-- CTA Card -->
          <div :class="[`bg-${guide.color}-600`, 'rounded-3xl p-8 text-white']">
            <div class="flex flex-col md:flex-row items-center gap-6">
              <div class="flex-1 text-center md:text-left">
                <h3 class="text-xl font-bold mb-2">Sorunu Kendiniz Çözemediniz mi?</h3>
                <p :class="[`text-${guide.color}-100`, 'opacity-90 text-sm leading-relaxed']">
                  İzmir'de aynı gün, garantili teknik servis. 0546 911 80 61 numarasını arayın veya servis talebi oluşturun.
                </p>
              </div>
              <div class="flex flex-col gap-3 flex-shrink-0">
                <a
                  href="tel:+905469118061"
                  class="bg-white/20 hover:bg-white/30 text-white border border-white/30 px-6 py-3 rounded-2xl font-bold text-sm transition flex items-center gap-2 justify-center"
                >
                  <i class="fas fa-phone"></i> Hemen Ara
                </a>
                <Link
                  :href="route('service-requests.create')"
                  class="bg-white text-blue-700 hover:bg-blue-50 px-6 py-3 rounded-2xl font-bold text-sm transition flex items-center gap-2 justify-center"
                >
                  <i class="fas fa-clipboard-list"></i> Servis Talebi
                </Link>
              </div>
            </div>
          </div>

        </article>

        <!-- Sidebar -->
        <aside class="hidden lg:block">

          <!-- Quick Contact -->
          <div class="bg-slate-800 rounded-3xl border border-slate-700 p-6 mb-5 sticky top-28">
            <h3 class="font-bold text-white mb-4 text-sm">Hızlı Destek</h3>
            <a
              href="tel:+905469118061"
              class="flex items-center gap-3 bg-blue-600 hover:bg-blue-700 text-white px-5 py-3 rounded-2xl font-semibold text-sm transition mb-3"
            >
              <i class="fas fa-phone text-base"></i>
              <span>0546 911 80 61</span>
            </a>
            <a
              href="https://wa.me/905469118061"
              target="_blank"
              class="flex items-center gap-3 bg-emerald-500 hover:bg-emerald-600 text-white px-5 py-3 rounded-2xl font-semibold text-sm transition mb-3"
            >
              <i class="fab fa-whatsapp text-base"></i>
              <span>WhatsApp Yaz</span>
            </a>
            <Link
              :href="route('service-requests.create')"
              class="flex items-center gap-3 bg-slate-700 hover:bg-slate-600 text-slate-200 px-5 py-3 rounded-2xl font-semibold text-sm transition"
            >
              <i class="fas fa-clipboard-list text-blue-500"></i>
              <span>Servis Talebi</span>
            </Link>

            <div class="mt-5 pt-5 border-t border-slate-700 text-xs text-gray-400 text-center leading-relaxed">
              Aynı gün servis · Garantili işçilik · İzmir geneli
            </div>
          </div>

          <!-- Related Guides -->
          <div v-if="related.length" class="bg-slate-800 rounded-3xl border border-slate-700 p-6">
            <h3 class="font-bold text-white mb-4 text-sm">İlgili Rehberler</h3>
            <div class="space-y-3">
              <Link
                v-for="r in related"
                :key="r.slug"
                :href="`/rehberler/${r.slug}`"
                class="flex items-center gap-3 group"
              >
                <div :class="['w-9 h-9 rounded-xl flex items-center justify-center flex-shrink-0', `bg-${r.color}-500/10`]">
                  <i :class="[r.icon, `text-${r.color}-500`, 'text-sm']"></i>
                </div>
                <span class="text-sm text-slate-300 group-hover:text-blue-500 transition-colors leading-snug">
                  {{ r.title }}
                </span>
              </Link>
            </div>
          </div>

        </aside>
      </div>

    </div>

    <!-- WhatsApp Floating -->
    <a href="https://wa.me/905469118061" target="_blank" rel="noopener noreferrer"
       class="float-wp fixed bottom-6 right-6 w-11 h-11 rounded-full flex items-center justify-center z-50"
       aria-label="WhatsApp ile İletişim">
      <i class="fab fa-whatsapp text-2xl text-white"></i>
    </a>
  </div>
</template>

<script setup lang="ts">
import { ref, computed } from 'vue';
import { Link } from '@inertiajs/vue3';
import { useHead } from '@vueuse/head';
import SEO from '@/components/SEO.vue';
import TopBar from '@/components/TopBar.vue';

interface Section {
  heading: string;
  content: string;
  tips?: string[];
}

interface FAQ {
  q: string;
  a: string;
}

interface Guide {
  slug: string;
  category: string;
  title: string;
  seoTitle: string;
  seoDesc: string;
  keywords: string;
  icon: string;
  color: string;
  intro: string;
  sections: Section[];
  faqs: FAQ[];
  ctaService: string;
  ctaRoute: string;
}

interface RelatedGuide {
  slug: string;
  title: string;
  icon: string;
  color: string;
}

const props = defineProps<{
  guide: Guide;
  related: RelatedGuide[];
}>();

const openFaq = ref<number | null>(null);

const categoryLabels: Record<string, string> = {
  internet: 'İnternet & Modem',
  uydu: 'Uydu & Çanak Anten',
  kamera: 'Güvenlik Kameraları',
};

const categoryLabel = computed(() => categoryLabels[props.guide.category] ?? 'Teknik Rehber');

useHead(computed(() => ({
  script: [
    {
      type: 'application/ld+json',
      innerHTML: JSON.stringify({
        '@context': 'https://schema.org',
        '@type': 'BreadcrumbList',
        itemListElement: [
          { '@type': 'ListItem', position: 1, name: 'Ana Sayfa', item: 'https://turkteknik.com.tr/' },
          { '@type': 'ListItem', position: 2, name: 'Teknik Rehberler', item: 'https://turkteknik.com.tr/rehberler' },
          { '@type': 'ListItem', position: 3, name: props.guide.title, item: `https://turkteknik.com.tr/rehberler/${props.guide.slug}` },
        ],
      }),
      key: 'breadcrumb-guide-detail',
    },
    {
      type: 'application/ld+json',
      innerHTML: JSON.stringify({
        '@context': 'https://schema.org',
        '@type': 'Article',
        headline: props.guide.title,
        description: props.guide.seoDesc,
        author: { '@type': 'Organization', name: 'TürkTeknik', url: 'https://turkteknik.com.tr' },
        publisher: {
          '@type': 'Organization',
          name: 'TürkTeknik',
          logo: { '@type': 'ImageObject', url: 'https://turkteknik.com.tr/images/og-image.jpg' },
        },
        mainEntityOfPage: `https://turkteknik.com.tr/rehberler/${props.guide.slug}`,
      }),
      key: 'article-schema',
    },
    {
      type: 'application/ld+json',
      innerHTML: JSON.stringify({
        '@context': 'https://schema.org',
        '@type': 'FAQPage',
        mainEntity: props.guide.faqs.map(f => ({
          '@type': 'Question',
          name: f.q,
          acceptedAnswer: { '@type': 'Answer', text: f.a },
        })),
      }),
      key: 'faq-guide',
    },
  ],
})));
</script>

<style scoped>
@keyframes float-bob {
  0%, 100% { transform: translateY(0); }
  50%       { transform: translateY(-6px); }
}
.float-wp { background:#25d366; box-shadow:0 4px 16px rgba(37,211,102,0.5); animation: float-bob 2.8s ease-in-out infinite; }
.float-wp:hover { animation: none; transform:scale(1.12); box-shadow:0 6px 24px rgba(37,211,102,0.65); }
</style>

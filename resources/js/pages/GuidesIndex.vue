<template>
  <div class="min-h-screen flex flex-col guides-page">
    <TopBar />

    <SEO
      title="Teknik Rehberler — Modem, Anten, Kamera Sorun Çözüm Merkezi | TürkTeknik İzmir"
      description="İzmir teknik servis rehberleri: ZTE/TP-Link modem kurulumu, Vodafone arızası, DiSEqC ayarı, güvenlik kamerası uzaktan izleme ve daha fazlası. Adım adım çözümler."
      url="https://turkteknik.com.tr/rehberler"
      keywords="teknik rehber izmir, modem kurulumu, uydu ayarı, kamera arıza çözümü, internet sorun giderme, türkteknik rehber"
    />

    <div class="max-w-6xl mx-auto w-full flex-grow px-4 pt-28 pb-20">

      <!-- ═══════════════════════════════════════════════════ HERO -->
      <div class="hero-card relative rounded-[2.5rem] overflow-hidden mb-16">
        <div class="blob blob-1"></div>
        <div class="blob blob-2"></div>
        <div class="blob blob-3"></div>

        <!-- Grid overlay -->
        <svg class="absolute inset-0 w-full h-full grid-svg" xmlns="http://www.w3.org/2000/svg">
          <defs>
            <pattern id="sg" x="0" y="0" width="44" height="44" patternUnits="userSpaceOnUse">
              <path d="M 44 0 L 0 0 0 44" fill="none" stroke="white" stroke-width="0.6"/>
            </pattern>
          </defs>
          <rect width="100%" height="100%" fill="url(#sg)"/>
        </svg>

        <!-- Split layout: text + illustration -->
        <div class="relative z-10 flex flex-col lg:flex-row lg:items-center gap-6 py-14 px-6 md:px-14">

          <!-- Text block -->
          <div class="flex-1 text-center lg:text-left">
            <div class="hero-badge inline-flex items-center gap-2 px-4 py-2 rounded-full mb-7 text-xs font-bold uppercase tracking-widest">
              <i class="fas fa-book-open text-[10px]"></i> Sorun Çözüm Merkezi
            </div>
            <h1 class="hero-title text-4xl md:text-5xl font-extrabold text-white mb-5 leading-tight">
              Teknik <span class="gradient-text">Rehberler</span>
            </h1>
            <p class="hero-sub text-base md:text-lg leading-relaxed mb-9 text-slate-300 max-w-lg lg:max-w-none mx-auto">
              İzmir'de internet, uydu ve kamera sistemi sorunlarına adım adım çözümler.
              Probleminizi tanımlamak veya kendiniz çözmek için doğru yerdesiniz.
            </p>
            <div class="hero-chips flex flex-wrap gap-3 justify-center lg:justify-start">
              <span class="cat-chip chip-blue"><i class="fas fa-wifi mr-1.5 text-[10px]"></i>İnternet & Modem</span>
              <span class="cat-chip chip-purple"><i class="fas fa-satellite-dish mr-1.5 text-[10px]"></i>Uydu & Anten</span>
              <span class="cat-chip chip-green"><i class="fas fa-video mr-1.5 text-[10px]"></i>Güvenlik Kamerası</span>
            </div>
          </div>

          <!-- ── Network SVG Illustration ── -->
          <div class="hero-illustration flex-shrink-0 w-72 mx-auto lg:mx-0 hero-svg-wrap" aria-hidden="true">
            <svg viewBox="0 0 300 250" fill="none" xmlns="http://www.w3.org/2000/svg" class="w-full h-auto">

              <!-- Outer rings -->
              <circle cx="150" cy="125" r="112" stroke="rgba(147,197,253,0.05)" stroke-width="1"/>
              <circle cx="150" cy="125" r="87"  stroke="rgba(147,197,253,0.07)" stroke-width="1"/>
              <circle cx="150" cy="125" r="62"  stroke="rgba(0,180,255,0.09)"   stroke-width="1.5"/>
              <!-- Spinning dashed ring -->
              <circle cx="150" cy="125" r="62" stroke="rgba(0,180,255,0.18)" stroke-width="1"
                      stroke-dasharray="9 6" class="ring-spin"/>

              <!-- Center hub -->
              <circle cx="150" cy="125" r="32" fill="rgba(0,180,255,0.1)" class="hub-pulse"/>
              <circle cx="150" cy="125" r="32" stroke="#00b4ff" stroke-width="1.5" fill="none"/>

              <!-- WiFi signal arcs -->
              <path d="M143 132 Q150 119 157 132" stroke="#7dd3fc" fill="none" stroke-width="2.5" stroke-linecap="round"/>
              <path d="M137 138 Q150 115 163 138" stroke="#7dd3fc" fill="none" stroke-width="1.8" stroke-linecap="round" opacity="0.65"/>
              <path d="M131 144 Q150 109 169 144" stroke="#7dd3fc" fill="none" stroke-width="1.2" stroke-linecap="round" opacity="0.4"/>
              <circle cx="150" cy="134" r="3.5" fill="#00b4ff"/>

              <!-- ── Node: Router (top) ── -->
              <line x1="150" y1="93" x2="150" y2="46" stroke="rgba(147,197,253,0.22)" stroke-width="1.5" stroke-dasharray="5 4"/>
              <circle cx="150" cy="30" r="25" fill="rgba(59,130,246,0.14)" stroke="#93c5fd" stroke-width="1.5" class="node-pulse"/>
              <rect x="141" y="24" width="18" height="11" rx="2" stroke="#93c5fd" stroke-width="1.5" fill="rgba(147,197,253,0.12)"/>
              <line x1="146" y1="24" x2="145" y2="19" stroke="#93c5fd" stroke-width="1.5" stroke-linecap="round"/>
              <line x1="155" y1="24" x2="156" y2="19" stroke="#93c5fd" stroke-width="1.5" stroke-linecap="round"/>
              <line x1="144" y1="29" x2="156" y2="29" stroke="#93c5fd" stroke-width="1" opacity="0.45"/>

              <!-- ── Node: Satellite (bottom-right) ── -->
              <line x1="174" y1="148" x2="218" y2="187" stroke="rgba(216,180,254,0.22)" stroke-width="1.5" stroke-dasharray="5 4"/>
              <circle cx="230" cy="200" r="25" fill="rgba(168,85,247,0.14)" stroke="#d8b4fe" stroke-width="1.5" class="node-pulse"/>
              <path d="M224 205 Q230 193 236 205" stroke="#d8b4fe" fill="none" stroke-width="2.2" stroke-linecap="round"/>
              <path d="M220 208 Q230 189 240 208" stroke="#d8b4fe" fill="none" stroke-width="1.5" stroke-linecap="round" opacity="0.55"/>
              <line x1="230" y1="205" x2="230" y2="211" stroke="#d8b4fe" stroke-width="2" stroke-linecap="round"/>

              <!-- ── Node: Camera (bottom-left) ── -->
              <line x1="126" y1="148" x2="82" y2="187" stroke="rgba(110,231,183,0.22)" stroke-width="1.5" stroke-dasharray="5 4"/>
              <circle cx="70" cy="200" r="25" fill="rgba(16,185,129,0.14)" stroke="#6ee7b7" stroke-width="1.5" class="node-pulse"/>
              <rect x="61" y="194" width="15" height="12" rx="2.5" stroke="#6ee7b7" stroke-width="1.5" fill="rgba(110,231,183,0.1)"/>
              <circle cx="68.5" cy="200" r="3.5" stroke="#6ee7b7" stroke-width="1.5" fill="none"/>
              <path d="M76 196 L82 193 L82 207 L76 204 Z" stroke="#6ee7b7" stroke-width="1.5" stroke-linejoin="round"/>

              <!-- ── Animated data packets ── -->
              <!-- Top packet (router line) -->
              <circle r="4" fill="#7dd3fc" opacity="0.9">
                <animateMotion dur="2.8s" repeatCount="indefinite" begin="0s">
                  <mpath href="#path-top"/>
                </animateMotion>
                <animate attributeName="opacity" values="0;1;1;0" dur="2.8s" repeatCount="indefinite"/>
              </circle>

              <!-- Right packet (satellite line) -->
              <circle r="4" fill="#d8b4fe" opacity="0.9">
                <animateMotion dur="3.2s" repeatCount="indefinite" begin="1s">
                  <mpath href="#path-right"/>
                </animateMotion>
                <animate attributeName="opacity" values="0;1;1;0" dur="3.2s" repeatCount="indefinite" begin="1s"/>
              </circle>

              <!-- Left packet (camera line) -->
              <circle r="4" fill="#6ee7b7" opacity="0.9">
                <animateMotion dur="3s" repeatCount="indefinite" begin="0.5s">
                  <mpath href="#path-left"/>
                </animateMotion>
                <animate attributeName="opacity" values="0;1;1;0" dur="3s" repeatCount="indefinite" begin="0.5s"/>
              </circle>

              <!-- Motion paths (hidden) -->
              <path id="path-top"   d="M150,93 L150,46"     visibility="hidden"/>
              <path id="path-right" d="M174,148 L218,187"   visibility="hidden"/>
              <path id="path-left"  d="M126,148 L82,187"    visibility="hidden"/>

              <!-- Floating ambient dots -->
              <circle cx="36"  cy="58"  r="2.5" fill="rgba(0,180,255,0.45)" class="fdot-1"/>
              <circle cx="268" cy="72"  r="2"   fill="rgba(168,85,247,0.4)" class="fdot-2"/>
              <circle cx="28"  cy="185" r="2"   fill="rgba(16,185,129,0.4)" class="fdot-3"/>
              <circle cx="276" cy="185" r="2.5" fill="rgba(245,158,11,0.4)" class="fdot-4"/>
              <circle cx="150" cy="8"   r="2"   fill="rgba(147,197,253,0.5)" class="fdot-5"/>
            </svg>
          </div>
        </div>
      </div>

      <!-- ═══════════════════════════════════════════ CATEGORIES -->
      <div
        v-for="(cat, ci) in grouped"
        :key="cat.label"
        class="mb-16"
        data-reveal
        :style="`--delay:${ci * 0.1}s`"
      >
        <!-- Category Header -->
        <div class="flex items-center gap-3 mb-8">
          <div class="cat-icon-wrap"
               :style="{ background: catColors(cat.color).bg, boxShadow:`0 0 16px ${catColors(cat.color).glow}` }">
            <i :class="cat.icon" class="text-base" :style="{ color: catColors(cat.color).text }"></i>
          </div>
          <h2 class="text-lg font-bold text-white whitespace-nowrap">{{ cat.label }}</h2>
          <div class="flex-1 h-px" :style="{ background:`linear-gradient(to right,${catColors(cat.color).border},transparent)` }"></div>
          <span class="text-xs font-semibold px-3 py-1 rounded-full" :style="{ background:catColors(cat.color).bg, color:catColors(cat.color).text, border:`1px solid ${catColors(cat.color).border}` }">
            {{ cat.guides.length }} rehber
          </span>
        </div>

        <!-- Guide Cards Grid -->
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-5">
          <Link
            v-for="(guide, gi) in cat.guides"
            :key="guide.slug"
            :href="`/rehberler/${guide.slug}`"
            class="guide-card group relative flex flex-col rounded-2xl overflow-hidden"
            data-reveal
            :style="`--delay:${ci * 0.08 + gi * 0.07}s`"
          >
            <!-- ── Visual image header area ── -->
            <div class="card-img relative overflow-hidden"
                 :style="{ '--ccolor': guideColors(guide.color).text, '--cbg': guideColors(guide.color).bg }">
              <!-- Dot-grid pattern -->
              <div class="card-dots absolute inset-0" :style="{ '--dot': guideColors(guide.color).text }"></div>
              <!-- Glow behind icon -->
              <div class="absolute inset-0 flex items-center justify-center">
                <div class="icon-glow absolute w-20 h-20 rounded-full"
                     :style="{ background: guideColors(guide.color).text + '18', filter:'blur(14px)' }"></div>
                <i :class="guide.icon" class="relative text-4xl transition-transform duration-500 group-hover:scale-110"
                   :style="{ color: guideColors(guide.color).text, filter:`drop-shadow(0 0 12px ${guideColors(guide.color).glow})` }"></i>
              </div>
              <!-- Top accent line -->
              <div class="absolute top-0 inset-x-0 h-[2px]"
                   :style="{ background:`linear-gradient(to right,${guideColors(guide.color).text},transparent)` }"></div>
              <!-- Category badge -->
              <div class="absolute top-3 right-3 text-[10px] font-bold px-2 py-0.5 rounded-full"
                   :style="{ background: guideColors(guide.color).bg, color: guideColors(guide.color).text, border:`1px solid ${guideColors(guide.color).border}` }">
                {{ cat.label }}
              </div>
            </div>

            <!-- ── Card content ── -->
            <div class="p-5 flex flex-col gap-3 flex-1 card-body">
              <h3 class="font-bold text-white text-sm leading-snug group-hover:opacity-80 transition-opacity">
                {{ guide.title }}
              </h3>
              <p class="text-xs leading-relaxed flex-1 text-slate-400 line-clamp-2">
                {{ guide.seoDesc }}
              </p>
              <div class="read-link flex items-center gap-1.5 text-xs font-semibold mt-auto pt-2"
                   :style="{ color: guideColors(guide.color).text, borderTop:`1px solid ${guideColors(guide.color).border}28` }">
                Rehberi Oku
                <i class="fas fa-arrow-right text-[9px] transition-transform duration-200 group-hover:translate-x-1.5"></i>
              </div>
            </div>
          </Link>
        </div>
      </div>

      <!-- ═══════════════════════════════════════════════ CTA -->
      <div class="cta-section relative rounded-[2.5rem] overflow-hidden text-center py-14 px-8" data-reveal>
        <div class="blob cta-blob-1"></div>
        <div class="blob cta-blob-2"></div>
        <div class="relative z-10">
          <div class="cta-icon-wrap inline-flex items-center justify-center w-14 h-14 rounded-2xl mb-5">
            <i class="fas fa-headset text-xl text-[#7dd3fc]"></i>
          </div>
          <h2 class="text-2xl md:text-3xl font-bold text-white mb-3">Sorunu Kendiniz Çözemediyseniz</h2>
          <p class="mb-8 max-w-xl mx-auto text-base text-slate-300">
            İzmir genelinde aynı gün servis, garantili işçilik ve şeffaf fiyatlandırma ile yanınızdayız.
          </p>
          <div class="flex flex-wrap gap-4 justify-center">
            <a href="tel:+905469118061" class="cta-btn-outline flex items-center gap-3 px-7 py-3.5 rounded-2xl font-bold text-sm">
              <i class="fas fa-phone"></i> 0546 911 80 61
            </a>
            <Link :href="route('service-requests.create')" class="cta-btn-fill flex items-center gap-3 px-7 py-3.5 rounded-2xl font-bold text-sm text-white">
              <i class="fas fa-clipboard-list"></i> Servis Talebi Oluştur
            </Link>
          </div>
        </div>
      </div>

    </div>

    <a href="https://wa.me/905469118061" target="_blank" class="whatsapp-btn fixed bottom-8 right-8 w-14 h-14 rounded-full flex items-center justify-center z-50">
      <i class="fab fa-whatsapp text-3xl text-white"></i>
    </a>
  </div>
</template>

<script setup lang="ts">
import { computed, onMounted, onUnmounted } from 'vue';
import { Link } from '@inertiajs/vue3';
import { useHead } from '@vueuse/head';
import SEO from '@/components/SEO.vue';
import TopBar from '@/components/TopBar.vue';

interface GuideCard { slug: string; title: string; icon: string; color: string; seoDesc: string; }
interface CategoryGroup { label: string; icon: string; color: string; guides: GuideCard[]; }
const props = defineProps<{ grouped: CategoryGroup[] }>();

// Scroll reveal
let io: IntersectionObserver | null = null;
onMounted(() => {
  io = new IntersectionObserver((entries) => {
    entries.forEach(e => {
      if (e.isIntersecting) {
        (e.target as HTMLElement).classList.add('is-visible');
        io?.unobserve(e.target);
      }
    });
  }, { threshold: 0.08, rootMargin: '0px 0px -40px 0px' });
  document.querySelectorAll('[data-reveal]').forEach(el => io!.observe(el));
});
onUnmounted(() => io?.disconnect());

// Color palette
type CT = { bg: string; text: string; border: string; glow: string; bg2: string };
const palette: Record<string, CT> = {
  blue:    { bg:'rgba(59,130,246,0.15)',  text:'#93c5fd', border:'rgba(59,130,246,0.4)',  glow:'rgba(59,130,246,0.25)',  bg2:'rgba(59,130,246,0.06)'  },
  sky:     { bg:'rgba(14,165,233,0.15)',  text:'#7dd3fc', border:'rgba(14,165,233,0.4)',  glow:'rgba(14,165,233,0.25)',  bg2:'rgba(14,165,233,0.06)'  },
  cyan:    { bg:'rgba(6,182,212,0.15)',   text:'#67e8f9', border:'rgba(6,182,212,0.4)',   glow:'rgba(6,182,212,0.25)',   bg2:'rgba(6,182,212,0.06)'   },
  orange:  { bg:'rgba(249,115,22,0.15)',  text:'#fdba74', border:'rgba(249,115,22,0.4)',  glow:'rgba(249,115,22,0.25)',  bg2:'rgba(249,115,22,0.06)'  },
  red:     { bg:'rgba(239,68,68,0.15)',   text:'#fca5a5', border:'rgba(239,68,68,0.4)',   glow:'rgba(239,68,68,0.25)',   bg2:'rgba(239,68,68,0.06)'   },
  teal:    { bg:'rgba(20,184,166,0.15)',  text:'#5eead4', border:'rgba(20,184,166,0.4)',  glow:'rgba(20,184,166,0.25)',  bg2:'rgba(20,184,166,0.06)'  },
  amber:   { bg:'rgba(245,158,11,0.15)',  text:'#fcd34d', border:'rgba(245,158,11,0.4)',  glow:'rgba(245,158,11,0.25)',  bg2:'rgba(245,158,11,0.06)'  },
  purple:  { bg:'rgba(168,85,247,0.15)',  text:'#d8b4fe', border:'rgba(168,85,247,0.4)',  glow:'rgba(168,85,247,0.25)',  bg2:'rgba(168,85,247,0.06)'  },
  indigo:  { bg:'rgba(99,102,241,0.15)',  text:'#a5b4fc', border:'rgba(99,102,241,0.4)',  glow:'rgba(99,102,241,0.25)',  bg2:'rgba(99,102,241,0.06)'  },
  green:   { bg:'rgba(34,197,94,0.15)',   text:'#86efac', border:'rgba(34,197,94,0.4)',   glow:'rgba(34,197,94,0.25)',   bg2:'rgba(34,197,94,0.06)'   },
  emerald: { bg:'rgba(16,185,129,0.15)',  text:'#6ee7b7', border:'rgba(16,185,129,0.4)',  glow:'rgba(16,185,129,0.25)',  bg2:'rgba(16,185,129,0.06)'  },
  slate:   { bg:'rgba(148,163,184,0.12)', text:'#cbd5e1', border:'rgba(148,163,184,0.35)',glow:'rgba(148,163,184,0.18)', bg2:'rgba(148,163,184,0.04)' },
};
const fallback: CT = { bg:'rgba(0,180,255,0.14)', text:'#7dd3fc', border:'rgba(0,180,255,0.35)', glow:'rgba(0,180,255,0.22)', bg2:'rgba(0,180,255,0.05)' };
const guideColors = (c: string): CT => palette[c] ?? fallback;
const catColors   = (c: string): CT => palette[c] ?? fallback;

// SEO — dynamic ItemList from props
const allGuides = computed(() => props.grouped.flatMap(g => g.guides));

useHead(computed(() => ({
  meta: [
    { property: 'og:title',       content: 'Teknik Rehberler | TürkTeknik İzmir' },
    { property: 'og:description', content: 'Modem kurulumu, uydu ayarı ve güvenlik kamerası sorunları için adım adım rehberler.' },
    { property: 'og:type',        content: 'website' },
    { property: 'og:url',         content: 'https://turkteknik.com.tr/rehberler' },
    { name:     'twitter:card',   content: 'summary_large_image' },
    { name:     'twitter:title',  content: 'Teknik Rehberler | TürkTeknik İzmir' },
    { name:     'robots',         content: 'index, follow' },
  ],
  script: [
    {
      type: 'application/ld+json',
      innerHTML: JSON.stringify({
        '@context': 'https://schema.org',
        '@type': 'BreadcrumbList',
        itemListElement: [
          { '@type': 'ListItem', position: 1, name: 'Ana Sayfa',        item: 'https://turkteknik.com.tr/' },
          { '@type': 'ListItem', position: 2, name: 'Teknik Rehberler', item: 'https://turkteknik.com.tr/rehberler' },
        ],
      }),
      key: 'breadcrumb-guides',
    },
    {
      type: 'application/ld+json',
      innerHTML: JSON.stringify({
        '@context': 'https://schema.org',
        '@type': 'ItemList',
        name: 'TürkTeknik Teknik Rehberler',
        description: 'İzmir teknik servis sorun çözüm rehberleri: modem, uydu sistemi ve güvenlik kamerası kurulumu.',
        numberOfItems: allGuides.value.length,
        itemListElement: allGuides.value.map((g, i) => ({
          '@type': 'ListItem',
          position: i + 1,
          name: g.title,
          url: `https://turkteknik.com.tr/rehberler/${g.slug}`,
        })),
      }),
      key: 'itemlist-guides',
    },
    {
      type: 'application/ld+json',
      innerHTML: JSON.stringify({
        '@context': 'https://schema.org',
        '@type': 'FAQPage',
        mainEntity: [
          {
            '@type': 'Question',
            name: 'İzmir\'de modem kurulumu nasıl yapılır?',
            acceptedAnswer: { '@type': 'Answer', text: 'ZTE, TP-Link ve Huawei modemlerin kurulumu için tarayıcıdan 192.168.1.1 adresine girerek yönetim paneline ulaşabilirsiniz. Ayrıntılı adımlar için rehberlerimizi inceleyebilirsiniz.' },
          },
          {
            '@type': 'Question',
            name: 'Çanak anten sinyali neden gelmiyor?',
            acceptedAnswer: { '@type': 'Answer', text: 'Sinyal problemi genellikle antenin yanlış yönlendirilmesi, DiSEqC switch arızası veya LNB bozulmasından kaynaklanır. Türksat için azimut 163°, elevasyon 41° hedeflenmelidir.' },
          },
          {
            '@type': 'Question',
            name: 'Güvenlik kameraları neden görüntü vermiyor?',
            acceptedAnswer: { '@type': 'Answer', text: 'Kamera görüntü problemi; güç kaynağı arızası, kablo bağlantı sorunu veya NVR/DVR kanal yapılandırma hatası nedeniyle olabilir. Cihazı yeniden başlatmak ilk adım olmalıdır.' },
          },
        ],
      }),
      key: 'faq-guides',
    },
  ],
})));
</script>

<style scoped>
/* ── Page ─────────────────────────────────────────── */
.guides-page { background: linear-gradient(180deg,#0e1a30 0%,#0b1525 40%,#0e1830 100%); }

/* ── Hero ─────────────────────────────────────────── */
.hero-card {
  background: linear-gradient(135deg,#1c3460 0%,#112040 55%,#1e1050 100%);
  border: 1px solid rgba(255,255,255,0.08);
  box-shadow: 0 8px 48px rgba(0,0,0,0.5), inset 0 1px 0 rgba(255,255,255,0.06);
}
.hero-badge { background:rgba(0,180,255,0.12); border:1px solid rgba(0,180,255,0.28); color:#7dd3fc; animation:slide-up .6s ease both .15s; }
.hero-title { animation:slide-up .7s ease both .3s; }
.hero-sub   { animation:slide-up .7s ease both .45s; }
.hero-chips { animation:slide-up .7s ease both .6s; }
.hero-svg-wrap { animation:slide-up .9s ease both .5s; }
.gradient-text { background:linear-gradient(90deg,#7dd3fc,#c4b5fd); -webkit-background-clip:text; -webkit-text-fill-color:transparent; }

/* ── Category chips ───────────────────────────────── */
.cat-chip { padding:6px 14px; border-radius:9999px; font-size:11px; font-weight:700; border:1px solid; transition:transform .2s; }
.cat-chip:hover { transform:translateY(-2px); }
.chip-blue   { background:rgba(59,130,246,0.15);  border-color:rgba(59,130,246,0.35);  color:#93c5fd; }
.chip-purple { background:rgba(168,85,247,0.15);  border-color:rgba(168,85,247,0.35);  color:#d8b4fe; }
.chip-green  { background:rgba(16,185,129,0.15);  border-color:rgba(16,185,129,0.35);  color:#6ee7b7; }

/* ── Category header icon ─────────────────────────── */
.cat-icon-wrap {
  width:36px; height:36px; border-radius:10px;
  display:flex; align-items:center; justify-content:center; flex-shrink:0;
  transition:transform .3s;
}
.mb-16:hover .cat-icon-wrap { transform:rotate(-6deg) scale(1.1); }

/* ── Guide cards ──────────────────────────────────── */
.guide-card {
  background: linear-gradient(160deg,#1a2e50 0%,#112038 100%);
  border: 1px solid rgba(255,255,255,0.07);
  box-shadow: 0 2px 16px rgba(0,0,0,0.35);
  transition: transform .28s ease, box-shadow .28s ease, border-color .28s ease;
}
.guide-card:hover { transform:translateY(-6px); border-color:rgba(255,255,255,0.13); box-shadow:0 14px 40px rgba(0,0,0,0.5); }

/* ── Card image header ────────────────────────────── */
.card-img {
  height: 112px;
  background: linear-gradient(135deg, var(--cbg), rgba(255,255,255,0.02));
  position: relative;
}
/* Dot-grid pattern via CSS */
.card-dots {
  background-image: radial-gradient(var(--dot) 1px, transparent 1px);
  background-size: 18px 18px;
  opacity: 0.12;
}

/* ── Card body ────────────────────────────────────── */
.card-body { background: linear-gradient(180deg,rgba(255,255,255,0.015) 0%,transparent 100%); }
.read-link { padding-top:8px; transition:gap .2s; }
.guide-card:hover .read-link { gap:10px; }

/* ── CTA ──────────────────────────────────────────── */
.cta-section { background:linear-gradient(135deg,#163060 0%,#0e1a34 50%,#1e0e40 100%); border:1px solid rgba(255,255,255,0.07); }
.cta-icon-wrap { background:rgba(0,180,255,0.14); border:1px solid rgba(0,180,255,0.3); transition:transform .3s; }
.cta-section:hover .cta-icon-wrap { transform:rotate(-8deg) scale(1.05); }
.cta-btn-outline { background:rgba(0,180,255,0.12); border:1px solid rgba(0,180,255,0.35); color:#7dd3fc; transition:all .2s; }
.cta-btn-outline:hover { background:rgba(0,180,255,0.22); transform:translateY(-2px); }
.cta-btn-fill { background:linear-gradient(135deg,#0ea5e9,#2563eb); box-shadow:0 4px 20px rgba(14,165,233,0.3); transition:all .2s; }
.cta-btn-fill:hover { filter:brightness(1.1); transform:translateY(-2px); }

/* ── WhatsApp ─────────────────────────────────────── */
.whatsapp-btn { background:#25d366; box-shadow:0 4px 20px rgba(37,211,102,0.4); transition:transform .2s,box-shadow .2s; }
.whatsapp-btn:hover { transform:scale(1.12); box-shadow:0 6px 28px rgba(37,211,102,0.55); }

/* ── Blobs ────────────────────────────────────────── */
.blob { position:absolute; border-radius:50%; pointer-events:none; filter:blur(80px); }
.blob-1 { width:300px; height:300px; top:-70px;  left:-50px;  background:rgba(0,180,255,0.22); animation:blob-float 7s ease-in-out infinite; }
.blob-2 { width:260px; height:260px; bottom:-60px; right:-40px; background:rgba(124,58,237,0.2);  animation:blob-float 9s ease-in-out infinite reverse; }
.blob-3 { width:160px; height:160px; top:40%; left:55%;       background:rgba(6,182,212,0.14);  animation:blob-float 11s ease-in-out infinite 2s; }
.cta-blob-1 { width:220px; height:220px; top:-50px;    left:25%;  background:#0ea5e9; opacity:.18; animation:blob-float 8s ease-in-out infinite; }
.cta-blob-2 { width:180px; height:180px; bottom:-40px; right:25%; background:#7c3aed; opacity:.14; animation:blob-float 10s ease-in-out infinite reverse; }
.grid-svg { opacity:.05; }

/* ── SVG illustration CSS animations ─────────────── */
.hub-pulse  { animation:hub-pulse 2.8s ease-in-out infinite; transform-origin:150px 125px; }
.ring-spin  { animation:ring-spin 22s linear infinite; transform-origin:150px 125px; }
.node-pulse { animation:node-pulse 3s ease-in-out infinite; }
.fdot-1 { animation:fdot 4s ease-in-out infinite; }
.fdot-2 { animation:fdot 5s ease-in-out infinite 1s; }
.fdot-3 { animation:fdot 4.5s ease-in-out infinite 0.5s; }
.fdot-4 { animation:fdot 5.5s ease-in-out infinite 1.5s; }
.fdot-5 { animation:fdot 4.2s ease-in-out infinite 0.3s; }

/* ── Scroll reveal ────────────────────────────────── */
[data-reveal] { opacity:0; transform:translateY(28px); transition:opacity .65s ease,transform .65s ease; transition-delay:var(--delay,0s); }
[data-reveal].is-visible { opacity:1; transform:translateY(0); }

/* ── Keyframes ────────────────────────────────────── */
@keyframes slide-up   { from{opacity:0;transform:translateY(22px)} to{opacity:1;transform:translateY(0)} }
@keyframes blob-float { 0%,100%{transform:translateY(0) scale(1)} 50%{transform:translateY(-18px) scale(1.04)} }
@keyframes hub-pulse  { 0%,100%{opacity:.1;transform:scale(1)} 50%{opacity:.22;transform:scale(1.1)} }
@keyframes ring-spin  { from{transform:rotate(0deg)} to{transform:rotate(360deg)} }
@keyframes node-pulse { 0%,100%{opacity:.9} 50%{opacity:.5} }
@keyframes fdot       { 0%,100%{transform:translateY(0);opacity:.45} 50%{transform:translateY(-10px);opacity:.9} }
</style>

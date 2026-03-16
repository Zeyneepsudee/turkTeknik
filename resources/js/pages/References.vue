<template>
  <div class="min-h-screen flex flex-col refs-page">
    <TopBar />

    <SEO
      title="Referanslarımız | İzmir Teknik Servis Müşteri Yorumları | TürkTeknik"
      description="TürkTeknik İzmir müşteri referansları ve yorumları. İnternet, kamera, uydu ve elektrik teknik servis alanında tamamlanan projeler ve memnun müşteri deneyimleri."
      url="https://turkteknik.com.tr/referanslar"
      keywords="türkteknik referanslar, izmir teknik servis müşteri yorumları, güvenlik kamerası kurulum referans izmir, uydu teknik servis yorum"
    />

    <div class="max-w-6xl mx-auto w-full flex-grow px-4 pt-28 pb-20">

      <!-- ─── HERO ─────────────────────────────────── -->
      <div class="hero-card relative rounded-[2.5rem] overflow-hidden mb-16">
        <div class="blob blob-1"></div>
        <div class="blob blob-2"></div>
        <div class="blob blob-3"></div>
        <svg class="absolute inset-0 w-full h-full grid-svg" xmlns="http://www.w3.org/2000/svg">
          <defs>
            <pattern id="rg" x="0" y="0" width="44" height="44" patternUnits="userSpaceOnUse">
              <path d="M 44 0 L 0 0 0 44" fill="none" stroke="white" stroke-width="0.6"/>
            </pattern>
          </defs>
          <rect width="100%" height="100%" fill="url(#rg)"/>
        </svg>

        <div class="relative z-10 text-center py-16 px-6 md:px-16">
          <div class="hero-badge inline-flex items-center gap-2 px-4 py-2 rounded-full mb-7 text-xs font-bold uppercase tracking-widest">
            <i class="fas fa-star text-[10px]"></i> Müşteri Referansları
          </div>
          <h1 class="hero-title text-4xl md:text-5xl font-extrabold text-white mb-5 leading-tight">
            Müşterilerimiz
            <span class="gradient-text"> Hakkımızda</span>
          </h1>
          <p class="hero-sub text-base md:text-lg max-w-2xl mx-auto leading-relaxed mb-10 text-slate-300">
            İzmir'in farklı ilçelerinden yüzlerce memnun müşteri. Gerçek deneyimler, gerçek çözümler.
          </p>

          <!-- Stat tiles -->
          <div class="hero-stats grid grid-cols-2 md:grid-cols-4 gap-4 max-w-2xl mx-auto">
            <div
              v-for="stat in stats" :key="stat.label"
              class="stat-tile rounded-2xl py-5 px-3 text-center"
              :style="{ '--accent': stat.color, '--border': stat.borderColor }"
            >
              <div
                class="stat-number text-2xl font-black mb-1"
                :style="{ color: stat.color }"
                :data-target="stat.numericValue"
                :data-suffix="stat.suffix"
              >{{ stat.value }}</div>
              <div class="text-xs text-slate-400">{{ stat.label }}</div>
            </div>
          </div>
        </div>
      </div>

      <!-- ─── TESTIMONIALS ──────────────────────────── -->
      <div class="mb-16">
        <div class="section-header text-center mb-10" data-reveal>
          <h2 class="text-2xl font-bold text-white mb-2">Müşteri Yorumları</h2>
          <p class="text-sm text-slate-400">Gerçek müşteri deneyimlerinden seçmeler</p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
          <div
            v-for="(review, i) in reviews"
            :key="i"
            class="review-card relative flex flex-col rounded-2xl overflow-hidden"
            data-reveal
            :style="`--delay:${i * 0.1}s; --accent:${review.accentColor}`"
          >
            <!-- Top accent line -->
            <div class="card-accent absolute top-0 left-0 right-0 h-[2px]"
                 :style="{ background: `linear-gradient(to right, ${review.accentColor}, transparent)` }"></div>

            <div class="p-6 flex flex-col gap-3 flex-1">
              <!-- Big quote -->
              <div class="big-quote" :style="{ color: review.accentColor }">"</div>
              <!-- Stars -->
              <div class="flex gap-1">
                <i v-for="s in 5" :key="s" class="fas fa-star text-xs text-amber-400"></i>
              </div>
              <!-- Text -->
              <p class="text-sm leading-relaxed flex-1 text-slate-300">{{ review.text }}</p>
              <!-- Author -->
              <div class="flex items-center gap-3 pt-4 review-footer">
                <div
                  class="avatar w-10 h-10 rounded-full flex items-center justify-center font-bold text-xs flex-shrink-0"
                  :style="{ background: review.accentColor + '1a', border: `1.5px solid ${review.accentColor}55`, color: review.accentColor }"
                >{{ review.initials }}</div>
                <div>
                  <p class="font-bold text-white text-sm">{{ review.name }}</p>
                  <p class="text-xs text-slate-500">{{ review.district }} · {{ review.service }}</p>
                </div>
                <div class="ml-auto opacity-60 hover:opacity-100 transition-opacity">
                  <i class="fas fa-check-circle text-sm" style="color:#22d3ee"></i>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>

      <!-- ─── PROJECT CATEGORIES ────────────────────── -->
      <div class="mb-16">
        <div class="section-header text-center mb-10" data-reveal>
          <h2 class="text-2xl font-bold text-white mb-2">Tamamlanan Projeler</h2>
          <p class="text-sm text-slate-400">Hizmet alanlarımızdaki deneyim ve uzmanlık</p>
        </div>

        <div class="grid grid-cols-2 lg:grid-cols-4 gap-5">
          <div
            v-for="(cat, i) in projectCategories"
            :key="cat.title"
            class="proj-card rounded-2xl p-6 text-center"
            data-reveal
            :style="`--delay:${i * 0.1}s; --accent:${cat.color}`"
          >
            <div class="proj-icon-wrap w-14 h-14 rounded-2xl flex items-center justify-center mx-auto mb-4"
                 :style="{ background: cat.color + '18', border: `1.5px solid ${cat.color}30` }">
              <i :class="cat.icon" class="text-2xl" :style="{ color: cat.color }"></i>
            </div>
            <h3 class="font-bold text-white text-sm mb-2">{{ cat.title }}</h3>
            <p class="text-3xl font-black mb-1" :style="{ color: cat.color }">{{ cat.count }}+</p>
            <p class="text-xs text-slate-500">tamamlanan proje</p>
          </div>
        </div>
      </div>

      <!-- ─── PARTNER BRANDS ────────────────────────── -->
      <div class="mb-16">
        <div class="section-header text-center mb-8" data-reveal>
          <h2 class="text-xl font-bold text-white mb-2">Çalıştığımız Markalar</h2>
          <p class="text-sm text-slate-400">Sektörün güvenilir markaları ile çalışıyoruz</p>
        </div>
        <div class="brands-wrap flex flex-wrap gap-3 justify-center" data-reveal style="--delay:0.1s">
          <span
            v-for="brand in brands"
            :key="brand"
            class="brand-tag px-5 py-2.5 rounded-xl text-sm font-semibold"
          >{{ brand }}</span>
        </div>
      </div>

      <!-- ─── BOTTOM CTA ─────────────────────────────── -->
      <div class="cta-section relative rounded-[2.5rem] overflow-hidden text-center py-14 px-8" data-reveal>
        <div class="blob cta-blob-1"></div>
        <div class="blob cta-blob-2"></div>
        <div class="relative z-10">
          <div class="cta-icon-wrap inline-flex items-center justify-center w-14 h-14 rounded-2xl mb-5">
            <i class="fas fa-handshake text-xl text-amber-300"></i>
          </div>
          <h2 class="text-2xl md:text-3xl font-bold text-white mb-3">Siz de Memnun Müşterilerimiz Arasına Katılın</h2>
          <p class="mb-8 max-w-xl mx-auto text-base text-slate-300">
            İzmir genelinde hızlı, kaliteli ve garantili teknik servis için bizi arayın.
          </p>
          <div class="flex flex-wrap gap-4 justify-center">
            <a href="tel:+905469118061" class="cta-btn-outline flex items-center gap-3 px-7 py-3.5 rounded-2xl font-bold text-sm transition-all">
              <i class="fas fa-phone"></i> 0546 911 80 61
            </a>
            <Link :href="route('service-requests.create')" class="cta-btn-fill flex items-center gap-3 px-7 py-3.5 rounded-2xl font-bold text-sm text-white transition-all">
              <i class="fas fa-clipboard-list"></i> Servis Talebi Oluştur
            </Link>
          </div>
        </div>
      </div>

    </div>

    <!-- WhatsApp -->
    <a href="https://wa.me/905469118061" target="_blank" class="whatsapp-btn fixed bottom-8 right-8 w-14 h-14 rounded-full flex items-center justify-center z-50">
      <i class="fab fa-whatsapp text-3xl text-white"></i>
    </a>
  </div>
</template>

<script setup lang="ts">
import { onMounted, onUnmounted } from 'vue';
import { Link } from '@inertiajs/vue3';
import { useHead } from '@vueuse/head';
import SEO from '@/components/SEO.vue';
import TopBar from '@/components/TopBar.vue';

// ─── Scroll reveal + counter ─────────────────────
let io: IntersectionObserver | null = null;

const animateCount = (el: HTMLElement) => {
  const raw     = el.dataset.target ?? '';
  const suffix  = el.dataset.suffix ?? '';
  const target  = parseFloat(raw);
  if (!target || isNaN(target)) return;
  const duration = 1400;
  const start    = performance.now();
  const step = (now: number) => {
    const p = Math.min((now - start) / duration, 1);
    const eased = 1 - Math.pow(1 - p, 3);
    const cur = target < 10
      ? (eased * target).toFixed(1)
      : Math.round(eased * target).toString();
    el.textContent = cur + suffix;
    if (p < 1) requestAnimationFrame(step);
  };
  requestAnimationFrame(step);
};

onMounted(() => {
  io = new IntersectionObserver((entries) => {
    entries.forEach(e => {
      if (!e.isIntersecting) return;
      const el = e.target as HTMLElement;
      el.classList.add('is-visible');
      // Trigger count-up for stat numbers inside this element
      el.querySelectorAll<HTMLElement>('[data-target]').forEach(animateCount);
      io?.unobserve(el);
    });
  }, { threshold: 0.12, rootMargin: '0px 0px -40px 0px' });

  document.querySelectorAll('[data-reveal]').forEach(el => io!.observe(el));

  // Also observe the hero stats tile wrapper
  const statsGrid = document.querySelector('.hero-stats');
  if (statsGrid) io.observe(statsGrid);
});
onUnmounted(() => io?.disconnect());

// ─── Data ─────────────────────────────────────────
useHead({
  script: [
    {
      type: 'application/ld+json',
      innerHTML: JSON.stringify({
        '@context': 'https://schema.org', '@type': 'BreadcrumbList',
        itemListElement: [
          { '@type': 'ListItem', position: 1, name: 'Ana Sayfa', item: 'https://turkteknik.com.tr/' },
          { '@type': 'ListItem', position: 2, name: 'Referanslar', item: 'https://turkteknik.com.tr/referanslar' },
        ],
      }),
      key: 'breadcrumb-references',
    },
    {
      type: 'application/ld+json',
      innerHTML: JSON.stringify({
        '@context': 'https://schema.org', '@type': 'LocalBusiness', name: 'TürkTeknik',
        aggregateRating: { '@type': 'AggregateRating', ratingValue: '4.9', reviewCount: '180', bestRating: '5' },
      }),
      key: 'aggregate-rating',
    },
  ],
});

const stats = [
  { value: '500+', numericValue: '500', suffix: '+', label: 'Tamamlanan Proje', color: '#7dd3fc', borderColor: 'rgba(0,180,255,0.22)' },
  { value: '4.9/5', numericValue: '4.9', suffix: '/5', label: 'Ortalama Puan',   color: '#fcd34d', borderColor: 'rgba(245,158,11,0.22)' },
  { value: '12+',  numericValue: '12',  suffix: '+', label: 'İzmir İlçesi',     color: '#6ee7b7', borderColor: 'rgba(16,185,129,0.22)' },
  { value: '7/24', numericValue: '',    suffix: '',  label: 'Hizmet Saatleri',  color: '#d8b4fe', borderColor: 'rgba(168,85,247,0.22)' },
];

const reviews = [
  { text: 'Sabah aradım, öğleden önce geldiler. Çanak antenimi tamir ettiler, fiyat makuldü ve garantili iş çıkardılar. Kesinlikle tavsiye ederim.', name: 'Mehmet Yılmaz', district: 'Konak',     service: 'Uydu Tamiri',         initials: 'MY', accentColor: '#93c5fd' },
  { text: 'Apartmanımıza 8 kameralı güvenlik sistemi kurulumu yaptırdık. Hem işçilik hem de ekipman kalitesi çok iyiydi. Kameralar telefondan gayet net görünüyor.', name: 'Ayşe Kaya',     district: 'Bornova',   service: 'Güvenlik Kamerası',   initials: 'AK', accentColor: '#a5b4fc' },
  { text: 'İnternet bağlantısı sürekli kesiliyor, farklı servisleri denedim olmadı. TürkTeknik hattaki eski kabloyu tespit edip değiştirdi, artık hiç kopmadan çalışıyor.', name: 'Hasan Demir',   district: 'Karabağlar', service: 'İnternet Hat Tamiri', initials: 'HD', accentColor: '#6ee7b7' },
  { text: 'Ev taşıdım, TP-Link Deco Mesh sistemi kurmalarını istedim. Profesyonelce yapıldı, evin her köşesinde tam sinyal alıyorum.', name: 'Zeynep Arslan', district: 'Bayraklı',  service: 'Mesh Wi-Fi Kurulumu', initials: 'ZA', accentColor: '#d8b4fe' },
  { text: 'Sigorta panom arızalandı, acil müdahale gerekiyordu. Akşam saatinde geldiler, sağ olsunlar. Hem panoyu değiştirdiler hem de eski kablolama sorununu düzelttiler.', name: 'Osman Çelik',   district: 'Buca',      service: 'Elektrik Panosu',     initials: 'OÇ', accentColor: '#fcd34d' },
  { text: 'Uzun yıllardan beri kullandığım santral sistemi yenilendi. DiSEqC switch ve LNB değişimi sonrası tüm kanallar kristal net gelmeye başladı.', name: 'Fatma Şahin',  district: 'Karşıyaka', service: 'Merkezi Uydu Sistemi', initials: 'FŞ', accentColor: '#5eead4' },
];

const projectCategories = [
  { title: 'Güvenlik Kamerası', count: 200, icon: 'fas fa-video',          color: '#a5b4fc' },
  { title: 'Uydu & Anten',      count: 150, icon: 'fas fa-satellite-dish', color: '#d8b4fe' },
  { title: 'İnternet Teknik',   count: 180, icon: 'fas fa-wifi',           color: '#7dd3fc' },
  { title: 'Elektrik Tesisatı', count: 80,  icon: 'fas fa-bolt',           color: '#fcd34d' },
];

const brands = ['Hikvision', 'Dahua', 'TP-Link', 'Huawei', 'ZTE', 'D-Link', 'Türksat', 'Hotbird', 'Legrand', 'Schneider', 'Netgear', 'Ubiquiti'];
</script>

<style scoped>
/* ── Page ────────────────────────────────────────── */
.refs-page { background: linear-gradient(180deg, #0e1a30 0%, #0b1525 40%, #0e1830 100%); }

/* ── Hero card ────────────────────────────────────── */
.hero-card {
  background: linear-gradient(135deg, #1c3460 0%, #112040 55%, #20104c 100%);
  border: 1px solid rgba(255,255,255,0.08);
  box-shadow: 0 8px 48px rgba(0,0,0,0.5), inset 0 1px 0 rgba(255,255,255,0.06);
}

/* ── Blobs ────────────────────────────────────────── */
.blob { position: absolute; border-radius: 50%; pointer-events: none; filter: blur(80px); }
.blob-1 { width:300px; height:300px; top:-70px;  left:-50px;  background:rgba(0,180,255,0.22); animation: blob-float 7s ease-in-out infinite; }
.blob-2 { width:260px; height:260px; bottom:-60px; right:-40px; background:rgba(124,58,237,0.20); animation: blob-float 9s ease-in-out infinite reverse; }
.blob-3 { width:160px; height:160px; top:40%; right:30%;       background:rgba(245,158,11,0.14); animation: blob-float 11s ease-in-out infinite 1.5s; }
.cta-blob-1 { width:220px; height:220px; top:-50px;    left:25%;  background:#0ea5e9; opacity:0.18; animation: blob-float 8s ease-in-out infinite; }
.cta-blob-2 { width:180px; height:180px; bottom:-40px; right:25%; background:#7c3aed; opacity:0.14; animation: blob-float 10s ease-in-out infinite reverse; }

/* ── Grid ─────────────────────────────────────────── */
.grid-svg { opacity: 0.05; }

/* ── Hero text animations ─────────────────────────── */
.hero-badge { background:rgba(245,158,11,0.14); border:1px solid rgba(245,158,11,0.3); color:#fcd34d; animation: slide-up 0.6s ease both 0.15s; }
.hero-title { animation: slide-up 0.7s ease both 0.3s; }
.hero-sub   { animation: slide-up 0.7s ease both 0.45s; }
.hero-stats { animation: slide-up 0.7s ease both 0.6s; }

.gradient-text {
  background: linear-gradient(90deg, #7dd3fc, #d8b4fe);
  -webkit-background-clip: text; -webkit-text-fill-color: transparent;
}

/* ── Stat tiles ───────────────────────────────────── */
.stat-tile {
  background: rgba(255,255,255,0.05);
  border: 1px solid var(--border);
  transition: transform 0.25s, box-shadow 0.25s;
}
.stat-tile:hover {
  transform: translateY(-4px);
  box-shadow: 0 8px 24px rgba(0,0,0,0.3), 0 0 20px var(--accent, rgba(0,180,255,0.15));
}
.stat-number { transition: transform 0.2s; }
.stat-tile:hover .stat-number { transform: scale(1.06); }

/* ── Review cards ─────────────────────────────────── */
.review-card {
  background: linear-gradient(160deg, #1a2e50 0%, #112038 100%);
  border: 1px solid rgba(255,255,255,0.07);
  box-shadow: 0 2px 16px rgba(0,0,0,0.35);
  transition: transform 0.28s ease, box-shadow 0.28s ease;
}
.review-card:hover {
  transform: translateY(-5px);
  box-shadow: 0 12px 32px rgba(0,0,0,0.45), 0 0 24px var(--accent, rgba(0,180,255,0.1));
}
.review-footer { border-top: 1px solid rgba(255,255,255,0.06); }
.big-quote {
  font-size: 3.5rem; font-weight: 900; line-height: 1;
  opacity: 0.2; margin-bottom: -8px;
  transition: opacity 0.3s;
}
.review-card:hover .big-quote { opacity: 0.35; }
.card-accent { transition: opacity 0.3s; opacity: 0.65; }
.review-card:hover .card-accent { opacity: 1; }

/* ── Project cards ────────────────────────────────── */
.proj-card {
  background: linear-gradient(160deg, #1a2e50 0%, #112038 100%);
  border: 1px solid rgba(255,255,255,0.07);
  box-shadow: 0 2px 16px rgba(0,0,0,0.3);
  transition: transform 0.28s ease, box-shadow 0.28s ease;
}
.proj-card:hover {
  transform: translateY(-5px) scale(1.02);
  box-shadow: 0 10px 28px rgba(0,0,0,0.4), 0 0 20px var(--accent, rgba(0,180,255,0.1));
}
.proj-icon-wrap { transition: transform 0.3s ease; }
.proj-card:hover .proj-icon-wrap { transform: scale(1.12) rotate(-5deg); }

/* ── Brand tags ───────────────────────────────────── */
.brand-tag {
  background: rgba(255,255,255,0.05);
  border: 1px solid rgba(255,255,255,0.09);
  color: #94a3b8;
  transition: background 0.2s, border-color 0.2s, color 0.2s, transform 0.2s;
}
.brand-tag:hover {
  background: rgba(125,211,252,0.1);
  border-color: rgba(125,211,252,0.35);
  color: #7dd3fc;
  transform: translateY(-2px);
}

/* ── CTA ──────────────────────────────────────────── */
.cta-section {
  background: linear-gradient(135deg, #163060 0%, #0e1a34 50%, #1e1040 100%);
  border: 1px solid rgba(255,255,255,0.07);
}
.cta-icon-wrap { background: rgba(245,158,11,0.14); border: 1px solid rgba(245,158,11,0.3); transition: transform 0.3s; }
.cta-section:hover .cta-icon-wrap { transform: rotate(-8deg) scale(1.05); }
.cta-btn-outline { background:rgba(0,180,255,0.12); border:1px solid rgba(0,180,255,0.35); color:#7dd3fc; }
.cta-btn-outline:hover { background:rgba(0,180,255,0.22); transform:translateY(-2px); }
.cta-btn-fill { background:linear-gradient(135deg,#0ea5e9,#2563eb); box-shadow:0 4px 20px rgba(14,165,233,0.3); }
.cta-btn-fill:hover { filter:brightness(1.1); transform:translateY(-2px); }

/* ── WhatsApp ─────────────────────────────────────── */
.whatsapp-btn { background:#25d366; box-shadow:0 4px 20px rgba(37,211,102,0.4); transition:transform 0.2s, box-shadow 0.2s; }
.whatsapp-btn:hover { transform:scale(1.12); box-shadow:0 6px 28px rgba(37,211,102,0.55); }

/* ── Scroll reveal ────────────────────────────────── */
[data-reveal] {
  opacity: 0; transform: translateY(28px);
  transition: opacity 0.65s ease, transform 0.65s ease;
  transition-delay: var(--delay, 0s);
}
[data-reveal].is-visible { opacity: 1; transform: translateY(0); }

/* ── Keyframes ────────────────────────────────────── */
@keyframes slide-up {
  from { opacity: 0; transform: translateY(22px); }
  to   { opacity: 1; transform: translateY(0);    }
}
@keyframes blob-float {
  0%, 100% { transform: translateY(0) scale(1);       }
  50%       { transform: translateY(-18px) scale(1.04); }
}
</style>

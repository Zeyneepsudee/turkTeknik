<script setup lang="ts">
import { Head, Link } from '@inertiajs/vue3'
import AppLayout from '@/layouts/AppLayout.vue'
import SEO from '@/components/SEO.vue'

defineOptions({ layout: AppLayout })

const stats = [
  { value: '500+', label: 'Tamamlanan Proje' },
  { value: '8+', label: 'Yıllık Deneyim' },
  { value: '%100', label: 'Müşteri Garantisi' },
  { value: '7/24', label: 'Teknik Destek' },
]

const services = [
  { icon: '📡', label: 'İnternet & Fiber' },
  { icon: '📺', label: 'Uydu Sistemleri' },
  { icon: '📷', label: 'Güvenlik Kamera' },
  { icon: '⚡', label: 'Elektrik Servis' },
]
</script>

<template>
  <SEO
    title="Hakkımızda | TürkTeknik İzmir Teknik Servis"
    description="TürkTeknik, 2016'dan bu yana İzmir'de internet, uydu, güvenlik kamerası ve elektrik alanlarında profesyonel teknik servis sunan güvenilir firmanızdır. 500+ tamamlanan proje."
    url="https://turkteknik.com.tr/hakkimizda"
    keywords="türkteknik hakkında, izmir teknik servis firması, türkteknik izmir, profesyonel teknik servis izmir, güvenilir teknik servis"
  />

  <div class="about pt-20">

    <!-- INTRO -->
    <section class="intro">
      <div class="container">
        <p class="eyebrow">Hakkımızda</p>
        <h1 class="intro__title">İzmir'in Teknik<br>Servis Çözümü</h1>
        <p class="intro__text">
          TürkTeknik olarak 2016'dan bu yana İzmir genelinde internet, uydu,
          güvenlik kamerası ve elektrik alanlarında profesyonel teknik servis sunuyoruz.
          Müşteri memnuniyeti ve işçilik kalitesi her zaman önceliğimizdir.
        </p>
      </div>
    </section>

    <!-- STATS -->
    <section class="stats">
      <div class="container">
        <div class="stats__row">
          <div v-for="(s, i) in stats" :key="i" class="stats__item">
            <span class="stats__value">{{ s.value }}</span>
            <span class="stats__label">{{ s.label }}</span>
          </div>
        </div>
      </div>
    </section>

    <!-- SERVICES TAGS -->
    <section class="tags-section">
      <div class="container">
        <p class="tags-section__label">Hizmet Alanlarımız</p>
        <div class="tags-section__row">
          <div v-for="(s, i) in services" :key="i" class="tag">
            <span>{{ s.icon }}</span> {{ s.label }}
          </div>
        </div>
      </div>
    </section>

    <!-- WHY -->
    <section class="why">
      <div class="container">
        <div class="why__grid">
          <div class="why__left">
            <p class="eyebrow">Neden TürkTeknik?</p>
            <h2 class="why__title">Güvenilir, Hızlı<br>et Garantili</h2>
          </div>
          <div class="why__right">
            <div class="why__item">
              <div class="why__dot"></div>
              <div>
                <strong>Sertifikalı Teknisyenler</strong>
                <p>Alanında eğitimli ve deneyimli ekibimiz her işi standartlara uygun tamamlar.</p>
              </div>
            </div>
            <div class="why__item">
              <div class="why__dot"></div>
              <div>
                <strong>Aynı Gün Servis</strong>
                <p>Çağrınıza en kısa sürede yanıt veriyor, yerinde müdahale ediyoruz.</p>
              </div>
            </div>
            <div class="why__item">
              <div class="why__dot"></div>
              <div>
                <strong>%100 Memnuniyet Garantisi</strong>
                <p>Parça ve işçilikte tam memnuniyet taahhüdüyle hizmet sunuyoruz.</p>
              </div>
            </div>
            <div class="why__item">
              <div class="why__dot"></div>
              <div>
                <strong>Şeffaf Fiyatlandırma</strong>
                <p>Gizli ücret yoktur. Fiyat teklifi önceden verilir, sürpriz olmaz.</p>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>

    <!-- CTA -->
    <section class="cta">
      <div class="container">
        <div class="cta__box">
          <div>
            <h3 class="cta__title">Teknik Destek Alın</h3>
            <p class="cta__sub">İzmir genelinde 7/24 hizmetinizdeyiz.</p>
          </div>
          <div class="cta__btns">
            <a href="tel:+905469118061" class="btn btn--primary">📞 +90 546 911 80 61</a>
            <Link :href="route('service-request')" class="btn btn--ghost">Servis Talebi</Link>
          </div>
        </div>
      </div>
    </section>

  </div>
</template>

<style scoped>
.about {
  background: #060e1c;
  color: #dde8f8;
  font-family: 'DM Sans', 'Segoe UI', sans-serif;
  min-height: 100vh;
}

.container {
  max-width: 1080px;
  margin: 0 auto;
  padding: 0 28px;
}

.eyebrow {
  font-size: 11px;
  font-weight: 700;
  letter-spacing: 0.16em;
  text-transform: uppercase;
  color: #38a3ff;
  margin: 0 0 16px;
}

/* INTRO */
.intro {
  padding: 100px 0 60px;
  border-bottom: 1px solid rgba(56, 163, 255, 0.1);
}
.intro__title {
  font-size: clamp(36px, 5vw, 56px);
  font-weight: 800;
  line-height: 1.1;
  margin: 0 0 24px;
  color: #f0f6ff;
}
.intro__text {
  font-size: 16px;
  line-height: 1.85;
  color: #7a9cc8;
  max-width: 540px;
  margin: 0;
}

/* STATS */
.stats {
  padding: 56px 0;
  border-bottom: 1px solid rgba(56, 163, 255, 0.1);
}
.stats__row {
  display: grid;
  grid-template-columns: repeat(4, 1fr);
}
.stats__item {
  display: flex;
  flex-direction: column;
  gap: 6px;
  padding-left: 32px;
  border-left: 1px solid rgba(56, 163, 255, 0.15);
}
.stats__item:first-child {
  border-left: none;
  padding-left: 0;
}
.stats__value {
  font-size: 40px;
  font-weight: 900;
  color: #38a3ff;
  line-height: 1;
}
.stats__label {
  font-size: 12px;
  color: #4a6685;
  text-transform: uppercase;
  letter-spacing: 0.08em;
  font-weight: 600;
}

/* TAGS */
.tags-section {
  padding: 48px 0;
  border-bottom: 1px solid rgba(56, 163, 255, 0.1);
}
.tags-section__label {
  font-size: 11px;
  font-weight: 700;
  letter-spacing: 0.14em;
  text-transform: uppercase;
  color: #4a6685;
  margin: 0 0 18px;
}
.tags-section__row {
  display: flex;
  gap: 10px;
  flex-wrap: wrap;
}
.tag {
  display: inline-flex;
  align-items: center;
  gap: 8px;
  background: rgba(56, 163, 255, 0.06);
  border: 1px solid rgba(56, 163, 255, 0.18);
  border-radius: 8px;
  padding: 10px 18px;
  font-size: 14px;
  color: #a8c8f0;
  font-weight: 500;
  transition: border-color 0.2s, background 0.2s;
}
.tag:hover {
  border-color: rgba(56, 163, 255, 0.45);
  background: rgba(56, 163, 255, 0.1);
}

/* WHY */
.why {
  padding: 80px 0;
  border-bottom: 1px solid rgba(56, 163, 255, 0.1);
}
.why__grid {
  display: grid;
  grid-template-columns: 1fr 1.6fr;
  gap: 80px;
  align-items: start;
}
.why__title {
  font-size: clamp(26px, 3vw, 34px);
  font-weight: 800;
  line-height: 1.2;
  color: #f0f6ff;
  margin: 0;
}
.why__right {
  display: flex;
  flex-direction: column;
  gap: 28px;
}
.why__item {
  display: flex;
  gap: 18px;
  align-items: flex-start;
}
.why__dot {
  width: 7px;
  height: 7px;
  border-radius: 50%;
  background: #38a3ff;
  margin-top: 7px;
  flex-shrink: 0;
  box-shadow: 0 0 8px rgba(56, 163, 255, 0.5);
}
.why__item strong {
  display: block;
  font-size: 15px;
  color: #dde8f8;
  font-weight: 700;
  margin-bottom: 4px;
}
.why__item p {
  font-size: 14px;
  color: #5e7ea0;
  line-height: 1.7;
  margin: 0;
}

/* CTA */
.cta {
  padding: 64px 0;
}
.cta__box {
  display: flex;
  align-items: center;
  justify-content: space-between;
  gap: 32px;
  background: rgba(56, 163, 255, 0.05);
  border: 1px solid rgba(56, 163, 255, 0.18);
  border-radius: 14px;
  padding: 36px 44px;
}
.cta__title {
  font-size: 20px;
  font-weight: 800;
  color: #f0f6ff;
  margin: 0 0 5px;
}
.cta__sub {
  font-size: 13.5px;
  color: #4a6685;
  margin: 0;
}
.cta__btns {
  display: flex;
  gap: 12px;
  flex-shrink: 0;
}

/* BUTTONS */
.btn {
  display: inline-flex;
  align-items: center;
  gap: 8px;
  padding: 11px 22px;
  border-radius: 8px;
  font-size: 14px;
  font-weight: 600;
  text-decoration: none;
  transition: all 0.2s ease;
  white-space: nowrap;
}
.btn--primary {
  background: #38a3ff;
  color: #060e1c;
}
.btn--primary:hover {
  background: #5bbfff;
  box-shadow: 0 0 18px rgba(56, 163, 255, 0.3);
}
.btn--ghost {
  background: transparent;
  color: #dde8f8;
  border: 1px solid rgba(56, 163, 255, 0.25);
}
.btn--ghost:hover {
  border-color: #38a3ff;
  background: rgba(56, 163, 255, 0.07);
}

/* RESPONSIVE */
@media (max-width: 768px) {
  .stats__row {
    grid-template-columns: repeat(2, 1fr);
    gap: 28px;
  }
  .stats__item {
    border-left: none;
    padding-left: 0;
    border-top: 1px solid rgba(56, 163, 255, 0.12);
    padding-top: 20px;
  }
  .stats__item:nth-child(1),
  .stats__item:nth-child(2) {
    border-top: none;
    padding-top: 0;
  }
  .why__grid {
    grid-template-columns: 1fr;
    gap: 36px;
  }
  .cta__box {
    flex-direction: column;
    align-items: flex-start;
    padding: 28px 24px;
  }
}
</style>

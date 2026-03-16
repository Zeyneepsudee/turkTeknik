<template>
  <div class="min-h-screen bg-gray-50 dark:bg-gray-900">
    <SEO
      :title="service.name + ' | TürkTeknik'"
      :description="service.description"
      :keywords="service.keywords"
      :url="'https://turkteknik.com.tr/teknik-servis/' + service.slug"
    />

    <div class="max-w-7xl mx-auto py-12 px-4 sm:px-6 lg:px-8">
      <div class="bg-white dark:bg-gray-800 shadow rounded-lg overflow-hidden">
        <div class="px-4 py-5 sm:p-6">
          <div class="flex items-center">
            <div class="flex-shrink-0 bg-blue-500 rounded-md p-3">
              <p><i class="fas fa-envelope mr-2"></i> destek@turkteknik.com.tr</p>
            </div>
            <div class="ml-5 w-0 flex-1">
              <h1 class="text-2xl font-bold text-gray-900 dark:text-white">
                {{ service.name }}
              </h1>
            </div>
          </div>

          <div class="mt-6 prose dark:prose-invert max-w-none">
            <p class="text-gray-500 dark:text-gray-300">
              {{ service.description }}
            </p>
          </div>

          <div class="mt-8">
            <h2 class="text-xl font-semibold text-gray-900 dark:text-white mb-4">
              Hizmet Detayları
            </h2>
            <div class="grid grid-cols-1 gap-6 sm:grid-cols-2">
              <div v-for="(detail, index) in service.details" :key="index" class="bg-gray-50 dark:bg-gray-700 p-4 rounded-lg">
                <h3 class="text-lg font-medium text-gray-900 dark:text-white">
                  {{ detail.title }}
                </h3>
                <p class="mt-2 text-gray-500 dark:text-gray-300">
                  {{ detail.description }}
                </p>
              </div>
            </div>
          </div>

          <div class="mt-8">
            <h2 class="text-xl font-semibold text-gray-900 dark:text-white mb-4">
              Sık Sorulan Sorular
            </h2>
            <div class="space-y-4">
              <div v-for="(faq, index) in service.faqs" :key="index" class="bg-gray-50 dark:bg-gray-700 p-4 rounded-lg">
                <h3 class="text-lg font-medium text-gray-900 dark:text-white">
                  {{ faq.question }}
                </h3>
                <p class="mt-2 text-gray-500 dark:text-gray-300">
                  {{ faq.answer }}
                </p>
              </div>
            </div>
          </div>

          <div class="mt-8 flex flex-col sm:flex-row sm:justify-center gap-4">
            <Link :href="route('service-requests.create', service.slug)" class="inline-flex items-center justify-center px-6 py-3 border border-transparent text-base font-medium rounded-md shadow-sm text-white bg-blue-600 hover:bg-blue-700">
              Hizmet Talep Et
            </Link>
            <Link :href="route('services.index')" class="inline-flex items-center justify-center px-6 py-3 border border-transparent text-base font-medium rounded-md text-blue-600 bg-blue-100 hover:bg-blue-200">
              Tüm Hizmetler
            </Link>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script setup>
import { Link } from '@inertiajs/vue3';
import SEO from '@/components/SEO.vue';
const props = defineProps({
  service: {
    type: Object,
    required: true
  }
});

const serviceDetails = {
  'kamera-kurulumu': {
    title: 'Kamera Kurulumu',
    description: 'Güvenlik kamera sistemleri kurulumu ve bakım hizmetleri',
    features: [
      'IP ve analog kamera kurulumu',
      'DVR/NVR sistem kurulumu',
      'Uzaktan izleme sistemi kurulumu',
      'Gece görüş kamera sistemleri',
      'Akıllı hareket algılama sistemleri'
    ],
    faqs: [
      {
        question: 'Kamera sistemleri ne kadar sürede kurulur?',
        answer: 'Kurulum süresi sistemin büyüklüğüne göre değişmektedir. Genellikle 1-3 saat arasında tamamlanmaktadır.'
      },
      {
        question: 'Kamera sistemlerinin bakımı ne sıklıkla yapılmalıdır?',
        answer: 'Yılda en az bir kez bakım yapılması önerilmektedir.'
      }
    ]
  },
  'ariza-hizmeti': {
    title: 'Arıza Hizmeti',
    description: 'Tüm elektronik cihazlar için arıza tespit ve onarım hizmetleri',
    features: [
      'Elektronik cihaz arıza tespiti',
      'Yerinde onarım hizmeti',
      'Yedek parça temini',
      'Garanti kapsamında onarım',
      'Teknik destek hizmeti'
    ],
    faqs: [
      {
        question: 'Arıza tespiti ücretli midir?',
        answer: 'Evet, arıza tespiti ücretlidir. Ancak onarım yapılması durumunda tespit ücreti onarım ücretinden düşülmektedir.'
      },
      {
        question: 'Garanti kapsamındaki cihazlar için onarım süresi ne kadardır?',
        answer: 'Garanti kapsamındaki cihazlar için onarım süresi genellikle 3-5 iş günüdür.'
      }
    ]
  },
  'internet-dsl-operasyonlari': {
    title: 'İnternet DSL Operasyonları',
    description: 'İnternet bağlantısı kurulumu ve sorun giderme hizmetleri',
    features: [
      'DSL bağlantı kurulumu',
      'Ağ altyapısı kurulumu',
      'Wi-Fi sistem kurulumu',
      'Hız optimizasyonu',
      'Sorun giderme ve destek'
    ],
    faqs: [
      {
        question: 'İnternet bağlantısı ne kadar sürede kurulur?',
        answer: 'Kurulum genellikle 1-2 saat içinde tamamlanmaktadır.'
      },
      {
        question: 'Wi-Fi sinyal gücünü nasıl artırabilirim?',
        answer: 'Wi-Fi sinyal gücünü artırmak için repeater kullanımı veya mesh sistem kurulumu önerilmektedir.'
      }
    ]
  },
  'canak-anten-ariza': {
    title: 'Çanak Anten Arıza',
    description: 'Uydu anten sistemleri arıza tespit ve onarım hizmetleri',
    features: [
      'Anten arıza tespiti',
      'LNB değişimi',
      'Kablo değişimi',
      'Anten ayarlama',
      'Sinyal güçlendirme'
    ],
    faqs: [
      {
        question: 'Anten arızası nasıl tespit edilir?',
        answer: 'Arıza tespiti için özel cihazlar kullanılarak sinyal ölçümü yapılmaktadır.'
      },
      {
        question: 'Anten bakımı ne sıklıkla yapılmalıdır?',
        answer: 'Yılda en az bir kez anten bakımı yapılması önerilmektedir.'
      }
    ]
  },
  'uydu-ayarlama': {
    title: 'Uydu Ayarlama',
    description: 'Uydu anten kurulumu ve kanal ayarlama hizmetleri',
    features: [
      'Uydu anten kurulumu',
      'Kanal ayarlama',
      'Çoklu uydu kurulumu',
      'HD kanal ayarları',
      'Uydu alıcı kurulumu'
    ],
    faqs: [
      {
        question: 'Uydu anteni hangi yöne bakmalıdır?',
        answer: 'Türkiye\'de genellikle güney yönüne bakmalıdır, ancak konuma göre değişiklik gösterebilir.'
      },
      {
        question: 'Kanal ayarları ne kadar sürede yapılır?',
        answer: 'Kanal ayarları genellikle 30-60 dakika içinde tamamlanmaktadır.'
      }
    ]
  }
};
</script> 
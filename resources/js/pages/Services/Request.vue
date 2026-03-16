<template>
  <div class="min-h-screen bg-gray-50 dark:bg-gray-900 pt-16">
    <TopBar />
    <SEO
      :title="service.name + ' Hizmet Talebi | TürkTeknik'"
      :description="service.name + ' için hemen online teknik servis talebi oluşturun.'"
      :keywords="service.keywords"
      :url="'https://turkteknik.com.tr/hizmet-talebi/' + service.slug"
    />

    <!-- Request Form Header -->
    <div class="bg-orange-600 text-white py-12">
      <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <h1 class="text-3xl font-bold">{{ service.name }} Hizmet Talebi</h1>
        <p class="mt-2">Hızlı ve güvenilir teknik servis çözümleri için formu doldurun</p>
      </div>
    </div>

    <!-- Request Form -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
      <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
        <!-- Form -->
        <div class="md:col-span-2">
          <div class="bg-white rounded-lg shadow-lg p-6">
            <form @submit.prevent="submit">
              <div class="space-y-4">
                <div>
                  <label class="block text-sm font-medium text-gray-700">Ad Soyad</label>
                  <input 
                    type="text" 
                    v-model="form.name"
                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-orange-500 focus:ring-orange-500"
                    :class="{ 'border-red-500': errors.name }"
                  >
                  <p v-if="errors.name" class="mt-1 text-sm text-red-600">{{ errors.name }}</p>
                </div>
                <div>
                  <label class="block text-sm font-medium text-gray-700">Email</label>
                  <input 
                    type="email" 
                    v-model="form.email"
                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-orange-500 focus:ring-orange-500"
                    :class="{ 'border-red-500': errors.email }"
                  >
                  <p v-if="errors.email" class="mt-1 text-sm text-red-600">{{ errors.email }}</p>
                </div>
                <div>
                  <label class="block text-sm font-medium text-gray-700">Telefon</label>
                  <input 
                    type="tel" 
                    v-model="form.phone"
                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-orange-500 focus:ring-orange-500"
                    :class="{ 'border-red-500': errors.phone }"
                  >
                  <p v-if="errors.phone" class="mt-1 text-sm text-red-600">{{ errors.phone }}</p>
                </div>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                  <div>
                    <label class="block text-sm font-medium text-gray-700">Adres</label>
                    <input 
                      type="text" 
                      v-model="form.address"
                      class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-orange-500 focus:ring-orange-500"
                      :class="{ 'border-red-500': errors.address }"
                      placeholder="Sokak, Bina No, Daire"
                    >
                    <p v-if="errors.address" class="mt-1 text-sm text-red-600">{{ errors.address }}</p>
                  </div>
                  <div>
                    <label class="block text-sm font-medium text-gray-700">İlçe</label>
                    <input 
                      type="text" 
                      v-model="form.district"
                      class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-orange-500 focus:ring-orange-500"
                      :class="{ 'border-red-500': errors.district }"
                      placeholder="Örn: Karşıyaka"
                    >
                    <p v-if="errors.district" class="mt-1 text-sm text-red-600">{{ errors.district }}</p>
                  </div>
                </div>
                <div>
                  <label class="block text-sm font-medium text-gray-700">Açıklama</label>
                  <textarea 
                    v-model="form.description"
                    rows="4"
                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-orange-500 focus:ring-orange-500"
                    :class="{ 'border-red-500': errors.description }"
                  ></textarea>
                  <p v-if="errors.description" class="mt-1 text-sm text-red-600">{{ errors.description }}</p>
                </div>
                <div>
                  <button 
                    type="submit"
                    class="w-full bg-orange-600 text-white px-4 py-2 rounded-lg hover:bg-orange-700 transition"
                    :disabled="form.processing"
                  >
                    <span v-if="form.processing">Gönderiliyor...</span>
                    <span v-else>Hizmet Talep Et</span>
                  </button>
                </div>
              </div>
            </form>
          </div>
        </div>

        <!-- Contact Info -->
        <div class="space-y-6">
          <div class="bg-white rounded-lg shadow-lg p-6">
            <h3 class="text-xl font-semibold mb-4">İletişim</h3>
            <div class="space-y-2 text-gray-600">
              <p><i class="fas fa-phone mr-2"></i> +90 546 911 80 61</p>
              <p><i class="fas fa-envelope mr-2"></i> destek@turkteknik.com.tr</p>
              <p><i class="fas fa-map-marker-alt mr-2"></i> İzmir, Türkiye</p>
              <a 
                href="https://wa.me/905469118061?text=Merhaba, {{ service.name }} hizmeti hakkında bilgi almak istiyorum."
                target="_blank"
                class="flex items-center text-green-600 hover:text-green-700 mt-4"
              >
                <i class="fab fa-whatsapp mr-2 text-xl"></i>
                WhatsApp ile İletişime Geçin
              </a>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script setup>
import { Link, useForm } from '@inertiajs/vue3';
import SEO from '@/components/SEO.vue';
import { ref } from 'vue';
import TopBar from '@/components/TopBar.vue';

const props = defineProps({
  service: {
    type: Object,
    required: true
  }
});

const service_type_map = {
  'İnternet Teknik Servis': 'internet',
  'İnternet Hizmetleri': 'internet',
  'Elektrik Teknik Servis': 'elektrik',
  'Elektrik Servisi': 'elektrik',
  'Uydu & Merkezi Sistemler': 'satellite',
  'Uydu Sistemleri': 'satellite',
  'Güvenlik & Kamera': 'camera',
  'Kamera Sistemleri': 'camera'
};

const form = useForm({
  name: '',
  email: '',
  phone: '',
  address: '',
  district: '', // Added district
  description: '',
  service_id: props.service.id,
  service_key: service_type_map[props.service.name] || 'internet'
});

const errors = ref({});

const validateForm = () => {
  errors.value = {};
  
  if (!form.name) errors.value.name = 'Ad Soyad alanı zorunludur';
  if (!form.email) errors.value.email = 'Email alanı zorunludur';
  else if (!/^\S+@\S+\.\S+$/.test(form.email)) errors.value.email = 'Geçerli bir email adresi giriniz';
  
  if (!form.phone) errors.value.phone = 'Telefon alanı zorunludur';
  else if (!/^[0-9]{10,11}$/.test(form.phone.replace(/\D/g, ''))) errors.value.phone = 'Geçerli bir telefon numarası giriniz';
  
  if (!form.address) errors.value.address = 'Adres alanı zorunludur';
  if (!form.description) errors.value.description = 'Açıklama alanı zorunludur';
  
  return Object.keys(errors.value).length === 0;
};

const submit = () => {
  if (!validateForm()) return;
  
  form.post(route('service-requests.store'), {
    onSuccess: () => {
      form.reset();
      // Logic for success is handled by the redirect in the controller
      // which will go to either 'home' or 'show' with a flash message.
    },
    onError: (errs) => {
      errors.value = errs;
    }
  });
};
</script> 
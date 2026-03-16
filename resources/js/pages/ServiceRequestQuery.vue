<template>
  <div class="container mx-auto px-4 py-8">
    <h1 class="text-2xl font-bold mb-6">Hizmet Talebi Sorgulama</h1>
    
    <form @submit.prevent="queryServiceRequest" class="mb-6">
      <div class="flex items-center">
        <input 
          type="text" 
          v-model="requestNumber"
          placeholder="Talep Numarasını Girin"
          class="flex-grow mr-4 rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:text-white dark:placeholder-gray-400"
          required
        >
        <button 
          type="submit"
          class="px-4 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700 transition-colors duration-200"
        >
          Sorgula
        </button>
      </div>
    </form>

    <!-- Sonuçlar burada gösterilecek -->
    <div v-if="serviceRequest">
      <div class="bg-white rounded-lg shadow-xl p-6 dark:bg-gray-800">
        <h2 class="text-xl font-semibold mb-4">Talep Detayları</h2>
        <p><strong>Talep Numarası:</strong> {{ serviceRequest.request_number }}</p>
        <p><strong>Durum:</strong> {{ serviceRequest.status_text }}</p>
        <p><strong>Hizmet Tipi:</strong> {{ serviceRequest.service_type }}</p>
        <p><strong>Seçenek:</strong> {{ serviceRequest.service_option }}</p>
        <p><strong>Oluşturulma Tarihi:</strong> {{ new Date(serviceRequest.created_at).toLocaleDateString('tr-TR') }}</p>
        <p><strong>Açıklama:</strong> {{ serviceRequest.description }}</p>
        <!-- Daha fazla detay eklenebilir -->
      </div>
    </div>

    <div v-else-if="searched && !serviceRequest">
      <p class="text-red-600 dark:text-red-400">Belirtilen talep numarasına ait bir kayıt bulunamadı.</p>
    </div>
  </div>
</template>

<script setup>
import { ref } from 'vue';
import { router } from '@inertiajs/vue3';

const requestNumber = ref('');
const serviceRequest = ref(null);
const searched = ref(false);

const queryServiceRequest = () => {
  searched.value = false;
  serviceRequest.value = null;

  if (requestNumber.value) {
    // Backend rotasına sorgu gönderilecek
    router.get(route('service-request.query', { request_number: requestNumber.value }), {
      onSuccess: (page) => {
        serviceRequest.value = page.props.serviceRequest;
        searched.value = true;
      },
      onError: (errors) => {
        console.error('Sorgu hatası:', errors);
        serviceRequest.value = null; // Hata durumunda önceki sonucu temizle
        searched.value = true; // Hata olsa bile arama yapıldı say
      },
    });
  }
};
</script>

<style scoped>
/* Bu sayfaya özel stiller buraya eklenebilir */
</style> 
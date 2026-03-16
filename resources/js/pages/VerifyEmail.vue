<template>
  <div class="container mx-auto px-4 py-8 text-center">
    <h1 class="text-2xl font-bold mb-6">E-posta Doğrulama</h1>
    <p class="text-gray-700 dark:text-gray-300">E-postanızı doğrulamak için gelen kutunuzu kontrol edin.</p>
    
    <div v-if="status === 'verification-link-sent'" class="mt-4 text-sm font-medium text-green-600 dark:text-green-400">
      Yeni bir doğrulama bağlantısı e-posta adresinize gönderildi.
    </div>
  </div>
</template>

<script setup>
import { defineProps } from 'vue';

defineProps({
    status: String,
});
</script>

<style scoped>
/* Bu sayfaya özel stiller buraya eklenebilir */
</style> 
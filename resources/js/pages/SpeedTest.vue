<template>
  <div class="min-h-[300px] flex flex-col items-center justify-center py-10 px-4">
    <div class="max-w-md w-full bg-white dark:bg-gray-800 rounded-xl shadow p-8 flex flex-col items-center relative overflow-hidden">
      <h2 class="text-2xl font-bold text-gray-900 dark:text-white mb-2">İnternet Hız Testi</h2>
      <p class="text-gray-500 dark:text-gray-300 mb-6 text-center">Gerçek zamanlı olarak indirme hızınızı ölçün.</p>

      <!-- Gösterge -->
      <div class="relative w-64 h-64 mb-6">
        <svg viewBox="0 0 100 100" class="w-full h-full transform rotate-[225deg]">
          <!-- Boş daire -->
          <circle cx="50" cy="50" r="45" fill="none" stroke-width="10" class="stroke-gray-300 dark:stroke-gray-700" stroke-linecap="round" />
          <!-- Dolu kısım -->
          <circle
            cx="50"
            cy="50"
            r="45"
            fill="none"
            stroke-width="10"
            stroke-linecap="round"
            stroke="url(#speedGradient)"
            :stroke-dasharray="gaugeArcLength + ' 999'"
            :stroke-dashoffset="gaugeArcLength * (1 - Math.min(speed, maxSpeed) / maxSpeed)"
            style="transition: stroke-dashoffset 0.4s ease-in-out;"
          />
          <defs>
            <linearGradient id="speedGradient" x1="0%" y1="0%" x2="100%" y2="0%">
              <stop offset="0%" style="stop-color:#3B82F6" />
              <stop offset="100%" style="stop-color:#10B981" />
            </linearGradient>
          </defs>
        </svg>
        <!-- Merkez Hız -->
        <div class="absolute inset-0 flex flex-col items-center justify-center">
          <div class="text-3xl font-bold text-blue-600 dark:text-blue-400">
            {{ loading ? speed.toFixed(1) : (result !== null ? result : 'N/A') }}
          </div>
          <div class="text-sm text-gray-500 dark:text-gray-400 mt-1">
            {{ loading ? 'Mbps' : (result !== null ? 'Mbps' : 'Hazır') }}
          </div>
        </div>
      </div>

      <!-- Başlat Butonu -->
      <button
        @click="startTest"
        :disabled="loading"
        class="px-8 py-3 rounded-xl bg-blue-600 text-white font-semibold shadow hover:bg-blue-700 transition-all duration-300 disabled:opacity-60 disabled:cursor-not-allowed w-full"
      >
        {{ loading ? 'Test Yapılıyor...' : 'Hız Testini Başlat' }}
      </button>

      <!-- Test Bilgisi -->
      <div class="text-center text-sm text-gray-500 dark:text-gray-400 mt-4">
        50MB dosya ile ölçülmüştür
      </div>

      <!-- Hata -->
      <div v-if="error" class="text-red-600 dark:text-red-400 mt-4 text-center text-sm">
        {{ error }}
      </div>
    </div>
  </div>
</template>

<script setup>
import { ref } from 'vue';

const speed = ref(0);
const result = ref(null);
const loading = ref(false);
const error = ref('');
const maxSpeed = 1000;
const gaugeArcLength = 212.05;

const TEST_FILE_URL = 'https://speed.cloudflare.com/__down?bytes=50000000'; // Changed to 50MB

async function startTest() {
  result.value = null;
  error.value = '';
  loading.value = true;
  speed.value = 0;

  let received = 0;
  const startTime = performance.now();

  try {
    const response = await fetch(TEST_FILE_URL, { method: 'GET', cache: 'no-store' });
    const reader = response.body.getReader();

    const updateInterval = setInterval(() => {
      const elapsed = (performance.now() - startTime) / 1000;
      if (elapsed > 0 && received > 0) {
        speed.value = (received * 8 / elapsed) / (1024 * 1024); // Mbps
      }
    }, 150);

    while (true) {
      const { done, value } = await reader.read();
      if (done) break;
      received += value.length;
    }

    clearInterval(updateInterval);

    const endTime = performance.now();
    const totalTime = (endTime - startTime) / 1000;
    const bitsDownloaded = received * 8;
    result.value = ((bitsDownloaded / totalTime) / (1024 * 1024)).toFixed(2);

  } catch (e) {
    error.value = 'Test sırasında bir hata oluştu.';
    console.error(e);
  } finally {
    loading.value = false;
  }
}
</script>

<style scoped>
circle {
  transition: stroke-dashoffset 0.3s ease-in-out;
}
</style>
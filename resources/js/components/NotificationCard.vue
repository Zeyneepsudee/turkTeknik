<template>
  <div v-if="notification" class="fixed top-4 right-4 z-50 w-full max-w-sm rounded-lg shadow-lg overflow-hidden pointer-events-auto ring-1 ring-black ring-opacity-5 bg-white dark:bg-gray-800">
    <div class="p-4">
      <div class="flex items-start">
        <div class="flex-shrink-0">
          <svg class="h-6 w-6 text-green-400" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
          </svg>
        </div>
        <div class="ml-3 w-0 flex-1 pt-0.5">
          <p class="text-sm font-medium text-gray-900 dark:text-white">{{ notification.title }}</p>
          <p class="mt-1 text-sm text-gray-500 dark:text-gray-400">{{ notification.message }}</p>
          <div v-if="notification.request_number" class="mt-2 text-sm text-gray-500 dark:text-gray-400">
            <p><strong>Talep No:</strong> {{ notification.request_number }}</p>
            <p><strong>Hizmet Tipi:</strong> {{ notification.service_type }}</p>
            <p><strong>Seçenek:</strong> {{ notification.service_option }}</p>
          </div>
          <div class="mt-3 flex space-x-7">
            <Link
              v-if="notification.request_id"
              :href="route('service-requests.show', notification.request_id)"
              class="bg-white dark:bg-gray-800 rounded-md text-sm font-medium text-blue-600 hover:text-blue-500 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 dark:text-blue-400 dark:hover:text-blue-300"
              @click="dismissNotification"
            >
              Servis talebimi görüntüle
            </Link>
            <button
              type="button"
              class="bg-white dark:bg-gray-800 rounded-md text-sm font-medium text-gray-700 hover:text-gray-500 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 dark:text-gray-400 dark:hover:text-gray-300"
              @click="dismissNotification"
            >
              Kapat
            </button>
          </div>
        </div>
        <div class="ml-4 flex-shrink-0 flex">
          <button
            type="button"
            class="bg-white dark:bg-gray-800 rounded-md inline-flex text-gray-400 hover:text-gray-500 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 dark:text-gray-500 dark:hover:text-gray-400"
            @click="dismissNotification"
          >
            <span class="sr-only">Close</span>
            <svg class="h-5 w-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
              <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd" />
            </svg>
          </button>
        </div>
      </div>
    </div>
  </div>
</template>

<script setup lang="ts">
import { ref, watch } from 'vue';
import { usePage, Link } from '@inertiajs/vue3';

const page = usePage();
const notification = ref(null);
let timeoutId = null;

watch(() => page.props.flash?.success, (newVal) => {
  if (newVal) {
    if (timeoutId) clearTimeout(timeoutId);
    
    notification.value = newVal;
    
    // Mesajı 5 saniye sonra gizle
    timeoutId = setTimeout(() => {
      notification.value = null;
    }, 5000);
  }
}, { immediate: true });

const dismissNotification = () => {
  if (timeoutId) clearTimeout(timeoutId);
  notification.value = null;
};
</script> 
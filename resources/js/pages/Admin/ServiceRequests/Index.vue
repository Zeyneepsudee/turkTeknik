<template>
  <div class="container mx-auto py-10">
    <div class="w-full flex justify-center mt-8 mb-8">
      <AdminNavButtons />
    </div>
    <h1 class="text-3xl font-bold mb-6 text-blue-700 dark:text-blue-400">Servis Talepleri</h1>
    <div class="overflow-x-auto rounded-lg shadow bg-white dark:bg-gray-800">
      <table class="min-w-full">
        <thead>
          <tr class="bg-blue-50 dark:bg-blue-900">
            <th class="py-3 px-4 text-left text-blue-700 dark:text-blue-400 font-semibold">ID</th>
            <th class="py-3 px-4 text-left text-blue-700 dark:text-blue-400 font-semibold">Kullanıcı</th>
            <th class="py-3 px-4 text-left text-blue-700 dark:text-blue-400 font-semibold">Talep Tarihi</th>
            <th class="py-3 px-4 text-left text-blue-700 dark:text-blue-400 font-semibold">Durum</th>
            <th class="py-3 px-4 text-left text-blue-700 dark:text-blue-400 font-semibold">Açıklama</th>
          </tr>
        </thead>
        <tbody>
          <tr v-for="serviceRequest in serviceRequests" :key="serviceRequest.id" class="border-b hover:bg-blue-50 dark:hover:bg-blue-900 transition-colors">
            <td class="py-2 px-4 text-gray-900 dark:text-white">{{ serviceRequest.id }}</td>
            <td class="py-2 px-4 text-gray-900 dark:text-white">{{ serviceRequest.user?.name || '-' }}</td>
            <td class="py-2 px-4 text-gray-900 dark:text-white">{{ new Date(serviceRequest.created_at).toLocaleString('tr-TR') }}</td>
            <td class="py-2 px-4 text-gray-900 dark:text-white">{{ serviceRequest.status }}</td>
            <td class="py-2 px-4 text-gray-900 dark:text-white">{{ serviceRequest.description }}</td>
          </tr>
        </tbody>
      </table>
    </div>
  </div>
</template>

<script setup>
const props = defineProps({
  serviceRequests: Array
});
import AdminNavButtons from '@/components/AdminNavButtons.vue';
</script> 
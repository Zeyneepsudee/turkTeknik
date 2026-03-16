<template>
  <div class="container mx-auto py-10">
    <div class="w-full flex justify-center mt-8 mb-8">
      <AdminNavButtons />
    </div>
    <h1 class="text-3xl font-bold mb-6 text-blue-700 dark:text-blue-400">Kullanıcılar</h1>
    <div class="overflow-x-auto rounded-lg shadow bg-white dark:bg-gray-800">
      <table class="min-w-full">
        <thead>
          <tr class="bg-blue-50 dark:bg-blue-900">
            <th class="py-3 px-4 text-left text-blue-700 dark:text-blue-400 font-semibold">ID</th>
            <th class="py-3 px-4 text-left text-blue-700 dark:text-blue-400 font-semibold">Ad</th>
            <th class="py-3 px-4 text-left text-blue-700 dark:text-blue-400 font-semibold">E-posta</th>
            <th class="py-3 px-4 text-left text-blue-700 dark:text-blue-400 font-semibold">Admin mi?</th>
            <th class="py-3 px-4 text-left text-blue-700 dark:text-blue-400 font-semibold">Kayıt Tarihi</th>
          </tr>
        </thead>
        <tbody>
          <tr v-for="user in users" :key="user.id" class="border-b hover:bg-blue-50 dark:hover:bg-blue-900 transition-colors">
            <td class="py-2 px-4 text-gray-900 dark:text-white">{{ user.id }}</td>
            <td class="py-2 px-4 text-gray-900 dark:text-white">{{ user.name }}</td>
            <td class="py-2 px-4 text-gray-900 dark:text-white">{{ user.email }}</td>
            <td class="py-2 px-4 text-gray-900 dark:text-white">{{ user.is_admin ? 'Evet' : 'Hayır' }}</td>
            <td class="py-2 px-4 text-gray-900 dark:text-white">{{ new Date(user.created_at).toLocaleString('tr-TR') }}</td>
          </tr>
        </tbody>
      </table>
    </div>
  </div>
</template>

<script setup>
const props = defineProps({
  users: Array
});
import AdminNavButtons from '@/components/AdminNavButtons.vue';
</script> 
<template>
  <div class="min-h-screen bg-gray-100 flex flex-col">
    <div class="w-full flex justify-center mt-8 mb-8">
      <AdminNavButtons />
    </div>
    <div class="max-w-7xl w-full mx-auto px-4">
      <h1 class="text-3xl font-extrabold tracking-wide text-gray-900 mb-2">Admin Dashboard</h1>
      <p class="text-base text-gray-900 mb-8">Hoş geldiniz, güncel sistem verileri aşağıda listelenmiştir.</p>
      <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
        <!-- Total Users Card -->
        <div class="bg-white rounded-xl shadow-md hover:shadow-xl p-6 border border-gray-200 transition-all">
          <div class="text-sm font-medium text-gray-900">Toplam Kullanıcı</div>
          <div class="text-4xl font-bold mt-2 text-blue-600">{{ totalUsers }}</div>
        </div>
        <!-- Total Service Requests Card -->
        <div class="bg-white rounded-xl shadow-md hover:shadow-xl p-6 border border-gray-200 transition-all">
          <div class="text-sm font-medium text-gray-900">Toplam Servis Talebi</div>
          <div class="text-4xl font-bold mt-2 text-green-600">{{ totalServiceRequests }}</div>
        </div>
        <!-- Daily Requests Breakdown -->
        <div class="bg-white rounded-xl shadow-md hover:shadow-xl p-6 border border-gray-200 transition-all">
          <div class="text-sm font-medium text-gray-900 mb-2">Günlük Servis Talepleri</div>
          <ul class="space-y-1 text-gray-900 text-sm max-h-40 overflow-y-auto">
            <li v-for="day in serviceRequestsByDay" :key="day.day" class="flex justify-between">
              <span class="font-medium">{{ day.day }}</span>
              <span class="text-gray-900">{{ day.total }} talep</span>
            </li>
          </ul>
        </div>
      </div>
    </div>
  </div>
</template>

<script setup>
import AdminNavButtons from '@/components/AdminNavButtons.vue';
const props = defineProps({
  totalUsers: Number,
  totalServiceRequests: Number,
  serviceRequestsByDay: Array
});
</script>
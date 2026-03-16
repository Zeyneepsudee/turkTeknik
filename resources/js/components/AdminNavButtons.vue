<template>
  <div class="flex flex-row gap-4 mb-6">
    <Link :href="route('profile')" class="flex items-center gap-2 px-4 py-2 rounded-lg bg-blue-100 text-blue-700 font-medium hover:bg-blue-200 transition dark:bg-blue-900 dark:text-blue-300 dark:hover:bg-blue-800">Profil</Link>
    <Link :href="route('admin.dashboard')" class="flex items-center gap-2 px-4 py-2 rounded-lg bg-blue-100 text-blue-700 font-medium hover:bg-blue-200 transition dark:bg-blue-900 dark:text-blue-300 dark:hover:bg-blue-800">Admin Dashboard</Link>
    <Link :href="route('admin.products.index')" class="flex items-center gap-2 px-4 py-2 rounded-lg bg-blue-100 text-blue-700 font-medium hover:bg-blue-200 transition dark:bg-blue-900 dark:text-blue-300 dark:hover:bg-blue-800">Ürünler</Link>
    <Link :href="route('admin.service_requests.index')" class="flex items-center gap-2 px-4 py-2 rounded-lg bg-blue-100 text-blue-700 font-medium hover:bg-blue-200 transition dark:bg-blue-900 dark:text-blue-300 dark:hover:bg-blue-800">Servis Talepleri</Link>
    <Link :href="route('admin.users.index')" class="flex items-center gap-2 px-4 py-2 rounded-lg bg-blue-100 text-blue-700 font-medium hover:bg-blue-200 transition dark:bg-blue-900 dark:text-blue-300 dark:hover:bg-blue-800">Kullanıcılar</Link>
  </div>
</template>

<script setup>
import { Link } from '@inertiajs/vue3';
</script> 
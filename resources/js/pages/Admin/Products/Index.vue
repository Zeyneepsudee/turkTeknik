<template>
  <div class="container mx-auto py-10 flex flex-col min-h-screen">
    <div class="flex items-center justify-between w-full mb-8 mt-8">
      <AdminNavButtons />
      <Link :href="route('admin.products.create')" class="px-4 py-2 rounded-lg bg-blue-600 text-white font-semibold hover:bg-blue-700 transition dark:bg-blue-700 dark:hover:bg-blue-800 ml-4">+ Ürün Ekle</Link>
    </div>
    <h1 class="text-3xl font-bold mb-6 text-blue-700">Ürünler</h1>
    <div class="flex-1">
      <div class="overflow-x-auto rounded-lg shadow bg-white">
        <table class="min-w-full">
          <thead>
            <tr class="bg-blue-50">
              <th class="py-3 px-4 text-left text-blue-700 font-semibold">ID</th>
              <th class="py-3 px-4 text-left text-blue-700 font-semibold">İsim</th>
              <th class="py-3 px-4 text-left text-blue-700 font-semibold">Kategori</th>
              <th class="py-3 px-4 text-left text-blue-700 font-semibold">Açıklama</th>
              <th class="py-3 px-4 text-left text-blue-700 font-semibold">Fiyat</th>
              <th class="py-3 px-4 text-left text-blue-700 font-semibold">İşlemler</th>
            </tr>
          </thead>
          <tbody>
            <tr v-for="product in products" :key="product.id" class="border-b hover:bg-blue-50 transition-colors">
              <td class="py-2 px-4 text-gray-900">{{ product.id }}</td>
              <td class="py-2 px-4 text-gray-900">{{ product.name }}</td>
              <td class="py-2 px-4 text-gray-900">{{ product.category }}</td>
              <td class="py-2 px-4 text-gray-900">{{ product.description }}</td>
              <td class="py-2 px-4 text-gray-900">{{ product.price }}</td>
              <td class="py-2 px-4 text-gray-900">
                <div class="flex gap-2">
                  <Link :href="route('admin.products.edit', product.id)" class="px-3 py-1 bg-blue-600 text-white rounded hover:bg-blue-700">Düzenle</Link>
                  <button @click="deleteProduct(product.id)" class="px-3 py-1 bg-red-600 text-white rounded hover:bg-red-700">Sil</button>
                </div>
              </td>
            </tr>
          </tbody>
        </table>
      </div>
    </div>
    <footer class="w-full text-center text-xs text-gray-400 py-2 mt-8 border-t border-gray-200 bg-transparent">© {{ new Date().getFullYear() }} TürkTeknik</footer>
  </div>
</template>

<script setup>
import { Link, router } from '@inertiajs/vue3';
import AdminNavButtons from '@/components/AdminNavButtons.vue';

const props = defineProps({
  products: Array
});

function deleteProduct(id) {
  if (confirm('Bu ürünü silmek istediğinizden emin misiniz?')) {
    router.delete(route('admin.products.destroy', id), {
      onSuccess: () => {
        router.visit(route('profile'));
      }
    });
  }
}
</script> 
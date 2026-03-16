<template>
  <div class="container mx-auto py-10 max-w-2xl">
    <h1 class="text-2xl font-bold mb-6 text-blue-700 dark:text-blue-400">Yeni Ürün Ekle</h1>
    <form @submit.prevent="submitForm" enctype="multipart/form-data" class="space-y-6 bg-white dark:bg-gray-800 p-6 rounded-lg shadow">
      <div>
        <label class="block mb-1 font-medium text-gray-700 dark:text-gray-200">Ürün Fotoğrafı</label>
        <input type="file" @change="onFileChange" class="block w-full border rounded p-2" />
      </div>
      <div>
        <label class="block mb-1 font-medium text-gray-700 dark:text-gray-200">Kategori</label>
        <input v-model="form.category" type="text" class="block w-full border rounded p-2" required />
      </div>
      <div>
        <label class="block mb-1 font-medium text-gray-700 dark:text-gray-200">Ürün İsmi</label>
        <input v-model="form.name" type="text" class="block w-full border rounded p-2" required />
      </div>
      <div>
        <label class="block mb-1 font-medium text-gray-700 dark:text-gray-200">Açıklama</label>
        <textarea v-model="form.description" class="block w-full border rounded p-2" required></textarea>
      </div>
      <div class="flex gap-4">
        <div class="flex-1">
          <label class="block mb-1 font-medium text-gray-700 dark:text-gray-200">Fiyat (₺)</label>
          <input v-model="form.price" type="number" step="0.01" class="block w-full border rounded p-2" required />
        </div>
        <div class="flex-1">
          <label class="block mb-1 font-medium text-gray-700 dark:text-gray-200">Stok Adedi</label>
          <input v-model="form.stock" type="number" class="block w-full border rounded p-2" required />
        </div>
      </div>
      <div>
        <label class="block mb-2 font-medium text-gray-700 dark:text-gray-200">Ürün Özellikleri</label>
        <div class="space-y-2">
          <div v-for="(feature, idx) in form.features" :key="idx" class="flex gap-2 items-center">
            <input v-model="feature.name" type="text" placeholder="Özellik" class="flex-1 border rounded p-2" />
            <input v-model="feature.value" type="text" placeholder="Var/Yok veya Değer" class="flex-1 border rounded p-2" />
            <button type="button" @click="addFeatureRow" v-if="idx === form.features.length - 1" class="px-3 py-2 bg-blue-600 text-white rounded hover:bg-blue-700">Satır Ekle</button>
            <button type="button" @click="removeFeatureRow(idx)" v-if="form.features.length > 1" class="px-2 py-2 bg-red-500 text-white rounded hover:bg-red-600">Sil</button>
          </div>
        </div>
      </div>
      <button type="submit" class="w-full py-3 bg-blue-600 text-white font-semibold rounded hover:bg-blue-700">Kaydet</button>
    </form>
  </div>
</template>

<script setup>
import { ref } from 'vue';
import { router } from '@inertiajs/vue3';

const form = ref({
  photo: null,
  category: '',
  name: '',
  description: '',
  price: '',
  stock: '',
  features: [ { name: '', value: '' } ]
});

function onFileChange(e) {
  form.value.photo = e.target.files[0];
}

function addFeatureRow() {
  form.value.features.push({ name: '', value: '' });
}

function removeFeatureRow(idx) {
  form.value.features.splice(idx, 1);
}

function submitForm() {
  const data = new FormData();
  data.append('photo', form.value.photo);
  data.append('category', form.value.category);
  data.append('name', form.value.name);
  data.append('description', form.value.description);
  data.append('price', form.value.price);
  data.append('stock', form.value.stock);
  data.append('features', JSON.stringify(form.value.features));
  router.post(route('admin.products.store'), data);
}
</script> 
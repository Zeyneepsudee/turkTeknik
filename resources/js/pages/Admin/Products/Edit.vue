<template>
  <div class="container mx-auto py-10">
    <div class="w-full max-w-xl bg-white rounded-lg shadow p-8 mx-auto">
      <h1 class="text-2xl font-bold mb-6 text-gray-800">Ürünü Düzenle</h1>
      <form @submit.prevent="submit">
        <div class="mb-4">
          <label class="block mb-1 text-gray-700 font-medium">İsim</label>
          <input v-model="form.name" type="text" class="border rounded px-3 py-2 w-full text-gray-900" required />
        </div>
        <div class="mb-4">
          <label class="block mb-1 text-gray-700 font-medium">Kategori</label>
          <select v-model="form.category" class="border rounded px-3 py-2 w-full text-gray-900" required>
            <option value="kamera">Kamera</option>
            <option value="internet">İnternet</option>
            <option value="çanak anten">Çanak Anten</option>
          </select>
        </div>
        <div class="mb-4">
          <label class="block mb-1 text-gray-700 font-medium">Açıklama</label>
          <textarea v-model="form.description" class="border rounded px-3 py-2 w-full text-gray-900"></textarea>
        </div>
        <div class="mb-4">
          <label class="block mb-1 text-gray-700 font-medium">Fiyat</label>
          <input v-model="form.price" type="number" step="0.01" class="border rounded px-3 py-2 w-full text-gray-900" />
        </div>
        <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">Güncelle</button>
      </form>
    </div>
  </div>
</template>

<script setup>
import { useForm } from '@inertiajs/vue3';
const props = defineProps({ product: Object });

const form = useForm({
  name: props.product.name,
  category: props.product.category,
  description: props.product.description,
  price: props.product.price
});

function submit() {
  form.put(route('admin.products.update', props.product.id));
}
</script> 
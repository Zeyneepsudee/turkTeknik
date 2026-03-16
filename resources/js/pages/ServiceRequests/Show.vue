<template>
  <div class="min-h-screen bg-gray-50 dark:bg-gray-900 flex flex-col pt-24 pb-12 px-4 sm:px-6 lg:px-8">
    <TopBar />
    
    <div class="max-w-3xl mx-auto w-full">
      <!-- Page Header -->
      <div class="mb-10 flex items-center justify-between">
        <div>
          <h1 class="text-2xl font-semibold text-gray-900 dark:text-white tracking-tight">Talep Detayları</h1>
          <p class="text-gray-400 text-sm mt-1">İşlem takibinizi bu sayfa üzerinden yapabilirsiniz.</p>
        </div>
        
        <!-- Status Badge -->
        <span 
          :class="[
            'px-4 py-1.5 rounded-full text-xs font-bold uppercase tracking-widest',
            statusStyles[serviceRequest.status] || 'bg-gray-100 text-gray-600'
          ]"
        >
          {{ serviceRequest.status_text }}
        </span>
      </div>

      <!-- Details Card -->
      <div class="bg-white dark:bg-slate-800 rounded-2xl shadow-sm border border-gray-100 dark:border-slate-700/50 p-8 md:p-10 overflow-hidden relative">
        <!-- Accent Glow -->
        <div class="absolute top-0 right-0 w-32 h-32 bg-blue-500/5 blur-3xl rounded-full -mr-16 -mt-16"></div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-y-8 gap-x-12 relative z-10">
          <!-- Request Number -->
          <div class="space-y-1">
            <p class="text-[10px] font-bold text-gray-400 dark:text-gray-500 uppercase tracking-widest">Talep Numarası</p>
            <p class="text-sm font-semibold text-gray-900 dark:text-white">{{ serviceRequest.request_number }}</p>
          </div>

          <!-- Generation Date -->
          <div class="space-y-1">
            <p class="text-[10px] font-bold text-gray-400 dark:text-gray-500 uppercase tracking-widest">Oluşturulma Tarihi</p>
            <p class="text-sm font-semibold text-gray-900 dark:text-white">
              {{ new Date(serviceRequest.created_at).toLocaleDateString('tr-TR', { day: 'numeric', month: 'long', year: 'numeric' }) }}
            </p>
          </div>

          <!-- Service Type -->
          <div class="space-y-1">
            <p class="text-[10px] font-bold text-gray-400 dark:text-gray-500 uppercase tracking-widest">Hizmet Tipi</p>
            <p class="text-sm font-semibold text-gray-900 dark:text-white">{{ serviceRequest.service_type_text }}</p>
          </div>

          <!-- Option -->
          <div class="space-y-1">
            <p class="text-[10px] font-bold text-gray-400 dark:text-gray-500 uppercase tracking-widest">Hizmet Detayı</p>
            <p class="text-sm font-semibold text-gray-900 dark:text-white">{{ serviceRequest.service_option_text }}</p>
          </div>

          <!-- User Name -->
          <div v-if="serviceRequest.user || serviceRequest.name" class="space-y-1">
            <p class="text-[10px] font-bold text-gray-400 dark:text-gray-500 uppercase tracking-widest">Müşteri</p>
            <p class="text-sm font-semibold text-gray-900 dark:text-white">{{ serviceRequest.user?.name || serviceRequest.name }}</p>
          </div>

          <!-- Product -->
          <div v-if="serviceRequest.product || serviceRequest.other_product_name" class="space-y-1">
            <p class="text-[10px] font-bold text-gray-400 dark:text-gray-500 uppercase tracking-widest">İlgili Ürün</p>
            <p class="text-sm font-semibold text-gray-900 dark:text-white">
              {{ serviceRequest.product ? serviceRequest.product.name : serviceRequest.other_product_name }}
            </p>
          </div>
        </div>

        <!-- Description -->
        <div class="mt-10 pt-8 border-t border-gray-50 dark:border-slate-700/50 space-y-3">
          <p class="text-[10px] font-bold text-gray-400 dark:text-gray-500 uppercase tracking-widest">Arıza / Talep Açıklaması</p>
          <div class="bg-gray-50 dark:bg-slate-900/50 rounded-xl p-5 border border-gray-100 dark:border-slate-700/30">
            <p class="text-sm text-gray-600 dark:text-gray-300 leading-relaxed italic">
              "{{ serviceRequest.description }}"
            </p>
          </div>
        </div>

        <!-- Action Buttons -->
        <div class="mt-12 flex flex-col sm:flex-row items-center justify-between gap-4">
          <Link 
            :href="route('profile')"
            class="text-xs font-bold uppercase tracking-widest text-gray-400 hover:text-gray-900 dark:hover:text-white transition-colors"
          >
            ← Profilime Dön
          </Link>
          
          <button 
            v-if="serviceRequest.status === 'pending'"
            @click="cancelServiceRequest"
            class="w-full sm:w-auto px-6 py-2.5 rounded-xl text-xs font-bold uppercase tracking-widest border border-red-200 text-red-500 hover:bg-red-50 dark:border-red-900/30 dark:text-red-400 dark:hover:bg-red-900/20 transition-all active:scale-95"
          >
            Talebi İptal Et
          </button>
        </div>
      </div>
    </div>
  </div>
</template>

<script setup lang="ts">
import { Link, router } from '@inertiajs/vue3';
import TopBar from '@/components/TopBar.vue';

const props = defineProps({
  serviceRequest: {
    type: Object,
    required: true
  }
});

const statusStyles = {
  'pending': 'bg-amber-50 text-amber-600 border border-amber-100 dark:bg-amber-900/20 dark:text-amber-500 dark:border-amber-900/30',
  'in_progress': 'bg-blue-50 text-blue-600 border border-blue-100 dark:bg-blue-900/20 dark:text-blue-500 dark:border-blue-900/30',
  'completed': 'bg-emerald-50 text-emerald-600 border border-emerald-100 dark:bg-emerald-900/20 dark:text-emerald-500 dark:border-emerald-900/30',
  'cancelled': 'bg-red-50 text-red-600 border border-red-100 dark:bg-red-900/20 dark:text-red-500 dark:border-red-900/30'
};

const cancelServiceRequest = () => {
  if (confirm('Bu servis talebini iptal etmek istediğinize emin misiniz?')) {
    router.delete(route('service-requests.destroy', props.serviceRequest.id), {
      onSuccess: () => {},
      onError: (errors) => alert('Hata: ' + errors.message),
    });
  }
};
</script> 
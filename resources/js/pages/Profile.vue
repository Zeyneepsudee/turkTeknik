<template>
  <div class="min-h-screen bg-gray-50 dark:bg-gray-900 pt-16">
    <TopBar />
    <SEO
      title="Profilim | TürkTeknik"
      description="Kullanıcı profili ve servis talebi yönetimi."
      keywords="kullanıcı profili, servis talepleri, türk teknik profil"
      url="https://turkteknik.com.tr/profil"
    />

    <div class="container mx-auto px-4 sm:px-6 lg:px-8 py-8">
      <!-- Profile Card with Animation -->
      <div class="max-w-2xl mx-auto transform transition-all duration-500 ease-in-out opacity-0 translate-y-4" 
           v-motion-slide-bottom
           :initial="{ opacity: 0, y: 20 }"
           :enter="{ opacity: 1, y: 0 }">
        <div class="bg-white dark:bg-gray-800 rounded-xl shadow-xl overflow-hidden backdrop-blur-sm bg-opacity-90 dark:bg-opacity-90 border border-gray-100 dark:border-gray-700">
          <!-- Profile Header -->
          <div class="relative h-32 bg-gradient-to-r from-blue-500 to-blue-600">
            <div class="absolute -bottom-12 left-1/2 transform -translate-x-1/2">
              <div class="relative group">
                <div class="h-24 w-24 rounded-full border-4 border-white dark:border-gray-800 overflow-hidden transition-transform duration-300 group-hover:scale-105">
                  <img v-if="user.profile_picture" 
                       :src="user.profile_picture" 
                       alt="Profil Resmi"
                       class="h-full w-full object-cover">
                  <div v-else 
                       class="h-full w-full bg-gradient-to-r from-blue-500 to-blue-600 flex items-center justify-center text-white text-3xl font-bold">
                    {{ user.name.charAt(0) }}
                  </div>
                </div>
                <div class="absolute inset-0 rounded-full bg-blue-500 opacity-0 group-hover:opacity-20 transition-opacity duration-300"></div>
              </div>
            </div>
          </div>

          <!-- Profile Content -->
          <div class="pt-16 pb-8 px-6">
            <div class="text-center mb-6">
              <h2 class="text-2xl font-bold text-gray-900 dark:text-white">{{ user.name }}</h2>
              <p class="text-gray-600 dark:text-gray-400">{{ user.email }}</p>
              <p class="text-sm text-gray-500 dark:text-gray-400 mt-2">
                Üyelik: {{ new Date(user.created_at).toLocaleDateString('tr-TR', { year: 'numeric', month: 'long' }) }}
              </p>
              <div class="mt-2">
                <span v-if="user.email_verified_at" 
                      class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800 dark:bg-green-900 dark:text-green-200">
                  <svg class="w-3 h-3 mr-1" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/>
                  </svg>
                  Doğrulanmış E-posta
                </span>
                <span v-else 
                      class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-yellow-100 text-yellow-800 dark:bg-yellow-900 dark:text-yellow-200">
                  <svg class="w-3 h-3 mr-1" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M8.257 3.099c.765-1.36 2.722-1.36 3.486 0l5.58 9.92c.75 1.334-.213 2.98-1.742 2.98H4.42c-1.53 0-2.493-1.646-1.743-2.98l5.58-9.92zM11 13a1 1 0 11-2 0 1 1 0 012 0zm-1-8a1 1 0 00-1 1v3a1 1 0 002 0V6a1 1 0 00-1-1z" clip-rule="evenodd"/>
                  </svg>
                  E-posta Doğrulanmadı
                </span>
              </div>
              
              <!-- E-posta Doğrulama Butonu ve Mesajı -->
              <div v-if="!user.email_verified_at" class="mt-4">
                <p class="text-sm text-gray-600 dark:text-gray-400 mb-2">E-posta adresiniz henüz doğrulanmadı.</p>
                <Link
                  :href="route('verification.send')"
                  method="post"
                  as="button"
                  class="inline-flex items-center px-4 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700 transition-colors duration-200 text-sm"
                >
                  E-postayı Doğrula
                </Link>
                
                <div v-if="$page.props.session && $page.props.session.status === 'verification-link-sent'" class="mt-2 text-sm font-medium text-green-600 dark:text-green-400">
                  Yeni bir doğrulama bağlantısı e-posta adresinize gönderildi.
                </div>
              </div>

            </div>

            <!-- Edit Profile Button -->
            <div class="flex flex-col items-center mb-8 gap-4">
              <Link :href="route('profile.edit')"
                    class="inline-flex items-center px-4 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700 transition-colors duration-200">
                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z"/>
                </svg>
                Profili Düzenle
              </Link>

              <div v-if="user.is_admin" class="flex flex-wrap gap-2 justify-center mt-2">
                <Link :href="route('admin.dashboard')" class="inline-flex items-center px-4 py-2 bg-gray-800 text-white rounded hover:bg-gray-900 transition-colors">
                  <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M13 5v6h6m-6 0H7m6 0v6m0 0H7m6 0h6"/></svg>
                  Admin Dashboard
                </Link>
                <Link :href="route('admin.products.index')" class="inline-flex items-center px-4 py-2 bg-gray-800 text-white rounded hover:bg-gray-900 transition-colors">
                  <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 13V7a2 2 0 00-2-2H6a2 2 0 00-2 2v6m16 0v6a2 2 0 01-2 2H6a2 2 0 01-2-2v-6m16 0H4"/></svg>
                  Ürünler
                </Link>
                <Link :href="route('admin.service_requests.index')" class="inline-flex items-center px-4 py-2 bg-gray-800 text-white rounded hover:bg-gray-900 transition-colors">
                  <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 17v-2a2 2 0 012-2h2a2 2 0 012 2v2m-6 4h6a2 2 0 002-2v-5a2 2 0 00-2-2h-2a2 2 0 00-2 2v5a2 2 0 002 2z"/></svg>
                  Servis Talepleri
                </Link>
                <Link :href="route('admin.users.index')" class="inline-flex items-center px-4 py-2 bg-gray-800 text-white rounded hover:bg-gray-900 transition-colors">
                  <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a4 4 0 00-3-3.87M9 20H4v-2a4 4 0 013-3.87M16 3.13a4 4 0 11-8 0 4 4 0 018 0z"/></svg>
                  Kullanıcılar
                </Link>
              </div>
            </div>

            <!-- Personal Information -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-8">
              <div class="space-y-4">
                <div>
                  <h3 class="text-sm font-medium text-gray-500 dark:text-gray-400">Telefon</h3>
                  <p class="mt-1 text-gray-900 dark:text-white">{{ user.phone || 'Belirtilmemiş' }}</p>
                </div>
                <div>
                  <h3 class="text-sm font-medium text-gray-500 dark:text-gray-400">Adres</h3>
                  <p class="mt-1 text-gray-900 dark:text-white">{{ user.address || 'Belirtilmemiş' }}</p>
                </div>
              </div>
            </div>

            <!-- Servis Talepleri -->
            <div class="border-t border-gray-200 dark:border-gray-700 pt-6">
              <h3 class="text-lg font-semibold text-gray-900 dark:text-white mb-4">Servis Taleplerim</h3>
              
              <div v-if="serviceRequests.length === 0" class="text-center py-8">
                <p class="text-gray-600 dark:text-gray-400">Henüz servis talebiniz bulunmuyor.</p>
                <Link 
                  :href="route('service-request')"
                  class="inline-flex items-center mt-4 px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition dark:bg-blue-700 dark:hover:bg-blue-600"
                >
                  Yeni Talep Oluştur
                </Link>
              </div>

              <div v-else class="space-y-4">
                <div v-for="request in serviceRequests" :key="request.id" class="border rounded-lg p-4 dark:border-gray-600 flex justify-between items-center">
                  <div>
                    <h3 class="font-medium text-gray-800 dark:text-white">{{ request.service_type }}</h3>
                    <p class="text-sm text-gray-600 dark:text-gray-400">Talep No: {{ request.request_number }}</p>
                    <p class="text-sm text-gray-600 dark:text-gray-400">{{ request.service_option }}</p>
                    <p v-if="request.product" class="text-sm text-gray-600 dark:text-gray-400">Ürün: {{ request.product.name }} ({{ request.product.category }})</p>
                  </div>
                  <div class="flex flex-col items-end">
                    <span 
                      :class="{
                        'px-2 py-1 rounded text-sm mb-2': true,
                        'bg-yellow-100 text-yellow-800 dark:bg-yellow-900 dark:text-yellow-200': request.status === 'pending',
                        'bg-blue-100 text-blue-800 dark:bg-blue-900 dark:text-blue-200': request.status === 'in_progress',
                        'bg-green-100 text-green-800 dark:bg-green-900 dark:text-green-200': request.status === 'completed',
                        'bg-red-100 text-red-800 dark:bg-red-900 dark:text-red-200': request.status === 'cancelled'
                      }"
                    >
                      {{ request.status_text }}
                    </span>
                    <Link 
                      :href="route('service-requests.show', request.id)"
                      class="inline-flex items-center px-3 py-1 border border-transparent text-sm font-medium rounded-md shadow-sm text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 dark:bg-blue-700 dark:hover:bg-blue-600"
                    >
                      Görüntüle
                    </Link>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>

      <!-- Notification -->
      <NotificationCard />
    </div>
  </div>
</template>

<script setup lang="ts">
import { Link } from '@inertiajs/vue3';
import SEO from '@/components/SEO.vue';
import TopBar from '@/components/TopBar.vue';
import NotificationCard from '@/components/NotificationCard.vue';

const { user, serviceRequests } = defineProps({
  user: {
    type: Object,
    required: true,
  },
  serviceRequests: {
    type: Array,
    default: () => [],
  },
});
</script> 
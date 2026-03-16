<script setup lang="ts">
import TopBar from '@/components/TopBar.vue'
import AppFooter from '@/components/AppFooter.vue'
</script>

<template>
  <div class="min-h-screen bg-[#020b18]">
    <!-- Sticky Navbar -->
    <TopBar />

    <!-- Page Content -->
    <main>
      <slot />
    </main>

    <!-- Footer -->
    <AppFooter />
  </div>
</template>

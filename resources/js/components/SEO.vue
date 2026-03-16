<template>
  <Head>
    <title>{{ title }}</title>
    <meta name="description" :content="description">
    <meta name="keywords" :content="keywords">
    <meta property="og:title" :content="title">
    <meta property="og:description" :content="description">
    <meta property="og:type" content="website">
    <meta property="og:url" :content="url">
    <meta property="og:image" :content="image">
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" :content="title">
    <meta name="twitter:description" :content="description">
    <meta name="twitter:image" :content="image">
    <link rel="canonical" :href="url">
  </Head>
</template>

<script setup>
import { Head } from '@vueuse/head';

const props = defineProps({
  title: {
    type: String,
    required: true
  },
  description: {
    type: String,
    required: true
  },
  keywords: {
    type: String,
    required: true
  },
  url: {
    type: String,
    required: true
  },
  image: {
    type: String,
    default: '/images/og-image.jpg'
  }
});
</script> 
<script setup>
import NavigationNavbar from '@/components/Navigation/NavigationNavbar.vue'

import { RouterView } from 'vue-router'
</script>

<template>
  <header>
    <NavigationNavbar />
  </header>
  <main>
    <RouterView />
  </main>
</template>

<style scoped></style>

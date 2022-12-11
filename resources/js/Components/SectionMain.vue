<script setup>
import { containerMaxW } from '@/config.js'
</script>

<template>
  <section
    class="p-6 h-screen-full"
    :class="containerMaxW"
  >
    <slot />
  </section>
</template>

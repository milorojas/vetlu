<script setup>
import ApplicationLogo from '@/Components/ApplicationLogo.vue';
import { Link } from '@inertiajs/vue3';
</script>

<template>
  <div class="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0 bg-gray-100">
    <div class="w-full sm:max-w-md mt-6 px-6 py-4 bg-white border overflow-hidden sm:rounded-lg space-y-6">
      <div class="flex items-center justify-start">
        <Link href="/">
          <ApplicationLogo :width="40" :height="40" class="fill-current text-gray-500" />
        </Link>
      </div>
      <slot />
    </div>
  </div>
</template>

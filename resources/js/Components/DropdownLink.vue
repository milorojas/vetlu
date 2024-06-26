<script setup>
import { Link } from '@inertiajs/vue3';

defineProps({
  href: String,
  as: String,
});
</script>

<template>
  <div>
    <button
      v-if="as == 'button'"
      type="submit"
      class="group w-full flex items-center px-4 py-2 text-start text-sm text-gray-700 hover:bg-gray-100 hover:text-gray-900 focus:outline-none focus:bg-gray-100 transition duration-150 ease-in-out">
      <slot />
    </button>

    <a
      v-else-if="as == 'a'"
      :href="href"
      class="group flex items-center px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 hover:bg-gray-900 focus:outline-none focus:bg-gray-100 transition duration-150 ease-in-out">
      <slot />
    </a>

    <Link
      v-else
      :href="href"
      class="group flex items-center px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 hover:text-gray-900 focus:outline-none focus:bg-gray-100 transition duration-150 ease-in-out">
      <slot />
    </Link>
  </div>
</template>

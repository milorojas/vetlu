<script setup>
import { Icon } from '@iconify/vue';
import { Link } from '@inertiajs/vue3';

const props = defineProps({
  pages: {
    type: Array,
    default: () => [],
    required: true,
  },
});
</script>

<template>
  <nav class="flex pb-6 max-w-7xl mx-auto sm:px-6 lg:px-8 px-4" aria-label="Breadcrumb">
    <ol role="list" class="flex items-center space-x-4">
      <li>
        <div>
          <Link :href="route('dashboard')" class="text-gray-500 hover:text-gray-600">
            <Icon icon="tabler:home-2" class="h-5 w-5 flex-shrink-0" aria-hidden="true" />
            <span class="sr-only">Home</span>
          </Link>
        </div>
      </li>
      <li v-for="page in props.pages" :key="page.name">
        <div class="flex items-center">
          <Icon icon="tabler:chevron-right" class="h-5 w-5 flex-shrink-0 text-gray-500" aria-hidden="true" />
          <Link
            :href="route(page.route)"
            class="ml-4 text-sm font-medium text-gray-500 hover:text-gray-700"
            :aria-current="page.current ? 'page' : undefined">
            {{ page.name }}
          </Link>
        </div>
      </li>
    </ol>
  </nav>
</template>

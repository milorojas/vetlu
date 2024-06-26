<script setup>
import { Icon } from '@iconify/vue';
import { Link, usePage } from '@inertiajs/vue3';

const navigation = [
  {
    name: 'Dashboard',
    href: route('dashboard'),
    icon: 'tabler:home',
    current: usePage().url.startsWith('/dashboard'),
  },
];
</script>
<template>
  <li>
    <ul role="list" class="-mx-2 space-y-1">
      <div class="flex items-center text-xs font-semibold leading-6 text-gray-500 justify-between">
        <div class="flex items-center">
          {{ $t('General') }}
        </div>
      </div>
      <li v-for="item in navigation" :key="item.name">
        <Link
          :href="item.href"
          :class="[
            item.current ? ' text-gray-900 border' : 'text-gray-500 hover:bg-gray-100 hover:text-gray-700 duration-200',
            'group flex items-center gap-x-3 rounded-md py-0.5 px-1 text-sm leading-6 font-semibold hover:shadow-sm',
          ]">
          <Icon
            :icon="item.icon"
            :class="[
              item.current ? 'text-primary-500' : 'text-gray-500 group-hover:text-gray-700',
              'h-5 w-5 shrink-0 ml-1',
            ]"
            aria-hidden="true" />
          {{ $t(item.name) }}
        </Link>
      </li>
    </ul>
  </li>
</template>

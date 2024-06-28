<script setup>
import Breadcrumbs from '@/Components/Breadcrumbs.vue';
import SidebaLayout from '@/Layouts/SidebarLayout.vue';
import { Head } from '@inertiajs/vue3';

import { useUser } from '@/Composables/user';

const user = useUser();
</script>

<template>
  <Head :title="$t('Dashboard')" />

  <SidebaLayout>
    <div class="py-4">
      <Breadcrumbs :pages="[{ name: $t('Dashboard'), route: 'dashboard', current: true }]" />
      <div class="max-w-7xl mx-auto px-4 sm:px-8 lg:px-16">
        <div class="bg-white overflow-hidden border text-base rounded-lg">
          <div class="p-6 text-gray-900">{{ $t('Welcome back') }}, {{ user.name }} 👋</div>
        </div>
      </div>
    </div>
  </SidebaLayout>
</template>

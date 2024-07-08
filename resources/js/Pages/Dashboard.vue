<script setup>
import Breadcrumbs from '@/Components/Breadcrumbs.vue';
import { useUser } from '@/Composables/user';
import BaseLayout from '@/Layouts/BaseLayout.vue';
import SidebarLayout from '@/Layouts/SidebarLayout.vue';

defineOptions({
  layout: BaseLayout,
});

const user = useUser();
</script>

<template>
  <SidebarLayout :title="$t('Dashboard')">
    <div class="py-4">
      <Breadcrumbs :pages="[{ name: $t('Dashboard'), route: route('dashboard'), current: true }]" />
      <div class="max-w-7xl mx-auto px-4 sm:px-8 lg:px-16">
        <div class="bg-white overflow-hidden border text-base rounded-lg">
          <div class="p-6 text-gray-900">{{ $t('Welcome back') }}, {{ user.name }} 👋</div>
        </div>
      </div>
    </div>
  </SidebarLayout>
</template>

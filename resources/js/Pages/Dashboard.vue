<script setup>
import Breadcrumbs from '@/Components/Breadcrumbs.vue';
import Button from '@/Components/ui/button/Button.vue';
import { useUser } from '@/Composables/user';
import SidebarLayout from '@/Layouts/SidebarLayout.vue';
import { Head, router } from '@inertiajs/vue3';

defineOptions({
  layout: SidebarLayout,
});

const user = useUser();
</script>

<template>
  <div>
    <Head :title="$t('Dashboard')" />

    <div class="py-4">
      <Breadcrumbs :pages="[{ name: $t('Dashboard'), route: 'dashboard', current: true }]" />
      <div class="max-w-7xl mx-auto px-4 sm:px-8 lg:px-16">
        <div class="bg-white overflow-hidden border text-base rounded-lg">
          <div class="p-6 text-gray-900">{{ $t('Welcome back') }}, {{ user.name }} 👋</div>
          <Button @click="router.visit(route('test.toast'), { method: 'post' })">Toast</Button>
        </div>
      </div>
    </div>
  </div>
</template>

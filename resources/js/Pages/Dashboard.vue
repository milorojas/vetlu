<script setup>
import Breadcrumbs from '@/Components/Breadcrumbs.vue';
import SidebaLayout from '@/Layouts/SidebarLayout.vue';
import { Head } from '@inertiajs/vue3';
</script>

<template>
  <Head title="Dashboard" />

  <SidebaLayout>
    <div class="py-4">
      <Breadcrumbs :pages="[{ name: 'Dashboard', route: 'dashboard', current: true }]" />
      <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden border sm:rounded-lg">
          <div class="p-6 text-gray-900">You're logged in!</div>
        </div>
      </div>
    </div>
  </SidebaLayout>
</template>

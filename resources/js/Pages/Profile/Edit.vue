<script setup>
import Breadcrumbs from '@/Components/Breadcrumbs.vue';
import SidebaLayout from '@/Layouts/SidebarLayout.vue';
import { Head } from '@inertiajs/vue3';
import DeleteUserForm from './Partials/DeleteUserForm.vue';
import UpdatePasswordForm from './Partials/UpdatePasswordForm.vue';
import UpdateProfileInformationForm from './Partials/UpdateProfileInformationForm.vue';

defineProps({
  mustVerifyEmail: {
    type: Boolean,
  },
  status: {
    type: String,
  },
});
</script>

<template>
  <Head title="Profile" />

  <SidebaLayout>
    <div class="py-4">
      <Breadcrumbs :pages="[{ name: $t('Profile'), route: 'profile.edit', current: true }]" />
      <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 space-y-6">
        <div class="p-4 sm:p-8 bg-white border rounded-lg">
          <UpdateProfileInformationForm :must-verify-email="mustVerifyEmail" :status="status" class="max-w-xl" />
        </div>

        <div class="p-4 sm:p-8 bg-white border sm:rounded-lg">
          <UpdatePasswordForm class="max-w-xl" />
        </div>

        <div class="p-4 sm:p-8 bg-white border sm:rounded-lg">
          <DeleteUserForm class="max-w-xl" />
        </div>
      </div>
    </div>
  </SidebaLayout>
</template>

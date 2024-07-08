<script setup>
import Breadcrumbs from '@/Components/Breadcrumbs.vue';
import BaseLayout from '@/Layouts/BaseLayout.vue';
import SidebarLayout from '@/Layouts/SidebarLayout.vue';
import DeleteUserForm from './Partials/DeleteUserForm.vue';
import UpdatePasswordForm from './Partials/UpdatePasswordForm.vue';
import UpdateProfileInformationForm from './Partials/UpdateProfileInformationForm.vue';

defineOptions({
  layout: BaseLayout,
});

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
  <SidebarLayout :title="$t('Profile')">
    <div class="py-4">
      <Breadcrumbs :pages="[{ name: $t('Profile'), route: 'profile.edit', current: true }]" />
      <div class="max-w-7xl mx-auto px-4 sm:px-8 lg:px-16 space-y-6">
        <div class="bg-white border-b border-gray-900/10 pb-6">
          <UpdateProfileInformationForm :must-verify-email="mustVerifyEmail" :status="status" class="max-w-xl" />
        </div>

        <div class="bg-white border-b border-gray-900/10 pb-6">
          <UpdatePasswordForm class="max-w-xl" />
        </div>

        <div class="bg-white">
          <DeleteUserForm class="max-w-xl" />
        </div>
      </div>
    </div>
  </SidebarLayout>
</template>

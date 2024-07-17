<script setup>
import Breadcrumbs from '@/Components/Breadcrumbs.vue';
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import TextInput from '@/Components/TextInput.vue';
import Button from '@/Components/ui/button/Button.vue';
import BaseLayout from '@/Layouts/BaseLayout.vue';
import SidebaLayout from '@/Layouts/SidebarLayout.vue';
import { useForm } from '@inertiajs/vue3';

defineOptions({
  layout: BaseLayout,
});

const props = defineProps({
  user: {
    type: Object,
    required: true,
  },
});

const form = useForm({
  name: props.user.name,
  email: props.user.email,
});
</script>

<template>
  <SidebaLayout :title="$t('Edit :name', { name: $t('User').toLowerCase() })">
    <div class="py-4">
      <Breadcrumbs
        :pages="[
          { name: $t('Users'), route: route('users.index'), current: false },
          { name: $t('Edit'), route: route('users.edit', user.id), current: true },
        ]" />
      <div class="max-w-7xl mx-auto px-4 sm:px-8 lg:px-16 space-y-6">
        <div class="bg-white border-b border-gray-900/10 pb-6">
          <section>
            <header>
              <h2 class="text-base font-semibold leading-7 text-gray-900">{{ $t('User Information') }}</h2>

              <p class="mt-1 text-sm leading-6 text-gray-600">
                {{ $t('Modify the form below to update the user.') }}
              </p>
            </header>

            <form class="mt-6 space-y-4" @submit.prevent="form.patch(route('users.update', user.id))">
              <div>
                <InputLabel for="name" :value="$t('Name')" />

                <TextInput id="name" v-model="form.name" type="text" class="mt-1 block w-full" />

                <InputError class="mt-2" :message="form.errors.name" />
              </div>

              <div>
                <InputLabel for="email" :value="$t('Email')" />

                <TextInput id="email" v-model="form.email" type="text" class="mt-1 block w-full" />

                <InputError class="mt-2" :message="form.errors.email" />
              </div>

              <div class="flex items-center gap-4">
                <Button :disabled="form.processing">
                  {{ $t('Save') }}
                </Button>
              </div>
            </form>
          </section>
        </div>
      </div>
    </div>
  </SidebaLayout>
</template>

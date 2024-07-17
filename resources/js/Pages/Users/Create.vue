<script setup>
import Breadcrumbs from '@/Components/Breadcrumbs.vue';
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import TextInput from '@/Components/TextInput.vue';
import Button from '@/Components/ui/button/Button.vue';
import BaseLayout from '@/Layouts/BaseLayout.vue';
import SidebaLayout from '@/Layouts/SidebarLayout.vue';
import { Icon } from '@iconify/vue';
import { useForm } from '@inertiajs/vue3';

defineOptions({
  layout: BaseLayout,
});

const form = useForm({
  name: '',
  email: '',
});
</script>

<template>
  <SidebaLayout :title="$t('Create :name', { name: $t('User').toLocaleLowerCase() })">
    <div class="py-4">
      <Breadcrumbs
        :pages="[
          { name: $t('Users'), route: route('users.index'), current: false },
          { name: $t('Create'), route: route('users.create'), current: true },
        ]" />
      <div class="max-w-7xl mx-auto px-4 sm:px-8 lg:px-16 space-y-6">
        <div class="bg-white border-b border-gray-900/10 pb-6">
          <section>
            <header>
              <h2 class="text-base font-semibold leading-7 text-gray-900">{{ $t('User Information') }}</h2>

              <p class="mt-1 text-sm leading-6 text-gray-600">
                {{ $t('Complete the form below to create a new user.') }}
              </p>
            </header>

            <form class="mt-6 space-y-4" @submit.prevent="form.post(route('users.store'))">
              <div class="border-l-4 border-yellow-400 bg-yellow-50 p-4">
                <div class="flex">
                  <div class="flex-shrink-0">
                    <Icon icon="tabler:info-square-rounded" class="h-5 w-5 text-yellow-400" aria-hidden="true" />
                  </div>
                  <div class="ml-3">
                    <p class="text-sm text-yellow-700">
                      {{ $t("The password will be automatically generated and sent to the user's email.") }}
                    </p>
                  </div>
                </div>
              </div>

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

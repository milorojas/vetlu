<script setup>
import Breadcrumbs from '@/Components/Breadcrumbs.vue';
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import TextInput from '@/Components/TextInput.vue';
import Button from '@/Components/ui/button/Button.vue';
import SidebaLayout from '@/Layouts/SidebarLayout.vue';
import { Head, useForm } from '@inertiajs/vue3';
import { trans } from 'laravel-vue-i18n';

const form = useForm({
  name: '',
  address: '',
  email: '',
});
</script>

<template>
  <Head :title="$t('Create Branch')" />

  <SidebaLayout>
    <div class="py-4">
      <Breadcrumbs
        :pages="[
          { name: $t('Branches'), route: route('branches.index'), current: false },
          { name: $t('Create'), route: route('branches.create'), current: true },
        ]" />
      <div class="max-w-7xl mx-auto px-4 sm:px-8 lg:px-16 space-y-6">
        <div class="bg-white border-b border-gray-900/10 pb-6">
          <section>
            <header>
              <h2 class="text-base font-semibold leading-7 text-gray-900">{{ trans('Branch Information') }}</h2>

              <p class="mt-1 text-sm leading-6 text-gray-600">
                {{ trans('Complete the form below to create a new branch.') }}
              </p>
            </header>

            <form class="mt-6 space-y-4" @submit.prevent="form.post(route('branches.store'))">
              <div>
                <InputLabel for="name" :value="trans('Name')" />

                <TextInput id="name" v-model="form.name" type="text" class="mt-1 block w-full" />

                <InputError class="mt-2" :message="form.errors.name" />
              </div>

              <div>
                <InputLabel for="address" :value="trans('Address')" />

                <TextInput id="address" v-model="form.address" type="text" class="mt-1 block w-full" />

                <InputError class="mt-2" :message="form.errors.address" />
              </div>

              <div>
                <InputLabel for="email" :value="trans('Email')" />

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

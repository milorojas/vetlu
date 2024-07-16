<script setup>
import Checkbox from '@/Components/Checkbox.vue';
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import TextInput from '@/Components/TextInput.vue';
import Button from '@/Components/ui/button/Button.vue';
import GuestLayout from '@/Layouts/GuestLayout.vue';
import { Head, Link, useForm } from '@inertiajs/vue3';

defineProps({
  canResetPassword: {
    type: Boolean,
  },
  status: {
    type: String,
  },
});

const form = useForm({
  email: '',
  password: '',
  remember: false,
});

const submit = () => {
  form.post(route('login'), {
    onFinish: () => form.reset('password'),
  });
};
</script>

<template>
  <GuestLayout>
    <Head :title="$t('Log in')" />

    <div v-if="status" class="mb-4 font-medium text-sm text-green-600">
      {{ status }}
    </div>

    <form @submit.prevent="submit">
      <div class="grid gap-4">
        <div class="grid gap-2">
          <h3 class="scroll-m-20 text-2xl font-semibold tracking-tight">{{ $t('Log in') }}</h3>
        </div>

        <div class="grid gap-2">
          <InputLabel for="email" :value="$t('Email')" />

          <TextInput
            id="email"
            v-model="form.email"
            type="email"
            class="block w-full"
            required
            autofocus
            autocomplete="email"
            tabindex="1" />

          <InputError class="mt-2" :message="form.errors.email" />
        </div>

        <div class="grid gap-2">
          <div class="flex items-center">
            <InputLabel for="password" :value="$t('Password')" />

            <Link
              v-if="canResetPassword"
              :href="route('password.request')"
              class="ml-auto inline-block text-sm underline"
              tabindex="-1">
              {{ $t('Forgot your password?') }}
            </Link>
          </div>
          <TextInput
            id="password"
            v-model="form.password"
            type="password"
            class="mt-1 block w-full"
            required
            autocomplete="current-password"
            tabindex="2" />

          <InputError class="mt-2" :message="form.errors.password" />
        </div>

        <div class="grid gap-2">
          <label class="flex items-center">
            <Checkbox v-model:checked="form.remember" name="remember" />
            <span class="ms-2 text-sm text-gray-600">{{ $t('Remember me') }}</span>
          </label>
        </div>

        <Button type="submit" class="w-full" :disabled="form.processing">{{ $t('Log in') }}</Button>
      </div>
      <div class="mt-4 text-center text-sm">
        {{ $t("Don't have an account?") }}
        <Link :href="route('register')" class="underline">{{ $t('Sign up') }}</Link>
      </div>
    </form>
  </GuestLayout>
</template>

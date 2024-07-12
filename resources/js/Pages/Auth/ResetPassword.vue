<script setup>
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import TextInput from '@/Components/TextInput.vue';
import Button from '@/Components/ui/button/Button.vue';
import GuestLayout from '@/Layouts/GuestLayout.vue';
import { Head, useForm } from '@inertiajs/vue3';

const props = defineProps({
  email: {
    type: String,
    required: true,
  },
  token: {
    type: String,
    required: true,
  },
});

const form = useForm({
  token: props.token,
  email: props.email,
  password: '',
  password_confirmation: '',
});

const submit = () => {
  form.post(route('password.store'), {
    onFinish: () => form.reset('password', 'password_confirmation'),
  });
};
</script>

<template>
  <GuestLayout>
    <Head :title="$t('Reset Password')" />

    <form @submit.prevent="submit">
      <div class="grid gap-4">
        <div class="grid gap-2">
          <h3 class="scroll-m-20 text-2xl font-semibold tracking-tight">{{ $t('Reset Password') }}</h3>
        </div>

        <div class="grid gap-2">
          <InputLabel for="email" :value="$t('Email')" />

          <TextInput
            id="email"
            v-model="form.email"
            type="email"
            class="mt-1 block w-full"
            required
            autofocus
            autocomplete="username" />

          <InputError class="mt-2" :message="form.errors.email" />
        </div>

        <div class="grid gap-2">
          <InputLabel for="password" :value="$t('Password')" />

          <TextInput
            id="password"
            v-model="form.password"
            type="password"
            class="mt-1 block w-full"
            required
            autocomplete="new-password" />

          <InputError class="mt-2" :message="form.errors.password" />
        </div>

        <div class="grid gap-2">
          <InputLabel for="password_confirmation" :value="$t('Confirm Password')" />

          <TextInput
            id="password_confirmation"
            v-model="form.password_confirmation"
            type="password"
            class="mt-1 block w-full"
            required
            autocomplete="new-password" />

          <InputError class="mt-2" :message="form.errors.password_confirmation" />
        </div>

        <Button type="submit" class="w-full" :disabled="form.processing">{{ $t('Reset Password') }}</Button>
      </div>
    </form>
  </GuestLayout>
</template>

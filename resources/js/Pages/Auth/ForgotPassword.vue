<script setup>
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import TextInput from '@/Components/TextInput.vue';
import Button from '@/Components/ui/button/Button.vue';
import GuestLayout from '@/Layouts/GuestLayout.vue';
import { Head, Link, useForm } from '@inertiajs/vue3';

defineProps({
  status: {
    type: String,
  },
});

const form = useForm({
  email: '',
});

const submit = () => {
  form.post(route('password.email'));
};
</script>

<template>
  <GuestLayout>
    <Head :title="$t('Forgot Password?')" />

    <form @submit.prevent="submit">
      <div v-if="status" class="mb-4 font-medium text-sm text-green-600">
        {{ status }}
      </div>

      <div class="grid gap-4">
        <div class="grid gap-2">
          <h3 class="scroll-m-20 text-2xl font-semibold tracking-tight">{{ $t('Forgot Password?') }}</h3>
          <p class="text-sm">
            {{ $t('Enter your email address and we will send you a link to reset your password.') }}
          </p>
        </div>

        <div class="grid gap-2">
          <InputLabel for="email" :value="$t('Email')" />

          <TextInput id="email" v-model="form.email" type="email" class="block w-full" required autocomplete="email" />

          <InputError class="mt-2" :message="form.errors.email" />
        </div>

        <Button type="submit" class="w-full" :disabled="form.processing">{{ $t('Send Link') }}</Button>
      </div>
      <div class="mt-4 text-center text-sm">
        <Link :href="route('login')" class="underline">{{ $t('Back to login') }}</Link>
      </div>
    </form>
  </GuestLayout>
</template>

<script setup>
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import Modal from '@/Components/Modal.vue';
import TextInput from '@/Components/TextInput.vue';
import Button from '@/Components/ui/button/Button.vue';
import { useForm } from '@inertiajs/vue3';
import { trans } from 'laravel-vue-i18n';
import { nextTick, ref } from 'vue';

const confirmingUserDeletion = ref(false);
const passwordInput = ref(null);

const form = useForm({
  password: '',
});

const confirmUserDeletion = () => {
  confirmingUserDeletion.value = true;

  nextTick(() => passwordInput.value.focus());
};

const deleteUser = () => {
  form.delete(route('profile.destroy'), {
    preserveScroll: true,
    onSuccess: () => closeModal(),
    onError: () => passwordInput.value.focus(),
    onFinish: () => form.reset(),
  });
};

const closeModal = () => {
  confirmingUserDeletion.value = false;

  form.reset();
};
</script>

<template>
  <section class="space-y-6">
    <header>
      <h2 class="text-base font-semibold leading-7 text-gray-900">{{ trans('Delete Account') }}</h2>

      <p class="mt-1 text-sm leading-6 text-gray-600">
        {{
          trans(
            'Once your account is deleted, all of its resources and data will be permanently deleted. Before deleting your account, please download any data or information that you wish to retain.'
          )
        }}
      </p>
    </header>

    <Button variant="destructive" @click="confirmUserDeletion">{{ trans('Delete Account') }}</Button>

    <Modal :show="confirmingUserDeletion" @close="closeModal">
      <div class="p-6">
        <h2 class="font-medium text-gray-900">{{ trans('Are you sure you want to delete your account?') }}</h2>

        <p class="mt-1 text-sm text-gray-600">
          {{
            trans(
              'Once your account is deleted, all of its resources and data will be permanently deleted. Please enter your password to confirm you would like to permanently delete your account.'
            )
          }}
        </p>

        <div class="mt-6">
          <InputLabel for="password" :value="trans('Password')" class="sr-only" />

          <TextInput
            id="password"
            ref="passwordInput"
            v-model="form.password"
            type="password"
            class="mt-1 block w-3/4"
            :placeholder="trans('Password')"
            @keyup.enter="deleteUser" />

          <InputError :message="form.errors.password" class="mt-2" />
        </div>

        <div class="mt-6 flex justify-end">
          <Button variant="outline" @click="closeModal">{{ trans('Cancel') }}</Button>

          <Button class="ms-3" variant="destructive" :disabled="form.processing" @click="deleteUser">
            {{ trans('Delete Account') }}
          </Button>
        </div>
      </div>
    </Modal>
  </section>
</template>

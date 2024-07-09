<script setup>
import Breadcrumbs from '@/Components/Breadcrumbs.vue';
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import TextInput from '@/Components/TextInput.vue';
import Button from '@/Components/ui/button/Button.vue';
import { Progress } from '@/Components/ui/progress';
import BaseLayout from '@/Layouts/BaseLayout.vue';
import SidebaLayout from '@/Layouts/SidebarLayout.vue';
import { useForm } from '@inertiajs/vue3';

defineOptions({
  layout: BaseLayout,
});

const props = defineProps({
  branch: {
    type: Object,
    required: true,
  },
});

const form = useForm({
  name: props.branch.name,
  address: props.branch.address,
  email: props.branch.email,
  image: props.branch.image,
  imageUrl: props.branch.imageUrl,
  _method: 'PUT',
});
</script>

<template>
  <SidebaLayout :title="$t('Edit Branch')">
    <div class="py-4">
      <Breadcrumbs
        :pages="[
          { name: $t('Branches'), route: route('branches.index'), current: false },
          { name: $t('Edit'), route: route('branches.edit', branch.id), current: true },
        ]" />
      <div class="max-w-7xl mx-auto px-4 sm:px-8 lg:px-16 space-y-6">
        <div class="bg-white border-b border-gray-900/10 pb-6">
          <section>
            <header>
              <h2 class="text-base font-semibold leading-7 text-gray-900">{{ $t('Branch Information') }}</h2>

              <p class="mt-1 text-sm leading-6 text-gray-600">
                {{ $t('Modify the form below to update the branch.') }}
              </p>
            </header>

            <form class="mt-6 space-y-4" @submit.prevent="form.post(route('branches.update', branch.id))">
              <div>
                <InputLabel for="name" :value="$t('Name')" />

                <TextInput id="name" v-model="form.name" type="text" class="mt-1 block w-full" />

                <InputError class="mt-2" :message="form.errors.name" />
              </div>

              <div>
                <InputLabel for="address" :value="$t('Address')" />

                <TextInput id="address" v-model="form.address" type="text" class="mt-1 block w-full" />

                <InputError class="mt-2" :message="form.errors.address" />
              </div>

              <div>
                <InputLabel for="email" :value="$t('Email')" />

                <TextInput id="email" v-model="form.email" type="text" class="mt-1 block w-full" />

                <InputError class="mt-2" :message="form.errors.email" />
              </div>

              <div>
                <InputLabel for="image" :value="$t('Image')" />
                <img
                  v-if="form.imageUrl !== null"
                  :src="'/storage/' + form.imageUrl"
                  alt="Branch Image"
                  class="mt-1 w-24 h-24 object-cover rounded-md" />

                <Button type="button" class="mt-1" variant="outline" @click="$refs.image.click()">
                  {{ $t('Choose File') }}
                </Button>

                <Button
                  v-if="form.imageUrl !== null"
                  type="button"
                  class="mt-1 ml-1"
                  variant="destructive"
                  @click="(form.image = ''), (form.imageUrl = null)">
                  {{ $t('Delete') }}
                </Button>

                <span v-if="form.image" class="mt-1 block text-sm text-gray-600">
                  {{ form.image.name }}
                </span>

                <Progress v-if="form.progress" class="mt-1" :model-value="form.progress.percentage" />

                <!-- hidden input to handle the file selection -->
                <input id="image" ref="image" class="hidden" type="file" @input="form.image = $event.target.files[0]" />

                <InputError class="mt-2" :message="form.errors.image" />
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

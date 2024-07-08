<script setup>
import { Icon } from '@iconify/vue';
import { router, usePage } from '@inertiajs/vue3';
import { onUnmounted } from 'vue';
import { Toaster, toast } from 'vue-sonner';

const page = usePage();

let removeFinshEventListener = router.on('finish', () => {
  if (page.props.toast) {
    if (page.props.toast.type === 'success') {
      toast.success(page.props.toast.message);
    } else {
      toast.error(page.props.toast.message);
    }
  }
});

onUnmounted(() => removeFinshEventListener());
</script>

<template>
  <div>
    <Toaster>
      <template #success-icon>
        <Icon icon="tabler:circle-check" class="h-5 w-5 text-green-500" />
      </template>
      <template #error-icon>
        <Icon icon="tabler:exclamation-circle" class="h-5 w-5 text-red-500" />
      </template>
    </Toaster>
    <slot />
  </div>
</template>

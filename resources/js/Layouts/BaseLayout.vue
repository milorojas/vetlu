<script setup>
import { router, usePage } from '@inertiajs/vue3';
import { onUnmounted, ref } from 'vue';
import { Toaster, toast } from 'vue-sonner';

defineProps({
  title: String,
});

const sidebarOpen = ref(false);

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
    <Toaster />
    <slot />
  </div>
</template>

<script setup>
import { Icon } from '@iconify/vue';

const props = defineProps({
  width: {
    type: Number,
    default: 32,
  },
  height: {
    type: Number,
    default: 32,
  },
  text: {
    type: String,
    default: '',
  },
});
</script>

<template>
  <div class="flex items-center">
    <div class="rounded-md border bg-primary-500 px-0.5 py-0.5 border-gray-300">
      <Icon
        icon="solar:bone-linear"
        class="text-white"
        aria-hidden="true"
        :width="props.width"
        :height="props.height" />
    </div>
    <span v-if="props.text" class="ml-2 font-bold font-mono text-lg text-gray-700">
      {{ props.text }}
    </span>
  </div>
</template>

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
    <div class="rounded-md border bg-primary-500 p-1 border-gray-300">
      <Icon
        icon="simple-icons:macpaw"
        class="text-white -rotate-45"
        aria-hidden="true"
        :width="props.width"
        :height="props.height" />
    </div>
    <span v-if="props.text" class="ml-2 font-bold font-mono text-lg text-gray-700">
      {{ props.text }}
    </span>
  </div>
</template>

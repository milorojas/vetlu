import { usePage } from '@inertiajs/vue3';
import { computed } from 'vue';

export function useUser() {
  const page = usePage();

  return computed(() => page.props.auth.user);
}

<script setup>
import { Dialog, DialogPanel, TransitionChild, TransitionRoot } from '@headlessui/vue';
import { Icon } from '@iconify/vue';
import { Head, router, usePage } from '@inertiajs/vue3';
import { onUnmounted, ref } from 'vue';
import { Toaster, toast } from 'vue-sonner';
import Navigation from './Partials/Navigation.vue';
import UserDropdown from './Partials/UserDropdown.vue';

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
    <Head :title="title" />

    <TransitionRoot as="template" :show="sidebarOpen">
      <Dialog as="div" class="relative z-50 lg:hidden" @close="sidebarOpen = false">
        <TransitionChild
          as="template"
          enter="transition-opacity ease-linear duration-300"
          enter-from="opacity-0"
          enter-to="opacity-100"
          leave="transition-opacity ease-linear duration-300"
          leave-from="opacity-100"
          leave-to="opacity-0">
          <div class="fixed inset-0 bg-gray-900/80" />
        </TransitionChild>

        <div class="fixed inset-0 flex">
          <TransitionChild
            as="template"
            enter="transition ease-in-out duration-300 transform"
            enter-from="-translate-x-full"
            enter-to="translate-x-0"
            leave="transition ease-in-out duration-300 transform"
            leave-from="translate-x-0"
            leave-to="-translate-x-full">
            <DialogPanel class="relative mr-16 flex w-full max-w-xs flex-1">
              <TransitionChild
                as="template"
                enter="ease-in-out duration-300"
                enter-from="opacity-0"
                enter-to="opacity-100"
                leave="ease-in-out duration-300"
                leave-from="opacity-100"
                leave-to="opacity-0">
                <div class="absolute left-full top-0 flex w-16 justify-center pt-5">
                  <button type="button" class="-m-2.5 p-2.5" @click="sidebarOpen = false">
                    <span class="sr-only">Close sidebar</span>
                    <Icon icon="tabler:x" class="h-6 w-6 text-white" aria-hidden="true" />
                  </button>
                </div>
              </TransitionChild>
              <!-- Sidebar component, swap this element with another sidebar if you like -->
              <div class="flex grow flex-col gap-y-5 overflow-y-auto bg-gray-50 px-6 pb-2">
                <!-- User Dropdown -->
                <div class="relative -mx-5 pt-4">
                  <UserDropdown />
                </div>
                <nav class="flex flex-1 flex-col">
                  <ul role="list" class="flex flex-1 flex-col gap-y-7">
                    <!-- Navigation Links -->
                    <Navigation />
                  </ul>
                </nav>
              </div>
            </DialogPanel>
          </TransitionChild>
        </div>
      </Dialog>
    </TransitionRoot>

    <!-- Static sidebar for desktop -->
    <div class="hidden lg:fixed lg:inset-y-0 lg:z-50 lg:flex lg:w-72 lg:flex-col">
      <!-- Sidebar component, swap this element with another sidebar if you like -->
      <div class="flex grow flex-col gap-y-5 overflow-y-auto border-r border-gray-200 bg-gray-50 px-6">
        <!-- User Dropdown -->
        <div class="relative -mx-5 pt-4">
          <UserDropdown />
        </div>
        <nav class="flex flex-1 flex-col">
          <ul role="list" class="flex flex-1 flex-col gap-y-7">
            <!-- Navigation Links -->
            <Navigation />
          </ul>
        </nav>
      </div>
    </div>

    <div class="sticky top-0 z-40 flex items-center gap-x-6 bg-white px-4 py-4 border sm:px-6 lg:hidden">
      <button type="button" class="-m-2.5 p-2.5 text-gray-700 lg:hidden" @click="sidebarOpen = true">
        <span class="sr-only">Open sidebar</span>
        <Icon icon="tabler:menu-2" class="h-6 w-6" aria-hidden="true" />
      </button>
    </div>

    <main class="lg:pl-72">
      <div>
        <slot />
      </div>
    </main>
  </div>
</template>

<script setup>
import { useUser } from '@/Composables/user.js';
import { Menu, MenuButton, MenuItem, MenuItems } from '@headlessui/vue';
import { Icon } from '@iconify/vue';
import { Link } from '@inertiajs/vue3';
import { trans } from 'laravel-vue-i18n';

const user = useUser();
</script>
<template>
  <!-- User account dropdown -->
  <Menu as="div" class="relative inline-block px-3 text-left w-full">
    <div>
      <MenuButton
        class="border group w-full rounded-md bg-gray-50 px-3.5 py-2 text-left text-sm font-medium text-gray-700 hover:bg-gray-100">
        <span class="flex w-full items-center justify-between">
          <span class="flex min-w-0 items-center justify-between space-x-3">
            <img
              class="h-10 w-10 flex-shrink-0 rounded-md bg-gray-300"
              :src="$page.props.auth.user.profile_photo_url"
              alt="" />
            <span class="flex min-w-0 flex-1 flex-col">
              <span class="truncate text-sm font-medium text-gray-900">{{ user.name }}</span>
              <span class="truncate text-xs text-gray-500">
                <Icon icon="tabler:building-hospital" class="w-3 h-3 inline-block mr-1" />
                {{ 'Av. Suecia 1234' }}
              </span>
            </span>
          </span>
          <Icon
            icon="heroicons-solid:chevron-down"
            class="h-5 w-5 flex-shrink-0 text-gray-400 group-hover:text-gray-500"
            aria-hidden="true" />
        </span>
      </MenuButton>
    </div>
    <transition
      enter-active-class="transition ease-out duration-100"
      enter-from-class="transform opacity-0 scale-95"
      enter-to-class="transform opacity-100 scale-100"
      leave-active-class="transition ease-in duration-75"
      leave-from-class="transform opacity-100 scale-100"
      leave-to-class="transform opacity-0 scale-95">
      <MenuItems
        class="absolute left-0 right-0 z-10 mx-3 mt-1 origin-top divide-y divide-gray-200 rounded-md bg-white shadow-lg ring-1 ring-black ring-opacity-5 focus:outline-none">
        <div class="py-1">
          <MenuItem v-slot="{ active }">
            <Link
              :href="route('profile.edit')"
              :class="[active ? 'bg-gray-100 text-gray-900' : 'text-gray-700', 'block px-4 py-2 text-sm']">
              <Icon icon="tabler:user" class="w-4 h-4 inline-block mr-2" />
              {{ trans('Profile') }}
            </Link>
          </MenuItem>
        </div>
        <div class="py-1">
          <MenuItem v-slot="{ active }">
            <a href="#" :class="[active ? 'bg-gray-100 text-gray-900' : 'text-gray-700', 'block px-4 py-2 text-sm']">
              <Icon icon="tabler:building-hospital" class="w-4 h-4 inline-block mr-2" />
              {{ trans('Change location') }}
            </a>
          </MenuItem>
        </div>
        <div class="py-1">
          <MenuItem v-slot="{ active }">
            <Link
              :href="route('logout')"
              method="post"
              as="button"
              type="button"
              :class="[
                active ? 'bg-gray-100 text-gray-900' : 'text-gray-700',
                'block px-4 py-2 text-sm w-full text-left',
              ]">
              <Icon icon="tabler:logout" class="w-4 h-4 inline-block mr-2 text-red-500" />
              {{ trans('Logout') }}
            </Link>
          </MenuItem>
        </div>
      </MenuItems>
    </transition>
  </Menu>
</template>

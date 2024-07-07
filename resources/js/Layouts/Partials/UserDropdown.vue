<script setup>
import {
  DropdownMenu,
  DropdownMenuContent,
  DropdownMenuGroup,
  DropdownMenuItem,
  DropdownMenuSeparator,
  DropdownMenuTrigger,
} from '@/Components/ui/dropdown-menu';
import { useUser } from '@/Composables/user.js';
import { Icon } from '@iconify/vue';
import { router } from '@inertiajs/vue3';
import { Primitive } from 'radix-vue';

const user = useUser();
</script>
<template>
  <!-- User account dropdown -->
  <div class="px-3 text-left w-full">
    <DropdownMenu>
      <DropdownMenuTrigger as-child>
        <Primitive
          as="button"
          class="w-full border rounded-md bg-gray-50 px-3.5 py-2 text-left text-sm font-medium text-gray-700 hover:bg-gray-100">
          <span class="flex w-full items-center justify-between">
            <span class="flex min-w-0 items-center justify-between space-x-3">
              <img class="h-10 w-10 flex-shrink-0 rounded-md bg-gray-300" :src="user.profile_photo_url" alt="" />
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
        </Primitive>
      </DropdownMenuTrigger>
      <DropdownMenuContent class="w-64">
        <DropdownMenuGroup>
          <DropdownMenuItem @select="router.visit(route('profile.edit'))">
            <Icon icon="tabler:user" class="w-4 h-4 inline-block mr-2" />
            <span>{{ $t('Profile') }}</span>
          </DropdownMenuItem>
        </DropdownMenuGroup>
        <DropdownMenuSeparator />
        <DropdownMenuGroup>
          <DropdownMenuItem>
            <Icon icon="tabler:building-hospital" class="w-4 h-4 inline-block mr-2" />
            <span>{{ $t('Change branch') }}</span>
          </DropdownMenuItem>
        </DropdownMenuGroup>
        <DropdownMenuSeparator />
        <DropdownMenuItem @select="router.visit(route('logout'), { method: 'post' })">
          <Icon icon="tabler:logout" class="w-4 h-4 inline-block mr-2 text-red-500" />
          <span>{{ $t('Logout') }}</span>
        </DropdownMenuItem>
      </DropdownMenuContent>
    </DropdownMenu>
  </div>
</template>

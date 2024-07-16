<script setup>
import ApplicationLogo from '@/Components/ApplicationLogo.vue';
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
import { router, usePage } from '@inertiajs/vue3';
import { Primitive } from 'radix-vue';
import { ref } from 'vue';

const user = useUser();

// Change branch dialog
const selectedBranch = ref(user.value.current_branch != null ? String(user.value.current_branch) : '');
const branches = user.value.branches;
const showDialogChangeBranch = ref(false);

const updateBranch = () => {
  showDialogChangeBranch.value = false;
  router.patch(route('profile.switch-branch', { current_branch: selectedBranch.value }));
};

const switchBranch = branchId => {
  selectedBranch.value = branchId;
  updateBranch();
};
</script>
<template>
  <!-- User account dropdown -->
  <div class="px-3 text-left w-full">
    <div class="flex justify-between items-center">
      <!-- branches feature -->
      <DropdownMenu v-if="user.features.branches">
        <DropdownMenuTrigger as-child>
          <Primitive
            as="button"
            class="w-full rounded-md bg-gray-50 px-2 py-2 text-left text-sm font-medium text-gray-700 hover:bg-gray-100">
            <span class="flex w-full items-center justify-between">
              <span class="flex min-w-0 items-center justify-between space-x-3">
                <img
                  v-if="user.branch"
                  class="h-6 w-6 flex-shrink-0 rounded-md bg-gray-300"
                  :src="user.branch?.photo_url"
                  alt="Branch image" />
                <Icon
                  v-else
                  icon="tabler:building-hospital"
                  class="w-6 h-6 p-0.5 text-gray-500 bg-white border rounded-md" />
                <span class="flex min-w-0 flex-1 flex-col">
                  <div class="flex items-center">
                    <span class="truncate text-sm font-semibold text-gray-600">
                      {{ user.branch?.name ? user.branch.name : $t('No branch') }}
                    </span>
                  </div>
                </span>
              </span>
              <Icon
                icon="tabler:selector"
                class="h-5 w-5 flex-shrink-0 text-gray-400 group-hover:text-gray-500"
                aria-hidden="true" />
            </span>
          </Primitive>
        </DropdownMenuTrigger>
        <DropdownMenuContent class="w-56">
          <DropdownMenuGroup>
            <template v-for="branch in branches" :key="branch.id">
              <DropdownMenuItem
                :disabled="branch.id == user.branch?.id || branch.status == 'inactive'"
                @select="switchBranch(branch.id)">
                <img
                  class="h-6 w-6 flex-shrink-0 rounded-md bg-gray-300 inline-block mr-2"
                  :src="branch.photo_url"
                  alt="Branch image" />
                <span class="font-sm font-medium">{{ branch.name }}</span>
              </DropdownMenuItem>
            </template>
            <template v-if="branches.length == 0">
              <DropdownMenuItem :disabled="true">
                <span class="font-sm font-medium">{{ $t('No branches') }}</span>
              </DropdownMenuItem>
            </template>
          </DropdownMenuGroup>
        </DropdownMenuContent>
      </DropdownMenu>

      <ApplicationLogo v-else :width="24" :height="24" :text="usePage().props.app.name" />

      <DropdownMenu>
        <DropdownMenuTrigger as-child class="ml-3">
          <img
            class="h-6 w-6 rounded-full flex-shrink-0 bg-gray-300 hover:cursor-pointer"
            :src="user.profile_photo_url"
            alt="User image" />
        </DropdownMenuTrigger>
        <DropdownMenuContent class="w-52">
          <DropdownMenuGroup>
            <DropdownMenuItem @select="router.visit(route('profile.edit'))">
              <Icon icon="tabler:user" class="w-4 h-4 inline-block mr-2" />
              <span>{{ $t('Profile') }}</span>
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
  </div>
</template>

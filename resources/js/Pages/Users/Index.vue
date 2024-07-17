<script setup>
import Breadcrumbs from '@/Components/Breadcrumbs.vue';
import {
  AlertDialog,
  AlertDialogAction,
  AlertDialogCancel,
  AlertDialogContent,
  AlertDialogDescription,
  AlertDialogFooter,
  AlertDialogHeader,
  AlertDialogTitle,
} from '@/Components/ui/alert-dialog';
import Button from '@/Components/ui/button/Button.vue';
import {
  DropdownMenu,
  DropdownMenuContent,
  DropdownMenuGroup,
  DropdownMenuItem,
  DropdownMenuSeparator,
  DropdownMenuTrigger,
} from '@/Components/ui/dropdown-menu';
import { Table, TableBody, TableCell, TableHead, TableHeader, TableRow } from '@/Components/ui/table';
import BaseLayout from '@/Layouts/BaseLayout.vue';
import SidebarLayout from '@/Layouts/SidebarLayout.vue';
import { Icon } from '@iconify/vue';
import { Link, router } from '@inertiajs/vue3';
import { ref } from 'vue';

defineOptions({
  layout: BaseLayout,
});

const props = defineProps({
  users: Array,
});

const showConfirmationDialog = ref(false);
const userToDelete = ref(null);

// Set status
const changeStatus = (userId, status) => {
  router.patch(route('users.change-status', userId), { status }, { preserveState: false });
};
</script>

<template>
  <SidebarLayout :title="$t('Users')">
    <div class="py-4">
      <Breadcrumbs :pages="[{ name: $t('Users'), route: route('users.index'), current: true }]" />
      <div class="max-w-7xl mx-auto px-4 sm:px-8 lg:px-16">
        <div class="sm:flex sm:items-center">
          <div class="sm:flex-auto">
            <h1 class="text-base font-semibold leading-6 text-gray-900">{{ $t('Users') }}</h1>
            <p class="mt-2 text-sm text-gray-700">
              {{ $t('Manage all the users in your organization.') }}
            </p>
          </div>
          <div class="mt-4 sm:ml-16 sm:mt-0 sm:flex-none">
            <Button :as="Link" :href="route('users.create')">
              {{ $t('Add :name', { name: $t('User').toLowerCase() }) }}
            </Button>
          </div>
        </div>
        <div class="mt-8 flow-root">
          <div class="-mx-4 -my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
            <div class="inline-block min-w-full py-2 align-middle sm:px-6 lg:px-8">
              <Table>
                <TableHeader>
                  <TableRow>
                    <TableHead>#</TableHead>
                    <TableHead>{{ $t('Name') }}</TableHead>
                    <TableHead>{{ $t('Email') }}</TableHead>
                    <TableHead></TableHead>
                  </TableRow>
                </TableHeader>
                <TableBody>
                  <TableRow v-for="user in props.users" :key="user.id">
                    <TableCell class="font-medium">{{ user.id }}</TableCell>
                    <TableCell>{{ user.name }}</TableCell>
                    <TableCell>{{ user.email }}</TableCell>
                    <TableCell>
                      <DropdownMenu>
                        <DropdownMenuTrigger as-child>
                          <Icon icon="tabler:dots" class="w-5 h-5 text-gray-400" />
                        </DropdownMenuTrigger>
                        <DropdownMenuContent>
                          <DropdownMenuGroup>
                            <DropdownMenuItem @select="router.visit(route('users.edit', user.id))">
                              <Icon icon="tabler:edit" class="w-4 h-4 inline-block mr-2" />
                              <span>{{ $t('Edit') }}</span>
                            </DropdownMenuItem>

                            <DropdownMenuSeparator />

                            <DropdownMenuItem @select="(showConfirmationDialog = true), (userToDelete = user.id)">
                              <Icon icon="tabler:trash" class="w-4 h-4 inline-block mr-2 text-red-500" />
                              <span>{{ $t('Delete') }}</span>
                            </DropdownMenuItem>
                          </DropdownMenuGroup>
                        </DropdownMenuContent>
                      </DropdownMenu>
                    </TableCell>
                  </TableRow>
                </TableBody>
              </Table>
            </div>
          </div>
        </div>
      </div>
    </div>

    <AlertDialog :open="showConfirmationDialog" @update:open="showConfirmationDialog = $event">
      <AlertDialogContent>
        <AlertDialogHeader>
          <AlertDialogTitle>{{ $t('Are you sure?') }}</AlertDialogTitle>
          <AlertDialogDescription>
            {{ $t('This action cannot be undone. Are you sure you want to delete this user?') }}
          </AlertDialogDescription>
        </AlertDialogHeader>
        <AlertDialogFooter>
          <AlertDialogCancel>{{ $t('Cancel') }}</AlertDialogCancel>
          <AlertDialogAction
            class="bg-red-500 hover:bg-red-500/90"
            @click="router.delete(route('users.destroy', userToDelete))">
            {{ $t('Delete') }}
          </AlertDialogAction>
        </AlertDialogFooter>
      </AlertDialogContent>
    </AlertDialog>
  </SidebarLayout>
</template>

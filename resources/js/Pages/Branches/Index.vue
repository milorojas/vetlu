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
  DropdownMenuPortal,
  DropdownMenuSeparator,
  DropdownMenuSub,
  DropdownMenuSubContent,
  DropdownMenuSubTrigger,
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
  branches: Array,
});

const showConfirmationDialog = ref(false);
const branchToDelete = ref(null);

// Set status
const changeStatus = (branchId, status) => {
  router.patch(route('branches.change-status', branchId), { status });
};
</script>

<template>
  <SidebarLayout :title="$t('Branches')">
    <div class="py-4">
      <Breadcrumbs :pages="[{ name: $t('Branches'), route: route('branches.index'), current: true }]" />
      <div class="max-w-7xl mx-auto px-4 sm:px-8 lg:px-16">
        <div class="sm:flex sm:items-center">
          <div class="sm:flex-auto">
            <h1 class="text-base font-semibold leading-6 text-gray-900">{{ $t('Branches') }}</h1>
            <p class="mt-2 text-sm text-gray-700">
              {{ $t('Manage all the branches in your organization.') }}
            </p>
          </div>
          <div class="mt-4 sm:ml-16 sm:mt-0 sm:flex-none">
            <Button :as="Link" :href="route('branches.create')">
              {{ $t('Add branch') }}
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
                    <TableHead>{{ $t('Address') }}</TableHead>
                    <TableHead>{{ $t('Email') }}</TableHead>
                    <TableHead>{{ $t('Status') }}</TableHead>
                    <TableHead></TableHead>
                  </TableRow>
                </TableHeader>
                <TableBody>
                  <TableRow v-for="branch in props.branches" :key="branch.id">
                    <TableCell class="font-medium">{{ branch.id }}</TableCell>
                    <TableCell>{{ branch.name }}</TableCell>
                    <TableCell>{{ branch.address }}</TableCell>
                    <TableCell>{{ branch.email }}</TableCell>
                    <TableCell>
                      <span
                        v-if="branch.status === 'active'"
                        class="inline-flex items-center rounded-md bg-green-50 px-2 py-1 text-xs font-medium text-green-700 ring-1 ring-inset ring-green-600/20">
                        {{ $t('Active') }}
                      </span>

                      <span
                        v-else
                        class="inline-flex items-center rounded-md bg-red-50 px-2 py-1 text-xs font-medium text-red-700 ring-1 ring-inset ring-red-600/10">
                        {{ $t('Inactive') }}
                      </span>
                    </TableCell>
                    <TableCell>
                      <DropdownMenu>
                        <DropdownMenuTrigger as-child>
                          <Icon icon="tabler:dots" class="w-5 h-5 text-gray-400" />
                        </DropdownMenuTrigger>
                        <DropdownMenuContent>
                          <DropdownMenuGroup>
                            <DropdownMenuItem @select="router.visit(route('branches.edit', branch.id))">
                              <Icon icon="tabler:edit" class="w-4 h-4 inline-block mr-2" />
                              <span>{{ $t('Edit') }}</span>
                            </DropdownMenuItem>

                            <DropdownMenuSub>
                              <DropdownMenuSubTrigger>
                                <Icon icon="tabler:circle-dashed" class="w-4 h-4 inline-block mr-2" />
                                <span>{{ $t('Set status') }}</span>
                              </DropdownMenuSubTrigger>
                              <DropdownMenuPortal>
                                <DropdownMenuSubContent>
                                  <DropdownMenuItem
                                    :disabled="branch.status == 'active'"
                                    @select="changeStatus(branch.id, 'active')">
                                    <Icon
                                      icon="tabler:circle-dashed-check"
                                      class="w-4 h-4 inline-block mr-2 text-green-500" />
                                    <span class="font-mono text-sm lowercase">{{ $t('Active') }}</span>
                                  </DropdownMenuItem>
                                  <DropdownMenuItem
                                    :disabled="branch.status == 'inactive'"
                                    @select="changeStatus(branch.id, 'inactive')">
                                    <Icon
                                      icon="tabler:circle-dashed-x"
                                      class="w-4 h-4 inline-block mr-2 text-red-500" />
                                    <span class="font-mono text-sm lowercase">{{ $t('Inactive') }}</span>
                                  </DropdownMenuItem>
                                </DropdownMenuSubContent>
                              </DropdownMenuPortal>
                            </DropdownMenuSub>

                            <DropdownMenuSeparator />

                            <DropdownMenuItem @select="(showConfirmationDialog = true), (branchToDelete = branch.id)">
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
            {{ $t('This action cannot be undone. Are you sure you want to delete this branch?') }}
          </AlertDialogDescription>
        </AlertDialogHeader>
        <AlertDialogFooter>
          <AlertDialogCancel>{{ $t('Cancel') }}</AlertDialogCancel>
          <AlertDialogAction
            class="bg-red-500 hover:bg-red-500/90"
            @click="router.delete(route('branches.destroy', branchToDelete))">
            {{ $t('Delete') }}
          </AlertDialogAction>
        </AlertDialogFooter>
      </AlertDialogContent>
    </AlertDialog>
  </SidebarLayout>
</template>

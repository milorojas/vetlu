<script setup>
import Breadcrumbs from '@/Components/Breadcrumbs.vue';
import Button from '@/Components/ui/button/Button.vue';
import SidebaLayout from '@/Layouts/SidebarLayout.vue';
import { Head, Link } from '@inertiajs/vue3';

const props = defineProps({
  branches: Array,
});
</script>

<template>
  <Head :title="$t('Branches')" />

  <SidebaLayout>
    <div class="py-4">
      <Breadcrumbs :pages="[{ name: $t('Branches'), route: 'branches.index', current: true }]" />
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
              <table class="min-w-full divide-y divide-gray-300">
                <thead>
                  <tr>
                    <th scope="col" class="py-3.5 pl-4 pr-3 text-left text-sm font-semibold text-gray-900 sm:pl-0">
                      {{ $t('Name') }}
                    </th>
                    <th scope="col" class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">
                      {{ $t('Address') }}
                    </th>
                    <th scope="col" class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">
                      {{ $t('Email') }}
                    </th>
                    <th scope="col" class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">
                      {{ $t('Status') }}sd
                    </th>
                    <th scope="col" class="relative py-3.5 pl-3 pr-4 sm:pr-0">
                      <span class="sr-only">{{ $t('Edit') }}</span>
                    </th>
                  </tr>
                </thead>
                <tbody class="divide-y divide-gray-200">
                  <tr v-for="branch in props.branches" :key="branch.id">
                    <td class="whitespace-nowrap py-4 pl-4 pr-3 text-sm font-medium text-gray-900 sm:pl-0">
                      {{ branch.name }}
                    </td>
                    <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">{{ branch.address }}</td>
                    <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">{{ branch.email }}</td>
                    <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">
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
                    </td>
                    <td class="relative whitespace-nowrap py-4 pl-3 pr-4 text-right text-sm font-medium sm:pr-0">
                      <a href="#" class="text-indigo-600 hover:text-indigo-900">
                        Edit
                        <span class="sr-only">, {{ branch.name }}</span>
                      </a>
                    </td>
                  </tr>
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
    </div>
  </SidebaLayout>
</template>

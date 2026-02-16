<template>
    <AppLayout :title="__('Users')">

        <div class="px-4 sm:px-6 lg:px-8 mb-20">
            <div class="sm:flex sm:items-center">
                <div class="sm:flex-auto">
                    <h1 class="text-xl font-semibold leading-6 text-gray-900">{{ __('Users') }}</h1>
                    <p class="mt-2 text-gray-700">{{ __('A list of all the users in your account including their name, email and role') }}.</p>
                </div>
<!--                <div class="mt-4 sm:ml-16 sm:mt-0 sm:flex-none">-->
<!--                    <button type="button" class="block rounded-md bg-orange-600 px-3 py-2 text-center text-white shadow-sm hover:bg-orange-700 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-orange-600">Add user</button>-->
<!--                </div>-->
            </div>
            <div class="mt-8 flow-root">
                <div class="-mx-4 -my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
                    <div class="inline-block min-w-full py-2 align-middle sm:px-6 lg:px-8">
                        <table class="min-w-full divide-y divide-gray-300">
                            <thead>
                            <tr>
                                <th scope="col" class="py-3.5 pl-4 pr-3 text-left text-sm font-semibold text-gray-900 sm:pl-3">Name</th>
                                <th scope="col" class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">Email</th>
                                <th scope="col" class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">Role</th>
                                <th scope="col" class="relative py-3.5 pl-3 pr-4 sm:pr-3">
                                    <span class="sr-only">Edit</span>
                                </th>
                            </tr>
                            </thead>
                            <tbody class="bg-white">
                            <tr v-for="user in users.data" :key="user.email" class="even:bg-gray-50">
                                <td class="whitespace-nowrap py-4 pl-4 pr-3 text-sm font-medium text-gray-900 sm:pl-3">{{ user.first_name }} {{ user.last_name }}</td>
                                <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">{{ user.email }}</td>
                                <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">{{ user.type }}</td>
                                <td class="relative whitespace-nowrap py-4 pl-3 pr-4 text-right text-sm font-medium sm:pr-3">
                                    <button 
                                        @click="confirmDelete(user)" 
                                        class="text-red-600 hover:text-red-900"
                                    >
                                        {{ __('Delete') }}
                                    </button>
                                </td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <!-- Delete Confirmation Modal -->
        <Modal :show="showDeleteModal" @close="closeModal">
            <div class="p-6">
                <h2 class="text-lg font-medium text-gray-900">
                    {{ __('Confirm Delete') }}
                </h2>
                <p class="mt-2 text-sm text-gray-500">
                    {{ __('Are you sure you want to delete this user?') }}
                </p>
                <div class="mt-6 flex space-x-4">
                    <button
                        @click="deleteUser"
                        class="bg-red-600 px-4 py-2 text-sm text-white rounded-md hover:bg-red-700"
                    >
                        {{ __('Delete') }}
                    </button>
                    <button
                        @click="closeModal"
                        class="bg-gray-300 px-4 py-2 text-sm rounded-md hover:bg-gray-400"
                    >
                        {{ __('Cancel') }}
                    </button>
                </div>
            </div>
        </Modal>
    </AppLayout>
</template>
<script setup>

import AppLayout from "@/Layouts/AppLayout.vue";
import { useTranslate} from "@/Composables/useTranslate.js";
import Modal from '@/Components/Modal.vue';
import { ref } from 'vue';
import { router } from '@inertiajs/vue3';

const {__} = useTranslate()

const props = defineProps({
    users: Array,
})

const showDeleteModal = ref(false);
const userToDelete = ref(null);

const confirmDelete = (user) => {
    userToDelete.value = user;
    showDeleteModal.value = true;
};

const closeModal = () => {
    showDeleteModal.value = false;
    userToDelete.value = null;
};

const deleteUser = () => {
    if (userToDelete.value) {
        router.delete(`/admin/users/${userToDelete.value.id}`, {
            onSuccess: () => {
                closeModal();
            },
        });
    }
};

</script>

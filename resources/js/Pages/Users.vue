<script setup>
import AppLayout from '@/Layouts/AppLayout.vue';
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import Modal from '@/Components/Modal.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import SecondaryButton from '@/Components/SecondaryButton.vue';
import TextInput from '@/Components/TextInput.vue';
</script>

<template>
    <AppLayout title="Users">
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                Usuários
            </h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-xl sm:rounded-lg px-4 py-4">
                    <div class="bg-teal-100 border-t-4 border-teal-500 rounded-b text-teal-900 px-4 py-3 shadow-md my-3"
                        role="alert" v-if="$page.props.flash.message">
                        <div class="flex">
                            <div>
                                <p class="text-sm">{{ $page.props.flash.message }}</p>
                            </div>
                        </div>
                    </div>
                    <PrimaryButton @click="openModal()" class="mb-4">
                        Invite New User
                    </PrimaryButton>
                    <div class="overflow-x-auto">
                        <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
                            <thead class="bg-gray-50 dark:bg-gray-700">
                                <tr>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">No.</th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">User</th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Email</th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Team Id</th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Action</th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200 dark:bg-gray-800 dark:divide-gray-700">
                                <tr v-for="row in data" :key="row.id">
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div v-if="row.profile_photo_path" class="flex-shrink-0 h-10 w-10">
                                            <img class="h-10 w-10 rounded-full" :src="'/storage/images/' + row.profile_photo_path" alt="">
                                        </div>
                                        <div v-else class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 dark:text-gray-400">
                                            {{ row.id }}
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900 dark:text-white">{{ row.name }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 dark:text-gray-400">{{ row.email }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 dark:text-gray-400">{{ row.current_team_id }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                        <button @click="edit(row)" class="text-indigo-600 hover:text-indigo-900 mr-3">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                                                <path d="M13.586 3.586a2 2 0 112.828 2.828l-.793.793-2.828-2.828.793-.793zM11.379 5.793L3 14.172V17h2.828l8.38-8.379-2.83-2.828z" />
                                            </svg>
                                        </button>
                                        <button @click="deleteRow(row)" class="text-red-600 hover:text-red-900">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                                                <path fill-rule="evenodd" d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm5-1a1 1 0 00-1 1v6a1 1 0 102 0V8a1 1 0 00-1-1z" clip-rule="evenodd" />
                                            </svg>
                                        </button>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <Modal :show="isOpen" @close="closeModal">
                        <form>
                            <div class="bg-white dark:bg-gray-800 px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                                <div class="">
                                    <div class="mb-4">
                                        <InputLabel for="name" value="Name" />
                                        <TextInput id="name" v-model="form.name" type="text" class="mt-1 block w-full"
                                            autocomplete="name" />
                                        <InputError :message="$page.props.errors.name" class="mt-2" />
                                    </div>
                                    <div class="mb-4">
                                        <InputLabel for="email" value="Email" />
                                        <TextInput id="email" v-model="form.email" type="email"
                                            class="mt-1 block w-full" autocomplete="email" />
                                        <InputError :message="$page.props.errors.email" class="mt-2" />
                                    </div>
                                </div>
                            </div>
                            <div class="bg-gray-50 dark:bg-gray-700 px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse">
                                <PrimaryButton type="button"
                                    class="inline-flex justify-center w-full rounded-md border border-transparent px-4 py-2 bg-green-600 text-base leading-6 font-medium text-white shadow-sm hover:bg-green-500 focus:outline-none focus:border-green-700 focus:shadow-outline-green transition ease-in-out duration-150 sm:text-sm sm:leading-5"
                                    v-show="!editMode" @click="save(form)">
                                    Invite
                                </PrimaryButton>
                                <PrimaryButton type="button"
                                    class="inline-flex justify-center w-full rounded-md border border-transparent px-4 py-2 bg-green-600 text-base leading-6 font-medium text-white shadow-sm hover:bg-green-500 focus:outline-none focus:border-green-700 focus:shadow-outline-green transition ease-in-out duration-150 sm:text-sm sm:leading-5"
                                    v-show="editMode" @click="update(form)">
                                    Update
                                </PrimaryButton>
                                <SecondaryButton @click="closeModal()" type="button"
                                    class="inline-flex justify-center w-full rounded-md border border-gray-300 px-4 py-2 bg-white dark:bg-gray-800 text-base leading-6 font-medium text-gray-700 dark:text-gray-300 shadow-sm hover:text-gray-500 focus:outline-none focus:border-blue-300 focus:shadow-outline-blue transition ease-in-out duration-150 sm:text-sm sm:leading-5">
                                    Cancel
                                </SecondaryButton>
                            </div>
                        </form>
                    </Modal>
                </div>
            </div>
        </div>
    </AppLayout>
</template>

<script>
export default {
    props: ['data', 'errors'],
    data() {
        return {
            editMode: false,
            isOpen: false,
            form: {
                name: '',
                email: '',
            },
        }
    },
    methods: {
        openModal() {
            this.isOpen = true;
        },
        closeModal() {
            this.isOpen = false;
            this.reset();
            this.editMode = false;
        },
        reset() {
            this.form = {
                name: '',
                email: '',
            }
        },
        edit(data) {
            this.form = { ...data };
            this.editMode = true;
            this.openModal();
        },
        save(data) {
            this.$inertia.post('/users', data, {
                preserveState: true,
                preserveScroll: true,
            });
            this.reset();
            this.closeModal();
        },
        update(data) {
            this.$inertia.put(`/users/${data.id}`, data, {
                preserveState: true,
                preserveScroll: true,
            });
            this.reset();
            this.closeModal();
        },
        deleteRow(data) {
            if (!confirm('Are you sure you want to delete this user?')) return;
            this.$inertia.delete(`/users/${data.id}`, {
                preserveState: true,
                preserveScroll: true,
            });
        },
    }
}
</script>
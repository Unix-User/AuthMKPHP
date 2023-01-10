<script setup>
import AppLayout from '@/Layouts/AppLayout.vue';
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import SecondaryButton from '@/Components/SecondaryButton.vue';
import TextInput from '@/Components/TextInput.vue';
</script>

<template>
    <AppLayout title="Devices">
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Devices
            </h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg px-4 py-4">
                    <div class="bg-teal-100 border-t-4 border-teal-500 rounded-b text-teal-900 px-4 py-3 shadow-md my-3"
                        role="alert" v-if="$page.props.flash.message">
                        <div class="flex">
                            <div>
                                <p class="text-sm">{{ $page.props.flash.message }}</p>
                            </div>
                        </div>
                    </div>
                    <PrimaryButton @click="openModal()">Create New Device</PrimaryButton>
                    <table class="table-fixed w-full">
                        <thead>
                            <tr class="bg-gray-100">
                                <th class="px-4 py-2 w-20">No.</th>
                                <th class="px-4 py-2">name</th>
                                <th class="px-4 py-2">ip</th>
                                <th class="px-4 py-2">user_id</th>
                                <th class="px-4 py-2">ikev2</th>
                                <th class="px-4 py-2">user</th>
                                <th class="px-4 py-2">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr v-for="row in data">
                                <th class="border px-4 py-2">{{ row.id }}</th>
                                <th class="border px-4 py-2">{{ row.name }}</th>
                                <th class="border px-4 py-2">{{ row.ip }}</th>
                                <th class="border px-4 py-2">{{ row.user_id }}</th>
                                <th class="border px-4 py-2">{{ row.ikev2 }}</th>
                                <th class="border px-4 py-2">{{ row.user }}</th>
                                <td class="border px-4 py-2">
                                    <PrimaryButton @click="edit(row)">Edit</PrimaryButton>
                                    <SecondaryButton @click="deleteRow(row)">Delete</SecondaryButton>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                    <div class="fixed z-10 inset-0 overflow-y-auto ease-out duration-400" v-if="isOpen">
                        <div
                            class="flex items-end justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">

                            <div class="fixed inset-0 transition-opacity">
                                <div class="absolute inset-0 bg-gray-500 opacity-75"></div>
                            </div>
                            <!-- This element is to trick the browser into centering the modal contents. -->
                            <span class="hidden sm:inline-block sm:align-middle sm:h-screen"></span>​
                            <div class="inline-block align-bottom bg-white rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full"
                                role="dialog" aria-modal="true" aria-labelledby="modal-headline">
                                <form>
                                    <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                                        <div class="">
                                            <div class="mb-4">
                                                <InputLabel for="name" value="Name" />
                                                <TextInput id="name" v-model="form.name" type="text"
                                                    class="mt-1 block w-full" autocomplete="name" />
                                                <InputError :message="$page.props.errors.name" class="mt-2" />
                                            </div>
                                            <div class="mb-4">
                                                <InputLabel for="ip" value="ip" />
                                                <TextInput id="ip" v-model="form.ip" type="text"
                                                    class="mt-1 block w-full" autocomplete="ip" />
                                                <InputError :message="$page.props.errors.ip" class="mt-2" />
                                            </div>
                                            <div class="mb-4">
                                                <InputLabel for="user_id" value="user_id" />
                                                <TextInput id="user_id" v-model="form.user_id" type="text"
                                                    class="mt-1 block w-full" autocomplete="user_id" />
                                                <InputError :message="$page.props.errors.ip" class="mt-2" />
                                            </div>
                                            <div class="mb-4">
                                                <InputLabel for="ikev2" value="ikev2" />
                                                <TextInput id="ikev2" v-model="form.ikev2" type="checkbox"
                                                    class="mt-1 block w-full" autocomplete="ikev2" />
                                                <InputError :message="$page.props.errors.ikev2" class="mt-2" />
                                            </div>
                                            <div class="mb-4">
                                                <InputLabel for="user" value="user" />
                                                <TextInput id="user" v-model="form.user" type="text"
                                                    class="mt-1 block w-full" autocomplete="user" />
                                                <InputError :message="$page.props.errors.user" class="mt-2" />
                                            </div>
                                            <div class="mb-4">
                                                <InputLabel for="password" value="password" />
                                                <TextInput id="password" v-model="form.user" type="password"
                                                    class="mt-1 block w-full" autocomplete="password" />
                                                <InputError :message="$page.props.errors.password" class="mt-2" />
                                            </div>
                                        </div>
                                    </div>
                                    <div class="bg-gray-50 px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse">
                                        <span class="flex w-full rounded-md shadow-sm sm:ml-3 sm:w-auto">
                                            <button wire:click.prevent="store()" type="button"
                                                class="inline-flex justify-center w-full rounded-md border border-transparent px-4 py-2 bg-green-600 text-base leading-6 font-medium text-white shadow-sm hover:bg-green-500 focus:outline-none focus:border-green-700 focus:shadow-outline-green transition ease-in-out duration-150 sm:text-sm sm:leading-5"
                                                v-show="!editMode" @click="save(form)">
                                                Save
                                            </button>
                                        </span>
                                        <span class="flex w-full rounded-md shadow-sm sm:ml-3 sm:w-auto">
                                            <button wire:click.prevent="store()" type="button"
                                                class="inline-flex justify-center w-full rounded-md border border-transparent px-4 py-2 bg-green-600 text-base leading-6 font-medium text-white shadow-sm hover:bg-green-500 focus:outline-none focus:border-green-700 focus:shadow-outline-green transition ease-in-out duration-150 sm:text-sm sm:leading-5"
                                                v-show="editMode" @click="update(form)">
                                                Update
                                            </button>
                                        </span>
                                        <span class="mt-3 flex w-full rounded-md shadow-sm sm:mt-0 sm:w-auto">

                                            <button @click="closeModal()" type="button"
                                                class="inline-flex justify-center w-full rounded-md border border-gray-300 px-4 py-2 bg-white text-base leading-6 font-medium text-gray-700 shadow-sm hover:text-gray-500 focus:outline-none focus:border-blue-300 focus:shadow-outline-blue transition ease-in-out duration-150 sm:text-sm sm:leading-5">
                                                Cancel
                                            </button>
                                        </span>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
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
                name: null,
                ip: null,
                user_id: null,
                ikev2: null,
                user: null,
                password: null,
            },
        }
    },
    methods: {
        openModal: function () {
            this.isOpen = true;
        },
        closeModal: function () {
            this.isOpen = false;
            this.reset();
            this.editMode = false;
        },
        reset: function () {
            this.form = {
                title: null,
                body: null,
            }
        },
        save: function (data) {
            this.$inertia.post('/devices', data)
            this.reset();
            this.closeModal();
            this.editMode = false;
        },
        edit: function (data) {
            this.form = Object.assign({}, data);
            this.editMode = true;
            this.openModal();
        },
        update: function (data) {
            data._method = 'PUT';
            this.$inertia.post('/devices/' + data.id, data)
            this.reset();
            this.closeModal();
        },
        deleteRow: function (data) {
            if (!confirm('Are you sure want to remove?')) return;
            data._method = 'DELETE';
            this.$inertia.post('/devices/' + data.id, data)
            this.reset();
            this.closeModal();
        }
    }
}
</script>
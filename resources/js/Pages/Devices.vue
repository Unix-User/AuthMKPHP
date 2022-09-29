<script setup>
import AppLayout from '@/Layouts/AppLayout.vue';
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
                    <button @click="openModal()"
                        class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded my-3">Create New
                        Device</button>
                    <table class="table-fixed w-full">
                        <thead>
                            <tr class="bg-gray-100">
                                <th class="px-4 py-2 w-20">No.</th>
                                <th class="px-4 py-2">name</th>
                                <th class="px-4 py-2">ip</th>
                                <th class="px-4 py-2">user_id</th>
                                <th class="px-4 py-2">ikev2</th>
                                <th class="px-4 py-2">user</th>
                                <th class="px-4 py-2">password</th>
                                <th class="px-4 py-2">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr v-for="row in data">
                                <td class="border px-4 py-2">{{ row.id }}</td>
                                <td class="border px-4 py-2">{{ row.name }}</td>
                                <th class="border px-4 py-2">{{ row.ip }}</th>
                                <th class="border px-4 py-2">{{ row.user_id }}</th>
                                <th class="border px-4 py-2">{{ row.ikev2 }}</th>
                                <th class="border px-4 py-2">{{ row.user }}</th>
                                <th class="border px-4 py-2">{{ row.password }}</th>

                                <td class="border px-4 py-2">
                                    <button @click="edit(row)"
                                        class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Edit</button>
                                    <button @click="deleteRow(row)"
                                        class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded">Delete</button>
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
                                                <label for="exampleFormControlInput1"
                                                    class="block text-gray-700 text-sm font-bold mb-2">Name:</label>
                                                <input type="text"
                                                    class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                                                    id="exampleFormControlInput1" placeholder="Enter Name"
                                                    v-model="form.name">
                                                <div v-if="$page.props.errors.name" class="text-red-500">{{
                                                $page.errors.name[0]
                                                }}</div>
                                            </div>
                                            <div class="mb-4">
                                                <label for="exampleFormControlInput3"
                                                    class="block text-gray-700 text-sm font-bold mb-2">ip:</label>
                                                <input type="text"
                                                    class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                                                    id="exampleFormControlInput3" placeholder="Enter ip address"
                                                    v-model="form.ip">
                                                <div v-if="$page.props.errors.ip" class="text-red-500">{{
                                                $page.errors.ip[0]
                                                }}</div>
                                            </div>
                                            <div class="mb-4">
                                                <label for="exampleFormControlInput4"
                                                    class="block text-gray-700 text-sm font-bold mb-2">user_id:</label>
                                                <input type="text"
                                                    class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                                                    id="exampleFormControlInput4" readonly
                                                    v-model="$page.props.user.id">
                                                <div v-if="$page.props.errors.user_id" class="text-red-500">{{
                                                $page.errors.user_id[0]
                                                }}</div>
                                            </div>
                                            <div class="mb-4">
                                                <label for="exampleFormControlInput5"
                                                    class="block text-gray-700 text-sm font-bold mb-2">ikev2:</label>
                                                <input type="checkbox"
                                                    class="shadow appearance-none border rounded py-3 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                                                    id="exampleFormControlInput5"
                                                    v-model="form.ikev2">
                                                <div v-if="$page.props.errors.ikev2" class="text-red-500">{{
                                                $page.errors.ikev2[0]
                                                }}</div>
                                            </div>
                                            <div class="mb-4">
                                                <label for="exampleFormControlInput6"
                                                    class="block text-gray-700 text-sm font-bold mb-2">user:</label>
                                                <input type="text"
                                                    class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                                                    id="exampleFormControlInput6" placeholder="Enter user"
                                                    v-model="form.user">
                                                <div v-if="$page.props.errors.user" class="text-red-500">{{
                                                $page.errors.user[0]
                                                }}</div>
                                            </div>
                                            <div class="mb-4">
                                                <label for="exampleFormControlInput7"
                                                    class="block text-gray-700 text-sm font-bold mb-2">password:</label>
                                                <input type="text"
                                                    class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                                                    id="exampleFormControlInput7" placeholder="Enter password"
                                                    v-model="form.password">
                                                <div v-if="$page.props.errors.password" class="text-red-500">{{
                                                $page.errors.password[0]
                                                }}</div>
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
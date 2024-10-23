<script setup>
import ApplicationLogo from '@/Components/ApplicationLogo.vue';
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import SecondaryButton from '@/Components/SecondaryButton.vue';
import TextInput from '@/Components/TextInput.vue';
</script>

<template>
    <div>
        <div class="p-6 lg:p-8 bg-white dark:bg-gray-800 dark:bg-gradient-to-bl dark:from-gray-700/50 dark:via-transparent border-b border-gray-200 dark:border-gray-700">
            <ApplicationLogo class="block h-12 w-auto" />

            <h1 class="mt-8 text-2xl font-medium text-gray-900 dark:text-white">
                Welcome to your Devices Management!
            </h1>

            <p class="mt-6 text-gray-500 dark:text-gray-400 leading-relaxed">
                This page allows you to manage your devices. You can add, edit, and delete devices as needed. The table below shows all your current devices and their details. Use the buttons to perform actions on each device. We've designed this interface to be intuitive and powerful, allowing you to efficiently manage your network infrastructure.
            </p>
        </div>

        <div class="bg-gray-200 dark:bg-gray-800 bg-opacity-25 grid grid-cols-1 md:grid-cols-2 gap-6 lg:gap-8 p-6 lg:p-8">
            <div>
                <div class="flex items-center">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" class="w-6 h-6 stroke-gray-400">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 6.042A8.967 8.967 0 006 3.75c-1.052 0-2.062.18-3 .512v14.25A8.987 8.987 0 016 18c2.305 0 4.408.867 6 2.292m0-14.25a8.966 8.966 0 016-2.292c1.052 0 2.062.18 3 .512v14.25A8.987 8.987 0 0018 18a8.967 8.967 0 00-6 2.292m0-14.25v14.25" />
                    </svg>
                    <h2 class="ms-3 text-xl font-semibold text-gray-900 dark:text-white">
                        Device Management
                    </h2>
                </div>

                <p class="mt-4 text-gray-500 dark:text-gray-400 text-sm leading-relaxed">
                    Here you can manage all your devices. Click on 'Create New Device' to add a new device, or use the 'Edit' and 'Delete' buttons to modify existing devices. Our system provides a comprehensive view of your network infrastructure.
                </p>

                <p class="mt-4 text-sm">
                    <PrimaryButton @click="openModal()" class="inline-flex items-center font-semibold text-indigo-700 dark:text-indigo-300">
                        Create New Device

                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" class="ms-1 w-5 h-5 fill-indigo-500 dark:fill-indigo-200">
                            <path fill-rule="evenodd" d="M5 10a.75.75 0 01.75-.75h6.638L10.23 7.29a.75.75 0 111.04-1.08l3.5 3.25a.75.75 0 010 1.08l-3.5 3.25a.75.75 0 11-1.04-1.08l2.158-1.96H5.75A.75.75 0 015 10z" clip-rule="evenodd" />
                        </svg>
                    </PrimaryButton>
                </p>
            </div>

            <div>
                <div class="flex items-center">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" class="w-6 h-6 stroke-gray-400">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 15.75l5.159-5.159a2.25 2.25 0 013.182 0l5.159 5.159m-1.5-1.5l1.409-1.409a2.25 2.25 0 013.182 0l2.909 2.909m-18 3.75h16.5a1.5 1.5 0 001.5-1.5V6a1.5 1.5 0 00-1.5-1.5H3.75A1.5 1.5 0 002.25 6v12a1.5 1.5 0 001.5 1.5zm10.5-11.25h.008v.008h-.008V8.25zm.375 0a.375.375 0 11-.75 0 .375.375 0 01.75 0z" />
                    </svg>
                    <h2 class="ms-3 text-xl font-semibold text-gray-900 dark:text-white">
                        Device Overview
                    </h2>
                </div>

                <p class="mt-4 text-gray-500 dark:text-gray-400 text-sm leading-relaxed">
                    Below is a comprehensive list of all your devices. You can view details such as device name, IP address, team ID, IKEv2 status, and associated user. Use the action buttons to edit or delete each device as needed.
                </p>

                <div class="mt-4">
                    <table class="table-fixed w-full">
                        <thead>
                            <tr class="bg-gray-100 dark:bg-gray-700">
                                <th class="px-4 py-2 w-20 text-gray-600 dark:text-gray-200">No.</th>
                                <th class="px-4 py-2 text-gray-600 dark:text-gray-200">Name</th>
                                <th class="px-4 py-2 text-gray-600 dark:text-gray-200">IP</th>
                                <th class="px-4 py-2 text-gray-600 dark:text-gray-200">Team ID</th>
                                <th class="px-4 py-2 text-gray-600 dark:text-gray-200">IKEv2</th>
                                <th class="px-4 py-2 text-gray-600 dark:text-gray-200">User</th>
                                <th class="px-4 py-2 text-gray-600 dark:text-gray-200">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr v-for="row in devicesData" :key="row.id" class="bg-white dark:bg-gray-800">
                                <td class="border px-4 py-2 text-gray-600 dark:text-gray-200">{{ row.id }}</td>
                                <td class="border px-4 py-2 text-gray-600 dark:text-gray-200">{{ row.name }}</td>
                                <td class="border px-4 py-2 text-gray-600 dark:text-gray-200">{{ row.ip }}</td>
                                <td class="border px-4 py-2 text-gray-600 dark:text-gray-200">{{ row.team_id }}</td>
                                <td class="border px-4 py-2 text-gray-600 dark:text-gray-200">{{ row.ikev2 }}</td>
                                <td class="border px-4 py-2 text-gray-600 dark:text-gray-200">{{ row.user }}</td>
                                <td class="border px-4 py-2">
                                    <PrimaryButton @click="edit(row)" class="mr-2">Edit</PrimaryButton>
                                    <SecondaryButton @click="deleteRow(row)">Delete</SecondaryButton>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal for creating/editing devices -->
    <div class="fixed z-10 inset-0 overflow-y-auto ease-out duration-400" v-if="isOpen">
        <!-- ... (rest of the modal code remains unchanged) ... -->
    </div>
</template>

<script>
export default {
    props: {
        devicesData: {
            type: Array,
            required: true
        },
        errors: {
            type: Object,
            required: false
        }
    },
    data() {
        return {
            editMode: false,
            isOpen: false,
            form: {
                name: null,
                ip: null,
                team_id: null,
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
                name: null,
                ip: null,
                team_id: null,
                ikev2: null,
                user: null,
                password: null,
            }
        },
        save: function (data) {
            this.$emit('save', data);
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
            this.$emit('update', data);
            this.reset();
            this.closeModal();
        },
        deleteRow: function (data) {
            if (!confirm('Are you sure want to remove?')) return;
            this.$emit('delete', data);
            this.reset();
            this.closeModal();
        }
    }
}
</script>
<script setup>
import AppLayout from '@/Layouts/AppLayout.vue';
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import Modal from '@/Components/Modal.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import SecondaryButton from '@/Components/SecondaryButton.vue';
import TextInput from '@/Components/TextInput.vue';
import DevicesTable from '@/Components/DevicesTable.vue';
import { ref, onMounted } from 'vue';
import axios from 'axios';
import DeviceData from '@/Components/DeviceData.vue';

const isLoading = ref(true);
const data = ref([]);
const isOpen = ref(false);
const listOpen = ref(false);
const form = ref({
    name: '',
    ip: '',
    team_id: '',
    ikev2: '',
    user: '',
    password: '',
});
const editMode = ref(false);
const viewMode = ref(false);
const listMode = ref(false);
const selectedDeviceId = ref(null);

const fetchData = async () => {
    isLoading.value = true;
    try {
        const response = await axios.get('/device');
        data.value = response.data.data;
    } catch (error) {
        console.error('Error fetching data:', error);
    } finally {
        isLoading.value = false;
    }
};

const syncData = async () => {

}

onMounted(fetchData);

const openModal = () => {
    isOpen.value = true;
};

const openListModal = () => {
    listOpen.value = true;
};

const closeModal = () => {
    isOpen.value = false;
    resetForm();
};

const closeListModal = () => {
    listOpen.value = false;
};

const resetForm = () => {
    form.value = {
        name: '',
        ip: '',
        team_id: '',
        ikev2: '',
        user: '',
        password: '',
    };
    editMode.value = false;
    viewMode.value = false;
    listMode.value = false;
};

const handleDevice = async (method) => {
    const formData = new FormData();
    for (const key in form.value) {
        formData.append(key, form.value[key]);
    }
    if (method === 'PUT') {
        formData.append('_method', 'PUT');
    }

    try {
        await axios.post(`/device${method === 'PUT' ? '/' + form.value.id : ''}`, formData, {
            headers: { 'Content-Type': 'multipart/form-data' },
        });
        await fetchData();
        closeModal();
    } catch (error) {
        console.error(`Error ${method === 'PUT' ? 'updating' : 'saving'} device:`, error);
    }
};

const edit = (device) => {
    form.value = { ...device };
    editMode.value = true;
    openModal();
};

const view = (device) => {
    form.value = { ...device };
    viewMode.value = true;
    openModal();
};

const list = (device) => {
    form.value = { ...device };
    selectedDeviceId.value = device.id;
    listMode.value = true;
    openListModal();
};

const deleteRow = async (device) => {
    if (!confirm('Are you sure you want to delete this device?')) return;
    try {
        await axios.delete(`/device/${device.id}`);
        await fetchData();
    } catch (error) {
        console.error("Error deleting device:", error);
    }
};

</script>

<template>
    <AppLayout title="Devices">
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                Devices
            </h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-xl sm:rounded-lg">
                    <div
                        class="p-6 lg:p-8 bg-white dark:bg-gray-800 dark:bg-gradient-to-bl dark:from-gray-700/50 dark:via-transparent border-b border-gray-200 dark:border-gray-700">
                        <h1 class="text-2xl font-medium text-gray-900 dark:text-white">
                            Device Management
                        </h1>

                        <p class="mt-6 text-gray-500 dark:text-gray-400 leading-relaxed">
                            Here you can manage the devices in the system. You can add new devices, edit existing
                            information,
                            or remove devices.
                        </p>
                    </div>

                    <div
                        class="bg-gray-200 dark:bg-gray-800 bg-opacity-25 p-6 lg:p-8 space-y-6 md:space-y-0 md:grid md:grid-cols-2 md:gap-6 lg:gap-8">
                        <div>
                            <div class="flex items-center">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                    stroke-width="1.5" class="w-6 h-6 stroke-gray-400">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M20.25 7.5l-.625 10.632a2.25 2.25 0 01-2.247 2.118H6.622a2.25 2.25 0 01-2.247-2.118L3.75 7.5m8.25 3v6.75m0 0l-3-3m3 3l3-3M3.375 7.5h17.25c.621 0 1.125-.504 1.125-1.125v-1.5c0-.621-.504-1.125-1.125-1.125H3.375c-.621 0-1.125.504-1.125 1.125v1.5c0 .621.504 1.125 1.125 1.125z" />
                                </svg>
                                <h2 class="ml-3 text-xl font-semibold text-gray-900 dark:text-white">
                                    <a href="#">Add New Device</a>
                                </h2>
                            </div>

                            <p class="mt-4 text-gray-500 dark:text-gray-400 text-sm leading-relaxed">
                                Click the button below to add a new device to the system.
                            </p>

                            <p class="mt-4 text-sm">
                                <PrimaryButton @click="openModal()" class="mb-4">
                                    Add New Device
                                </PrimaryButton>
                            </p>
                        </div>

                        <div>
                            <div class="flex items-center">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                    stroke-width="1.5" class="w-6 h-6 stroke-gray-400">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M2.25 13.5h3.86a2.25 2.25 0 012.012 1.244l.256.512a2.25 2.25 0 002.013 1.244h3.218a2.25 2.25 0 002.013-1.244l.256-.512a2.25 2.25 0 012.013-1.244h3.859m-19.5.338V18a2.25 2.25 0 002.25 2.25h15A2.25 2.25 0 0021.75 18v-4.162c0-.224-.034-.447-.1-.661L19.24 5.338a2.25 2.25 0 00-2.15-1.588H6.911a2.25 2.25 0 00-2.15 1.588L2.35 13.177a2.25 2.25 0 00-.1.661z" />
                                </svg>
                                <h2 class="ml-3 text-xl font-semibold text-gray-900 dark:text-white">
                                    <a href="#">Device List</a>
                                </h2>
                            </div>

                            <p class="mt-4 text-gray-500 dark:text-gray-400 text-sm leading-relaxed">
                                Below is the list of all devices currently in the system.
                            </p>
                        </div>
                    </div>

                    <div
                        class="p-6 lg:p-8 bg-white dark:bg-gray-800 dark:bg-gradient-to-bl dark:from-gray-700/50 dark:via-transparent border-b border-gray-200 dark:border-gray-700">
                        <div v-if="isLoading" class="text-center mt-12">
                            <p>Loading...</p>
                        </div>
                        <div v-else-if="data && data.length > 0">
                            <DevicesTable :devicesData="data" @edit="edit" @view="view" @delete="deleteRow"
                                @list="list" @sync="sync" />
                        </div>
                        <div v-else class="text-center mt-12">
                            <p>No devices found.</p>
                        </div>
                    </div>

                    <Modal :show="listOpen" @close="closeListModal">
                        <DeviceData :deviceId="selectedDeviceId" />
                    </Modal>

                    <Modal :show="isOpen" @close="closeModal">
                        <form enctype="multipart/form-data">
                            <div class="bg-white dark:bg-gray-800 px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                                <div class="">
                                    <div class="mb-4">
                                        <InputLabel for="name" value="Name" />
                                        <TextInput id="name" v-model="form.name" type="text" class="mt-1 block w-full"
                                            :disabled="viewMode" autocomplete="name" />
                                        <InputError :message="$page.props.errors.name" class="mt-2" />
                                    </div>
                                    <div class="mb-4">
                                        <InputLabel for="ip" value="IP Address" />
                                        <TextInput id="ip" v-model="form.ip" type="text" :disabled="viewMode"
                                            class="mt-1 block w-full" autocomplete="ip" />
                                        <InputError :message="$page.props.errors.ip" class="mt-2" />
                                    </div>
                                    <div class="mb-4">
                                        <InputLabel for="team_id" value="Team ID" />
                                        <TextInput id="team_id" v-model="form.team_id" type="text" :disabled="viewMode"
                                            class="mt-1 block w-full" autocomplete="team_id" />
                                        <InputError :message="$page.props.errors.team_id" class="mt-2" />
                                    </div>
                                    <div class="mb-4">
                                        <InputLabel for="ikev2" value="IKEv2" />
                                        <TextInput id="ikev2" v-model="form.ikev2" type="text" :disabled="viewMode"
                                            class="mt-1 block w-full" autocomplete="ikev2" />
                                        <InputError :message="$page.props.errors.ikev2" class="mt-2" />
                                    </div>
                                    <div class="mb-4">
                                        <InputLabel for="user" value="User" />
                                        <TextInput id="user" v-model="form.user" type="text" :disabled="viewMode"
                                            class="mt-1 block w-full" autocomplete="user" />
                                        <InputError :message="$page.props.errors.user" class="mt-2" />
                                    </div>
                                    <div class="mb-4">
                                        <InputLabel for="password" value="Password" />
                                        <TextInput id="password" v-model="form.password" type="password"
                                            :disabled="viewMode" class="mt-1 block w-full" autocomplete="password" />
                                        <InputError :message="$page.props.errors.password" class="mt-2" />
                                    </div>
                                </div>
                            </div>
                            <div class="bg-gray-50 dark:bg-gray-700 px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse">
                                <PrimaryButton type="button"
                                    class="inline-flex justify-center w-full rounded-md border border-transparent px-4 py-2 bg-green-600 text-base leading-6 font-medium text-white shadow-sm hover:bg-green-500 focus:outline-none focus:border-green-700 focus:shadow-outline-green transition ease-in-out duration-150 sm:text-sm sm:leading-5"
                                    v-show="!editMode && !viewMode" @click="handleDevice('POST')">
                                    Save
                                </PrimaryButton>
                                <PrimaryButton type="button"
                                    class="inline-flex justify-center w-full rounded-md border border-transparent px-4 py-2 bg-green-600 text-base leading-6 font-medium text-white shadow-sm hover:bg-green-500 focus:outline-none focus:border-green-700 focus:shadow-outline-green transition ease-in-out duration-150 sm:text-sm sm:leading-5"
                                    v-show="editMode" @click="handleDevice('PUT')">
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
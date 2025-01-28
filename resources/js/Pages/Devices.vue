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
        console.error('Erro ao buscar dados:', error);
    } finally {
        isLoading.value = false;
    }
};

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
        console.error(`Erro ao ${method === 'PUT' ? 'atualizar' : 'salvar'} dispositivo:`, error);
    }
};

const edit = (device) => {
    form.value = { ...device };
    editMode.value = true;
    openModal();
};

const sync = async (device) => {
    try {
        await axios.get(`/device/${device.id}`);
        await fetchData(); // Refresh the device list after sync
    } catch (error) {
        console.error("Erro ao sincronizar dispositivo:", error);
    }
};

const list = (device) => {
    form.value = { ...device };
    selectedDeviceId.value = device.id;
    listMode.value = true;
    openListModal();
};

const deleteRow = async (device) => {
    if (!confirm('Tem certeza que deseja deletar este dispositivo?')) return;
    try {
        await axios.delete(`/device/${device.id}`);
        await fetchData();
    } catch (error) {
        console.error("Erro ao deletar dispositivo:", error);
    }
};

</script>

<template>
    <AppLayout title="Dispositivos">
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                Dispositivos
            </h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-xl sm:rounded-lg">
                    <div
                        class="p-6 lg:p-8 bg-white dark:bg-gray-800 dark:bg-gradient-to-bl dark:from-gray-700/50 dark:via-transparent border-b border-gray-200 dark:border-gray-700">
                        <h1 class="text-2xl font-medium text-gray-900 dark:text-white">
                            Gerenciamento de Dispositivos
                        </h1>

                        <p class="mt-6 text-gray-500 dark:text-gray-400 leading-relaxed">
                            Aqui você pode gerenciar os dispositivos no sistema. Você pode adicionar novos dispositivos,
                            editar
                            informações existentes ou remover dispositivos.
                        </p>
                    </div>

                    <div
                        class="bg-gray-200 dark:bg-gray-800 bg-opacity-25 p-6 lg:p-8 space-y-6 md:space-y-0 md:grid md:grid-cols-2 md:gap-6 lg:gap-8">
                        <div>
                            <div class="flex items-center">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="#809090" viewBox="0 0 512 512"
                                    stroke-width="1.5" class="w-6 h-6 stroke-gray-400">
                                    <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                                    <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g>
                                    <g id="SVGRepo_iconCarrier">
                                        <g>
                                            <g>
                                                <path
                                                    d="m163.3,87c51.1-49.6 134.4-49.7 185.5,0 11.3,11 24.9,3.7 28.9-0.5 7.9-8.1 7.6-21-0.4-28.9-66.9-64.6-175.6-64.6-242.5,0.1-8.1,7.9-8.3,20.8-0.4,28.9 7.8,8.1 20.8,8.3 28.9,0.4z">
                                                </path>
                                                <path
                                                    d="m180.3,123.6c-8.1,7.9-8.3,20.8-0.4,28.9 7.8,8.1 20.8,8.3 28.9,0.5 26-25.3 67.9-24.7 94.5,0 11.4,10.6 24.9,3.7 28.9-0.5 7.9-8.1 7.6-21-0.4-28.9-41.9-40.4-109.7-40.4-151.5,0z">
                                                </path>
                                            </g>
                                            <path
                                                d="m399.6,255.8h-123.2v-41c0-11.3-9.1-20.4-20.4-20.4-11.3,0-20.4,9.1-20.4,20.4v41h-123.2c-55.9,0-101.4,45.5-101.4,101.6 0,55.3 44.5,100.4 99.5,101.4v21.8c0,11.3 9.1,20.4 20.4,20.4 11.3,0 20.4-9.1 20.4-20.4v-21.8h209.3v21.8c0,11.3 9.1,20.4 20.4,20.4 11.3,0 20.4-9.1 20.4-20.4v-21.8c55.1-1 99.5-46.1 99.5-101.6 0.1-55.9-45.4-101.4-101.3-101.4zm0,162.2h-287.2c-33.4,0-60.6-27.2-60.6-60.8 0-33.4 27.2-60.6 60.6-60.6h287.2c33.4,0 60.6,27.2 60.6,60.8-5.68434e-14,33.4-27.2,60.6-60.6,60.6z">
                                            </path>
                                        </g>
                                    </g>
                                </svg>
                                <h2 class="ml-3 text-xl font-semibold text-gray-900 dark:text-white">
                                    <a href="#">Adicionar Novo Dispositivo</a>
                                </h2>
                            </div>

                            <p class="mt-4 text-gray-500 dark:text-gray-400 text-sm leading-relaxed">
                                Clique no botão abaixo para adicionar um novo dispositivo ao sistema.
                            </p>

                            <p class="mt-4 text-sm">
                                <PrimaryButton @click="openModal()" class="mb-4">
                                    Adicionar Novo Dispositivo
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
                                    <a href="#">Lista de Dispositivos</a>
                                </h2>
                            </div>

                            <p class="mt-4 text-gray-500 dark:text-gray-400 text-sm leading-relaxed">
                                Abaixo está a lista de todos os dispositivos atualmente no sistema.
                            </p>
                        </div>
                    </div>

                    <div
                        class="p-6 lg:p-8 bg-white dark:bg-gray-800 dark:bg-gradient-to-bl dark:from-gray-700/50 dark:via-transparent border-b border-gray-200 dark:border-gray-700">
                        <div v-if="isLoading" class="text-center mt-12">
                            <p>Carregando...</p>
                        </div>
                        <div v-else-if="data && data.length > 0">
                            <DevicesTable :devicesData="data" @edit="edit" @delete="deleteRow" @list="list"
                                @sync="sync" />
                        </div>
                        <div v-else class="text-center mt-12">
                            <p>Nenhum dispositivo encontrado.</p>
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
                                        <InputLabel for="name" value="Nome" />
                                        <TextInput id="name" v-model="form.name" type="text" class="mt-1 block w-full"
                                            :disabled="viewMode" autocomplete="name" />
                                        <InputError :message="$page.props.errors.name" class="mt-2" />
                                    </div>
                                    <div class="mb-4">
                                        <InputLabel for="ip" value="Endereço IP" />
                                        <TextInput id="ip" v-model="form.ip" type="text" :disabled="viewMode"
                                            class="mt-1 block w-full" autocomplete="ip" />
                                        <InputError :message="$page.props.errors.ip" class="mt-2" />
                                    </div>
                                    <div class="mb-4">
                                        <InputLabel for="team_id" value="ID da Equipe" />
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
                                        <InputLabel for="user" value="Usuário" />
                                        <TextInput id="user" v-model="form.user" type="text" :disabled="viewMode"
                                            class="mt-1 block w-full" autocomplete="user" />
                                        <InputError :message="$page.props.errors.user" class="mt-2" />
                                    </div>
                                    <div class="mb-4">
                                        <InputLabel for="password" value="Senha" />
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
                                    Salvar
                                </PrimaryButton>
                                <PrimaryButton type="button"
                                    class="inline-flex justify-center w-full rounded-md border border-transparent px-4 py-2 bg-green-600 text-base leading-6 font-medium text-white shadow-sm hover:bg-green-500 focus:outline-none focus:border-green-700 focus:shadow-outline-green transition ease-in-out duration-150 sm:text-sm sm:leading-5"
                                    v-show="editMode" @click="handleDevice('PUT')">
                                    Atualizar
                                </PrimaryButton>
                                <SecondaryButton @click="closeModal()" type="button"
                                    class="inline-flex justify-center w-full rounded-md border border-gray-300 px-4 py-2 bg-white dark:bg-gray-800 text-base leading-6 font-medium text-gray-700 dark:text-gray-300 shadow-sm hover:text-gray-500 focus:outline-none focus:border-blue-300 focus:shadow-outline-blue transition ease-in-out duration-150 sm:text-sm sm:leading-5">
                                    Cancelar
                                </SecondaryButton>
                            </div>
                        </form>
                    </Modal>
                </div>
            </div>
        </div>
    </AppLayout>
</template>
<script setup>
import AppLayout from '@/Layouts/AppLayout.vue';
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import Modal from '@/Components/Modal.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import SecondaryButton from '@/Components/SecondaryButton.vue';
import TextInput from '@/Components/TextInput.vue';
import ProductsTable from '@/Components/ProductsTable.vue';
</script>

<template>
    <AppLayout title="Produtos">
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                Produtos
            </h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-xl sm:rounded-lg">
                    <div class="p-6 lg:p-8 bg-white dark:bg-gray-800 dark:bg-gradient-to-bl dark:from-gray-700/50 dark:via-transparent border-b border-gray-200 dark:border-gray-700">
                        <h1 class="text-2xl font-medium text-gray-900 dark:text-white">
                            Gerenciamento de Produtos
                        </h1>

                        <p class="mt-6 text-gray-500 dark:text-gray-400 leading-relaxed">
                            Aqui você pode gerenciar os produtos no sistema. Você pode adicionar novos produtos, editar informações existentes ou remover produtos.
                        </p>
                    </div>

                    <div class="bg-gray-200 dark:bg-gray-800 bg-opacity-25 grid grid-cols-1 md:grid-cols-2 gap-6 lg:gap-8 p-6 lg:p-8">
                        <div>
                            <div class="flex items-center">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" class="w-6 h-6 stroke-gray-400">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M20.25 7.5l-.625 10.632a2.25 2.25 0 01-2.247 2.118H6.622a2.25 2.25 0 01-2.247-2.118L3.75 7.5m8.25 3v6.75m0 0l-3-3m3 3l3-3M3.375 7.5h17.25c.621 0 1.125-.504 1.125-1.125v-1.5c0-.621-.504-.125-1.125-1.125H3.375c-.621 0-1.125.504-1.125 1.125v1.5c0 .621.504 1.125 1.125 1.125z" />
                                </svg>
                                <h2 class="ml-3 text-xl font-semibold text-gray-900 dark:text-white">
                                    <a href="#">Adicionar Novo Produto</a>
                                </h2>
                            </div>

                            <p class="mt-4 text-gray-500 dark:text-gray-400 text-sm leading-relaxed">
                                Clique no botão abaixo para adicionar um novo produto ao sistema.
                            </p>

                            <p class="mt-4 text-sm">
                                <PrimaryButton @click="openModal()" class="mb-4">
                                    Adicionar Novo Produto
                                </PrimaryButton>
                            </p>
                        </div>

                        <div>
                            <div class="flex items-center">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" class="w-6 h-6 stroke-gray-400">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 13.5h3.86a2.25 2.25 0 012.012 1.244l.256.512a2.25 2.25 0 002.013 1.244h3.218a2.25 2.25 0 002.013-1.244l.256-.512a2.25 2.25 0 012.013-1.244h3.859m-19.5.338V18a2.25 2.25 0 002.25 2.25h15A2.25 2.25 0 0021.75 18v-4.162c0-.224-.034-.447-.1-.661L19.24 5.338a2.25 2.25 0 00-2.15-1.588H6.911a2.25 2.25 0 00-2.15 1.588L2.35 13.177a2.25 2.25 0 00-.1.661z" />
                                </svg>
                                <h2 class="ml-3 text-xl font-semibold text-gray-900 dark:text-white">
                                    <a href="#">Lista de Produtos</a>
                                </h2>
                            </div>

                            <p class="mt-4 text-gray-500 dark:text-gray-400 text-sm leading-relaxed">
                                Abaixo está a lista de todos os produtos atualmente no sistema.
                            </p>
                        </div>
                    </div>

                    <div class="p-6 lg:p-8 bg-white dark:bg-gray-800 dark:bg-gradient-to-bl dark:from-gray-700/50 dark:via-transparent border-b border-gray-200 dark:border-gray-700">
                        <ProductsTable :data="data" @edit="edit" @delete="deleteRow" />
                    </div>

                    <Modal :show="isOpen" @close="closeModal">
                        <form enctype="multipart/form-data">
                            <div class="bg-white dark:bg-gray-800 px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                                <div class="">
                                    <div class="mb-4">
                                        <InputLabel for="name" value="Nome" />
                                        <TextInput id="name" v-model="form.name" type="text" class="mt-1 block w-full"
                                            autocomplete="name" />
                                        <InputError :message="$page.props.errors.name" class="mt-2" />
                                    </div>
                                    <div class="mb-4">
                                        <InputLabel for="description" value="Descrição" />
                                        <TextInput id="description" v-model="form.description" type="text"
                                            class="mt-1 block w-full" autocomplete="description" />
                                        <InputError :message="$page.props.errors.description" class="mt-2" />
                                    </div>
                                    <div class="mb-4">
                                        <InputLabel for="price" value="Preço" />
                                        <TextInput id="price" v-model="form.price" type="number"
                                            class="mt-1 block w-full" autocomplete="price" />
                                        <InputError :message="$page.props.errors.price" class="mt-2" />
                                    </div>
                                    <div class="mb-4">
                                        <InputLabel for="rate" value="Taxa" />
                                        <TextInput id="rate" v-model="form.rate" type="number"
                                            class="mt-1 block w-full" autocomplete="rate" />
                                        <InputError :message="$page.props.errors.rate" class="mt-2" />
                                    </div>
                                    <div class="mb-4">
                                        <InputLabel for="tags" value="Tags" />
                                        <TextInput id="tags" v-model="form.tags" type="text" class="mt-1 block w-full"
                                            autocomplete="tags" />
                                        <InputError :message="$page.props.errors.tags" class="mt-2" />
                                    </div>
                                    <div class="mb-4">
                                        <InputLabel for="image" value="Imagem" />
                                        <div v-if="!form.image" class="col-span-6 sm:col-span-4">
                                            <input ref="imageInput" type="file" class="hidden"
                                                @change="updateImagePreview">
                                            <div v-if="imagePreview" class="mt-2">
                                                <img :src="imagePreview" class="rounded-full h-20 w-20 object-cover">
                                            </div>
                                        </div>
                                        <div v-if="imagePreview" class="mt-2">
                                            <img :src="imagePreview" class="rounded-full h-20 w-20 object-cover">
                                        </div>
                                        <div v-else class="mt-2">
                                            <span class="block rounded-full w-20 h-20 bg-cover bg-no-repeat bg-center"
                                                :style="'background-image: url(\'storage/images/' + form.image + '\');'" />
                                        </div>
                                        <SecondaryButton class="mt-2 mr-2" type="button"
                                            @click.prevent="selectNewImage">Selecionar uma Nova Imagem</SecondaryButton>
                                        <SecondaryButton type="button" class="mt-2" @click.prevent="deleteImage">
                                            Remover Imagem</SecondaryButton>
                                        <InputError :message="$page.props.errors.image" class="mt-2" />
                                    </div>
                                </div>
                            </div>
                            <div class="bg-gray-50 dark:bg-gray-700 px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse">
                                <PrimaryButton type="button"
                                    class="inline-flex justify-center w-full rounded-md border border-transparent px-4 py-2 bg-green-600 text-base leading-6 font-medium text-white shadow-sm hover:bg-green-500 focus:outline-none focus:border-green-700 focus:shadow-outline-green transition ease-in-out duration-150 sm:text-sm sm:leading-5"
                                    v-show="!editMode" @click="save(form)">
                                    Salvar
                                </PrimaryButton>
                                <PrimaryButton type="button"
                                    class="inline-flex justify-center w-full rounded-md border border-transparent px-4 py-2 bg-green-600 text-base leading-6 font-medium text-white shadow-sm hover:bg-green-500 focus:outline-none focus:border-green-700 focus:shadow-outline-green transition ease-in-out duration-150 sm:text-sm sm:leading-5"
                                    v-show="editMode" @click="update(form)">
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

<script>
export default {
    props: ['data', 'errors'],
    data() {
        return {
            editMode: false,
            isOpen: false,
            form: {
                name: '',
                price: 0,
                rate: 0, // Taxa adicionada aqui
                description: '',
                team_id: '',
                image: null,
                tags: '',
                files: []
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
            this.deleteImage();
            this.editMode = false;
        },
        reset() {
            this.form = {
                name: '',
                price: 0,
                rate: '',
                description: '',
                team_id: '',
                image: null,
                tags: '',
                files: []
            }
        },
        edit(data) {
            this.form = { ...data };
            this.editMode = true;
            this.openModal();
        },
        dataURItoBlob(dataURI) {
            var byteString = atob(dataURI.split(',')[1]);
            var ab = new ArrayBuffer(byteString.length);
            var ia = new Uint8Array(ab);
            for (var i = 0; i < byteString.length; i++) {
                ia[i] = byteString.charCodeAt(i);
            }
            return new Blob([ab], { type: 'image/jpeg' });
        },
        save(data) {
            const formData = new FormData();
            formData.append('name', data.name);
            formData.append('description', data.description);
            formData.append('price', data.price);
            formData.append('rate', data.rate);
            formData.append('tags', data.tags);
            const imageBlob = this.dataURItoBlob(this.imagePreview);
            formData.append('image', imageBlob, 'image.jpg');
            this.$inertia.post('/products', formData, {
                headers: { 'Content-Type': 'multipart/form-data' },
                preserveState: true,
                preserveScroll: true,
            })
            this.reset();
            this.closeModal();
            this.editMode = false;
        },
        update(data) {
            const formData = new FormData();
            formData.append('_method', 'PUT');
            formData.append('id', data.id);
            formData.append('name', data.name);
            formData.append('description', data.description);
            formData.append('price', data.price);
            formData.append('rate', data.rate);
            formData.append('tags', data.tags);
            const imageBlob = this.dataURItoBlob(this.imagePreview);
            formData.append('image', imageBlob, 'image.jpg');
            this.$inertia.post('/products/' + data.id, formData, {
                headers: { 'Content-Type': 'multipart/form-data' },
                preserveState: true,
                preserveScroll: true,
            })
            this.reset();
            this.closeModal();
        },
        deleteRow(data) {
            if (!confirm('Tem certeza que deseja excluir este produto?')) return;
            this.$inertia.delete(`/products/${data.id}`, {
                preserveState: true,
                preserveScroll: true,
            });
        },
        updateImagePreview() {
            try {
                const reader = new FileReader();
                reader.addEventListener('load', () => {
                    this.imagePreview = reader.result;
                    this.form.image = reader.result;
                });
                reader.readAsDataURL(this.$refs.imageInput.files[0]);
            } catch (error) {
                console.error(`Ocorreu um erro ao ler o arquivo de imagem: ${error}`);
            }
        },
        selectNewImage() {
            this.imagePreview = null;
            try {
                if (this.$refs.imageInput && typeof this.$refs.imageInput.click === 'function') {
                    this.$refs.imageInput.click();
                } else {
                    console.error(`O elemento de entrada de imagem não está disponível`);
                }
            } catch (error) {
                console.error(`Ocorreu um erro ao selecionar a imagem: ${error}`);
            }
        },
        deleteImage() {
            this.form.image = null;
            this.imagePreview = null
            if (this.$refs.imageInput) {
                this.$refs.imageInput.value = null;
            }
        }
    }
}
</script>
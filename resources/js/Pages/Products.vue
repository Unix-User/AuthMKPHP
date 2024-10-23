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
    <AppLayout title="Products">
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                Products
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
                        Create New Product
                    </PrimaryButton>
                    <div class="overflow-x-auto">
                        <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
                            <thead class="bg-gray-50 dark:bg-gray-700">
                                <tr>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">No.</th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Name</th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Description</th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Image</th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Price</th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Tags</th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Action</th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200 dark:bg-gray-800 dark:divide-gray-700">
                                <tr v-for="row in data" :key="row.id">
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 dark:text-gray-400">{{ row.id }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900 dark:text-white">{{ row.name }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 dark:text-gray-400">{{ row.description }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 dark:text-gray-400">
                                        <img v-if="row.image" :src="'/storage/images/' + row.image" alt="Product Image" class="h-10 w-10 rounded-full">
                                        <span v-else>No Image</span>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 dark:text-gray-400">{{ row.price }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 dark:text-gray-400">{{ row.tags }}</td>
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
                        <form enctype="multipart/form-data">
                            <div class="bg-white dark:bg-gray-800 px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                                <div class="">
                                    <div class="mb-4">
                                        <InputLabel for="name" value="Name" />
                                        <TextInput id="name" v-model="form.name" type="text" class="mt-1 block w-full"
                                            autocomplete="name" />
                                        <InputError :message="$page.props.errors.name" class="mt-2" />
                                    </div>
                                    <div class="mb-4">
                                        <InputLabel for="description" value="Description" />
                                        <TextInput id="description" v-model="form.description" type="text"
                                            class="mt-1 block w-full" autocomplete="description" />
                                        <InputError :message="$page.props.errors.description" class="mt-2" />
                                    </div>
                                    <div class="mb-4">
                                        <InputLabel for="price" value="Price" />
                                        <TextInput id="price" v-model="form.price" type="number"
                                            class="mt-1 block w-full" autocomplete="price" />
                                        <InputError :message="$page.props.errors.price" class="mt-2" />
                                    </div>
                                    <div class="mb-4">
                                        <InputLabel for="tags" value="Tags" />
                                        <TextInput id="tags" v-model="form.tags" type="text" class="mt-1 block w-full"
                                            autocomplete="tags" />
                                        <InputError :message="$page.props.errors.tags" class="mt-2" />
                                    </div>
                                    <div class="mb-4">
                                        <InputLabel for="image" value="Image" />
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
                                            @click.prevent="selectNewImage">Select A New Image</SecondaryButton>
                                        <SecondaryButton type="button" class="mt-2" @click.prevent="deleteImage">
                                            Remove Image</SecondaryButton>
                                        <InputError :message="$page.props.errors.image" class="mt-2" />
                                    </div>
                                </div>
                            </div>
                            <div class="bg-gray-50 dark:bg-gray-700 px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse">
                                <PrimaryButton wire:click.prevent="store()" type="button"
                                    class="inline-flex justify-center w-full rounded-md border border-transparent px-4 py-2 bg-green-600 text-base leading-6 font-medium text-white shadow-sm hover:bg-green-500 focus:outline-none focus:border-green-700 focus:shadow-outline-green transition ease-in-out duration-150 sm:text-sm sm:leading-5"
                                    v-show="!editMode" @click="save(form)">
                                    Save
                                </PrimaryButton>
                                <PrimaryButton wire:click.prevent="store()" type="button"
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
                price: 0,
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
                title: null,
                body: null,
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
            formData.append('tags', data.tags);
            const imageBlob = this.dataURItoBlob(this.imagePreview);
            formData.append('image', imageBlob, 'image.jpg');
            this.$inertia.post('/products', formData, {
                headers: { 'Content-Type': 'multipart/form-data' },
                onProgress: progressEvent => {
                    console.log(`Upload progress: ${Math.round(progressEvent.loaded / progressEvent.total * 100)}%`);
                },
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
            formData.append('tags', data.tags);
            const imageBlob = this.dataURItoBlob(this.imagePreview);
            formData.append('image', imageBlob, 'image.jpg');
            this.$inertia.post('/products/' + data.id, formData, {
                headers: { 'Content-Type': 'multipart/form-data' },
                onProgress: progressEvent => {
                    console.log(`Upload progress: ${Math.round(progressEvent.loaded / progressEvent.total * 100)}%`);
                },
            })
            this.reset();
            this.closeModal();
        },
        deleteRow(data) {
            if (!confirm('Are you sure want to remove?')) return;
            data._method = 'DELETE';
            this.$inertia.post(`/products/${data.id}`, data)
            this.reset();
            this.closeModal();
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
                console.error(`An error has occurred while reading the image file: ${error}`);
            }
        },
        selectNewImage() {
            this.imagePreview = null;
            try {
                if (this.$refs.imageInput && typeof this.$refs.imageInput.click === 'function') {
                    this.$refs.imageInput.click();
                } else {
                    console.error(`The image input element is not available`);
                }
            } catch (error) {
                console.error(`An error has occurred while selecting the image: ${error}`);
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
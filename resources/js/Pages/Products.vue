<script setup>
import AppLayout from '@/Layouts/AppLayout.vue';
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import SecondaryButton from '@/Components/SecondaryButton.vue';
import TextInput from '@/Components/TextInput.vue';
</script>
    
<template>
    <AppLayout title="Products">
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Products
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
                    <PrimaryButton @click="openModal()">
                        Create New Product
                    </PrimaryButton>
                    <table class="table-fixed w-full">
                        <thead>
                            <tr class="bg-gray-100">
                                <th class="px-4 py-2 w-20">No.</th>
                                <th class="px-4 py-2">Name</th>
                                <th class="px-4 py-2">Description</th>
                                <th class="px-4 py-2">image</th>
                                <th class="px-4 py-2">price</th>
                                <th class="px-4 py-2">tags</th>
                                <th class="px-4 py-2">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr v-for="row in data">
                                <th class="border px-4 py-2">{{ row.id }}</th>
                                <th class="border px-4 py-2">{{ row.name }}</th>
                                <th class="border px-4 py-2">{{ row.description }}</th>
                                <th class="border px-4 py-2">{{ row.image }}</th>
                                <th class="border px-4 py-2">{{ row.price }}</th>
                                <th class="border px-4 py-2">{{ row.tags }}</th>
                                <td class="border px-4 py-2">
                                    <PrimaryButton @click="edit(row)">Edit</PrimaryButton>
                                    <SecondaryButton @click="deleteRow(row)">Delete</SecondaryButton>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                    <div class="fixed z-10 inset-0 overflow-y-auto ease-out duration-400" v-if="isOpen">
                        <div class="flex items-end justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
                            <div class="fixed inset-0 transition-opacity">
                                <div class="absolute inset-0 bg-gray-500 opacity-75"></div>
                            </div>
                            <span class="hidden sm:inline-block sm:align-middle sm:h-screen"></span>​
                            <div class="inline-block align-bottom bg-white rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full"
                                role="dialog" aria-modal="true" aria-labelledby="modal-headline">
                                <form enctype="multipart/form-data">
                                    <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                                        <div class="">
                                            <div class="mb-4">
                                                <InputLabel for="name" value="Name" />
                                                <TextInput id="name" v-model="form.name" type="text"
                                                    class="mt-1 block w-full" autocomplete="name" />
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
                                                <TextInput id="tags" v-model="form.tags" type="text"
                                                    class="mt-1 block w-full" autocomplete="tags" />
                                                <InputError :message="$page.props.errors.tags" class="mt-2" />
                                            </div>
                                            <div class="mb-4">
                                                <div v-if="!form.image" class="col-span-6 sm:col-span-4">
                                                    <input ref="imageInput" type="file" class="hidden"
                                                        @change="updateImagePreview">
                                                    <InputLabel for="image" value="Image" />
                                                    <div v-show="!imagePreview" class="mt-2">
                                                        <img :src="form.image" :alt="form.image"
                                                            class="rounded-full h-20 w-20 object-cover">
                                                    </div>
                                                    <div v-show="imagePreview" class="mt-2">
                                                        <span
                                                            class="block rounded-full w-20 h-20 bg-cover bg-no-repeat bg-center"
                                                            :style="'background-image: url(\'' + imagePreview + '\');'" />
                                                    </div>
                                                    <SecondaryButton class="mt-2 mr-2" type="button"
                                                        @click.prevent="selectNewImage">
                                                        Select A New Image
                                                    </SecondaryButton>
                                                    <SecondaryButton v-if="form.image" type="button" class="mt-2"
                                                        @click.prevent="deleteImage">
                                                        Remove Image
                                                    </SecondaryButton>
                                                    <InputError :message="$page.props.errors.image" class="mt-2" />
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="bg-gray-50 px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse">
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
                                            class="inline-flex justify-center w-full rounded-md border border-gray-300 px-4 py-2 bg-white text-base leading-6 font-medium text-gray-700 shadow-sm hover:text-gray-500 focus:outline-none focus:border-blue-300 focus:shadow-outline-blue transition ease-in-out duration-150 sm:text-sm sm:leading-5">
                                            Cancel
                                        </SecondaryButton>
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
                price: null,
                description: null,
                image: null,
                price: null,
                tags: null,
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
            this.$inertia.post('/products', data, {
                forceFormData: true,
            })
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
            this.$inertia.post('/products/' + data.id, data, {
                forceFormData: true,
            })
            this.reset();
            this.closeModal();
        },
        deleteRow: function (data) {
            if (!confirm('Are you sure want to remove?')) return;
            data._method = 'DELETE';
            this.$inertia.post('/products/' + data.id, data)
            this.reset();
            this.closeModal();
        }
    }
}
</script>
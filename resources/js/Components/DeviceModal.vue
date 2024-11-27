<template>
  <Modal :show="isOpen" @close="$emit('close')">
    <form enctype="multipart/form-data">
      <div class="bg-white dark:bg-gray-800 px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
        <div class="">
          <div v-for="(field, index) in fields" :key="index" class="mb-4">
            <InputLabel :for="field.name" :value="field.label" />
            <component
              :is="field.component"
              :id="field.name"
              v-model="form[field.name]"
              :type="field.type"
              class="mt-1 block w-full"
              :disabled="viewMode || field.disabled"
              :autocomplete="field.name"
            />
            <InputError :message="$page.props.errors[field.name]" class="mt-2" />
          </div>
        </div>
      </div>
      <div class="bg-gray-50 dark:bg-gray-700 px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse">
        <PrimaryButton
          type="button"
          class="inline-flex justify-center w-full rounded-md border border-transparent px-4 py-2 bg-green-600 text-base leading-6 font-medium text-white shadow-sm hover:bg-green-500 focus:outline-none focus:border-green-700 focus:shadow-outline-green transition ease-in-out duration-150 sm:text-sm sm:leading-5"
          v-show="!editMode && !viewMode"
          @click="$emit('save', form)"
        >
          Save
        </PrimaryButton>
        <PrimaryButton
          type="button"
          class="inline-flex justify-center w-full rounded-md border border-transparent px-4 py-2 bg-green-600 text-base leading-6 font-medium text-white shadow-sm hover:bg-green-500 focus:outline-none focus:border-green-700 focus:shadow-outline-green transition ease-in-out duration-150 sm:text-sm sm:leading-5"
          v-show="editMode"
          @click="$emit('update', form)"
        >
          Update
        </PrimaryButton>
        <SecondaryButton
          @click="$emit('close')"
          type="button"
          class="inline-flex justify-center w-full rounded-md border border-gray-300 px-4 py-2 bg-white dark:bg-gray-800 text-base leading-6 font-medium text-gray-700 dark:text-gray-300 shadow-sm hover:text-gray-500 focus:outline-none focus:border-blue-300 focus:shadow-outline-blue transition ease-in-out duration-150 sm:text-sm sm:leading-5"
        >
          Cancel
        </SecondaryButton>
      </div>
    </form>
  </Modal>
</template>

<script>
import Modal from '@/Components/Modal.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import SecondaryButton from '@/Components/SecondaryButton.vue';
import InputLabel from '@/Components/InputLabel.vue';
import InputError from '@/Components/InputError.vue';
import TextInput from '@/Components/TextInput.vue';

export default {
  components: {
    Modal,
    PrimaryButton,
    SecondaryButton,
    InputLabel,
    InputError,
    TextInput,
  },
  props: {
    isOpen: {
      type: Boolean,
      required: true,
    },
    form: {
      type: Object,
      required: true,
    },
    editMode: {
      type: Boolean,
      required: true,
    },
    viewMode: {
      type: Boolean,
      required: true,
    },
    fields: {
      type: Array,
      required: true,
    },
  },
};
</script>
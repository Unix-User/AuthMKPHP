<template>
    <div class="max-w-sm rounded overflow-hidden shadow-lg bg-gray-300 ">
        <img class="w-full" :src="productImage" alt="productName">
        <div class="px-6 py-4">
            <div class="font-bold text-xl mb-2">{{ productName }}</div>
            <p class="text-gray-700 text-base">{{ productDescription }}</p>
            <p class="text-gray-700 text-base">Rate: {{ productRate }}</p>
        </div>
        <div class="px-6 pt-4 pb-2">
            <span v-for="tag in productTags"
                class="inline-block bg-gray-200 rounded-full px-3 py-1 text-sm font-semibold text-gray-700 mr-2 mb-2">{{ tag }}</span>
        </div>
    </div>
</template>

<script>
export default {
  props: {
    productImage: {
      type: String,
      required: true
    },
    productName: {
      type: String,
      required: true
    },
    productDescription: {
      type: String,
      required: true
    },
    productTags: {
      type: Array,
      required: true
    },
    productRate: {
      type: String,
      required: true
    }
  }
};
</script>

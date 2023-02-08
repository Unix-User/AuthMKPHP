<script setup>
import ApplicationLogo from '@/Components/ApplicationLogo.vue';
import ProductCard from './ProductCard.vue';
</script>

<template>
    <div>
        <div class="p-6 sm:px-20 bg-white border-b border-gray-200">
            <div>
                <ApplicationLogo class="block h-12 w-auto" />
            </div>

            <div class="mt-8 text-2xl">
                Produtos
            </div>

            <div class="mt-6 text-gray-500">
                Abaixo todos os perfis de conexão de internet cadastrados
            </div>
        </div>
        <div class="bg-gray-200 bg-opacity-25 grid md:grid-cols-3 sm:grid-cols-1">
            <div v-for="row in productsData">
                <div class="p-6">
                    <div class="flex items-center">
                        <ProductCard :productImage="'/storage/images/' + row.image" :productName="row.name"
                            :productDescription="row.description" :productTags="row.tags">
                        </ProductCard>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    props: {
        productsData: {
            type: Array,
            required: true
        },
    }
}
</script>
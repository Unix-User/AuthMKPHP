<script setup>
import ApplicationLogo from '@/Components/ApplicationLogo.vue';
import ProductCard from './ProductCard.vue';
</script>

<template>
    <div>
        <div class="p-6 lg:p-8 bg-white dark:bg-gray-800 dark:bg-gradient-to-bl dark:from-gray-700/50 dark:via-transparent border-b border-gray-200 dark:border-gray-700">
            <ApplicationLogo class="block h-12 w-auto" />

            <h1 class="mt-8 text-2xl font-medium text-gray-900 dark:text-white">
                Produtos
            </h1>

            <p class="mt-6 text-gray-500 dark:text-gray-400 leading-relaxed">
                Abaixo todos os perfis de conexão de internet cadastrados. Escolha o melhor plano para você e aproveite nossa internet de alta velocidade.
            </p>
        </div>

        <div class="bg-gray-200 dark:bg-gray-800 bg-opacity-25 grid grid-cols-1 md:grid-cols-2 gap-6 lg:gap-8 p-6 lg:p-8">
            <div>
                <div class="flex items-center">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" class="w-6 h-6 stroke-gray-400">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 6.042A8.967 8.967 0 006 3.75c-1.052 0-2.062.18-3 .512v14.25A8.987 8.987 0 016 18c2.305 0 4.408.867 6 2.292m0-14.25a8.966 8.966 0 016-2.292c1.052 0 2.062.18 3 .512v14.25A8.987 8.987 0 0018 18a8.967 8.967 0 00-6 2.292m0-14.25v14.25" />
                    </svg>
                    <h2 class="ms-3 text-xl font-semibold text-gray-900 dark:text-white">
                        Catálogo de Produtos
                    </h2>
                </div>

                <p class="mt-4 text-gray-500 dark:text-gray-400 text-sm leading-relaxed">
                    Aqui você pode visualizar todos os nossos produtos disponíveis. Cada produto é apresentado com detalhes como nome, descrição e tags relevantes.
                </p>
            </div>

            <div>
                <div class="flex items-center">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" class="w-6 h-6 stroke-gray-400">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 15.75l5.159-5.159a2.25 2.25 0 013.182 0l5.159 5.159m-1.5-1.5l1.409-1.409a2.25 2.25 0 013.182 0l2.909 2.909m-18 3.75h16.5a1.5 1.5 0 001.5-1.5V6a1.5 1.5 0 00-1.5-1.5H3.75A1.5 1.5 0 002.25 6v12a1.5 1.5 0 001.5 1.5zm10.5-11.25h.008v.008h-.008V8.25zm.375 0a.375.375 0 11-.75 0 .375.375 0 01.75 0z" />
                    </svg>
                    <h2 class="ms-3 text-xl font-semibold text-gray-900 dark:text-white">
                        Visão Geral dos Produtos
                    </h2>
                </div>

                <p class="mt-4 text-gray-500 dark:text-gray-400 text-sm leading-relaxed">
                    Abaixo está uma lista completa de todos os nossos produtos. Você pode visualizar detalhes como nome do produto, descrição e tags associadas. Use os cards para obter mais informações sobre cada produto.
                </p>
            </div>
        </div>

        <div class="bg-gray-200 dark:bg-gray-800 bg-opacity-25 grid grid-cols-1 md:grid-cols-3 gap-6 lg:gap-8 p-6 lg:p-8">
            <div v-for="row in productsData" :key="row.id">
                <ProductCard 
                    :productImage="row.image ? '/storage/images/' + row.image : '/storage/images/404.jpg'"
                    :productName="row.name"
                    :productDescription="row.description" 
                    :productTags="row.tags.split(',')"
                    class="bg-white dark:bg-gray-700 shadow-lg hover:shadow-xl transition-shadow duration-300 rounded-lg overflow-hidden text-gray-800 dark:text-gray-200"
                />
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
<script setup>
import AppLayout from '@/Layouts/AppLayout.vue';
import Client from '@/Components/Client.vue';
</script>

<template>
    <AppLayout title="Dashboard">
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Showcase
            </h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                    <Client :productsData=data />
                </div>
            </div>
        </div>
    </AppLayout>
</template>

<script>
export default {
    props: ['data'],
}
</script>
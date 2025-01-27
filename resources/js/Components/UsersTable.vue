<template>
    <div class="space-y-6">
        <div v-for="row in data" :key="row.id" class="flex items-center justify-between">
            <div class="flex items-center">
                <img class="w-8 h-8 rounded-full object-cover" :src="row.profile_photo_url" :alt="row.name">
                <div class="ms-4 dark:text-white">
                    {{ row.name }}
                </div>
            </div>

            <div class="flex items-center">
                <div class="ms-2 text-sm text-gray-400">
                    {{ row.email }}
                </div>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    props: ['data'],
    emits: ['edit', 'delete']
}
</script>

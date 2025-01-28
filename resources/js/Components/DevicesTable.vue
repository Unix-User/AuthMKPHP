<template>
  <div class="relative">
    <div v-for="row in devicesData" :key="row.id" class="bg-white dark:bg-gray-800 rounded-lg shadow-md p-6 mb-4">
      <div class="flex flex-col md:flex-row justify-between items-center" @click="handleRowClick(row)">
        <div class="flex items-center space-x-4 md:space-x-6 w-full md:w-auto">
          <a class="flex-grow">
            <div>
              <p class="font-medium text-gray-900 dark:text-white text-lg hover:underline">
                {{ row.name }}
              </p>
              <p class="text-sm text-gray-500 dark:text-gray-400">ID: {{ row.id }}</p>
            </div>
          </a>
          <div>
            <p class="text-sm text-gray-500 dark:text-gray-400">IP: {{ row.ip }}</p>
            <p class="text-sm text-gray-500 dark:text-gray-400">Team ID: {{ row.team_id }}</p>
          </div>
        </div>
        <div class="flex space-x-1 mt-3 md:mt-0">
          <button @click.stop="handleSync(row)"
            class="p-3 rounded-md bg-green-500 hover:bg-green-600 text-white focus:outline-none focus:ring-2 focus:ring-green-300"
            :disabled="syncing[row.id]">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 transition-transform" viewBox="0 0 512 512" fill="currentColor" :class="{'animate-spin': syncing[row.id]}">
              <path
                d="M142.9 142.9c-17.5 17.5-30.1 38-37.8 59.8c-5.9 16.7-24.2 25.4-40.8 19.5s-25.4-24.2-19.5-40.8C55.6 150.7 73.2 122 97.6 97.6c87.2-87.2 228.3-87.5 315.8-1L455 55c6.9-6.9 17.2-8.9 26.2-5.2s14.8 12.5 14.8 22.2l0 128c0 13.3-10.7 24-24 24l-8.4 0c0 0 0 0 0 0L344 224c-9.7 0-18.5-5.8-22.2-14.8s-1.7-19.3 5.2-26.2l41.1-41.1c-62.6-61.5-163.1-61.2-225.3 1zM16 312c0-13.3 10.7-24 24-24l7.6 0 .7 0L168 288c9.7 0 18.5 5.8 22.2 14.8s1.7 19.3-5.2 26.2l-41.1 41.1c62.6 61.5 163.1 61.2 225.3-1c17.5-17.5 30.1-38 37.8-59.8c5.9-16.7 24.2-25.4 40.8-19.5s25.4 24.2 19.5 40.8c-10.8 30.6-28.4 59.3-52.9 83.8c-87.2 87.2-228.3 87.5-315.8 1L57 457c-6.9 6.9-17.2 8.9-26.2 5.2S16 449.7 16 440l0-119.6 0-.7 0-7.6z" />
            </svg>
          </button>
          <button @click.stop="$emit('edit', row)"
            class="p-3 rounded-md bg-indigo-500 hover:bg-indigo-600 text-white focus:outline-none focus:ring-2 focus:ring-indigo-300">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
              <path
                d="M13.586 3.586a2 2 0 112.828 2.828l-.793.793-2.828-2.828.793-.793zM11.379 5.793L3 14.172V17h2.828l8.38-8.379-2.83-2.828z" />
            </svg>
          </button>
          <button @click.stop="$emit('delete', row)"
            class="p-3 rounded-md bg-red-500 hover:bg-red-600 text-white focus:outline-none focus:ring-2 focus:ring-red-300">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
              <path fill-rule="evenodd"
                d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm5-1a1 1 0 00-1 1v6a1 1 0 102 0V8a1 1 0 00-1-1z"
                clip-rule="evenodd" />
            </svg>
          </button>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import { ref } from 'vue';

export default {
  props: ['devicesData'],
  emits: ['edit', 'delete', 'sync', 'list'],
  setup(props, { emit }) {
    const syncing = ref({});

    const handleRowClick = (row) => {
      emit('list', row);
    };

    const handleSync = (row) => {
      if (syncing.value[row.id]) return;
      syncing.value = { ...syncing.value, [row.id]: true };
      emit('sync', row);
      // In a real application, you would reset syncing[row.id] to false after the sync operation completes,
      // likely in the parent component after handling the 'sync' event and receiving a response.
      // For example:
      setTimeout(() => {
        syncing.value = { ...syncing.value, [row.id]: false };
      }, 2000); // Simulate a 2-second sync operation
    };

    return { handleRowClick, handleSync, syncing };
  },
};
</script>
<style scoped>
.animate-spin {
  animation: spin 1s linear infinite;
}

@keyframes spin {
  from {
    transform: rotate(0deg);
  }
  to {
    transform: rotate(360deg);
  }
}
</style>

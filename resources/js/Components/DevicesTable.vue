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
          <button @click.stop="$emit('sync', row)"
            class="p-3 rounded-md bg-green-500 hover:bg-green-600 text-white focus:outline-none focus:ring-2 focus:ring-green-300">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 24 24" fill="none"
              stroke="currentColor">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
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
export default {
  props: ['devicesData'],
  emits: ['edit', 'delete', 'sync', 'list'],
  setup(props, { emit }) {

    const handleRowClick = (row) => {
      emit('list', row);
    };

    return { handleRowClick };
  },
};
</script>

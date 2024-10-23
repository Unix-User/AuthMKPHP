<script setup>
import AppLayout from "@/Layouts/AppLayout.vue";
import Welcome from "@/Components/Welcome.vue";
import Admin from "@/Components/Admin.vue";
import Devices from "@/Components/Devices.vue";
</script>

<template>
  <AppLayout title="Dashboard">
    <template #header>
      <h2
        class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight"
      >
        Dashboard
      </h2>
    </template>

    <div class="py-12">
      <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div
          class="bg-white dark:bg-gray-800 overflow-hidden shadow-xl sm:rounded-lg"
        >
          <Admin />
        </div>
        <hr class="m-10"/>
        <div
          class="bg-white dark:bg-gray-800 overflow-hidden shadow-xl sm:rounded-lg"
        >
          <Devices />
        </div>
      </div>
    </div>
  </AppLayout>
</template>

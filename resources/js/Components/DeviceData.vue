<template>
  <div>
    <div v-if="isLoading" class="text-center py-4">Loading PPP Users and Device Info...</div>
    <div v-else-if="error" class="text-center text-red-500 py-4">{{ error }}</div>
    <div v-else>
      <div class="mb-6 border-b border-gray-200 dark:border-gray-700">
        <nav class="flex space-x-4" aria-label="Tabs">
          <a
            href="#"
            :class="[
              currentTab === 'device'
                ? 'bg-gray-100 text-gray-700 dark:bg-gray-700 dark:text-gray-300'
                : 'text-gray-500 hover:text-gray-700 dark:text-gray-300 dark:hover:text-gray-400',
              'px-3 py-2 font-medium text-sm rounded-md transition-colors duration-200'
            ]"
            @click.prevent="currentTab = 'device'"
          >
            Device Information
          </a>
          <a
            href="#"
            :class="[
              currentTab === 'users'
                ? 'bg-gray-100 text-gray-700 dark:bg-gray-700 dark:text-gray-300'
                : 'text-gray-500 hover:text-gray-700 dark:text-gray-300 dark:hover:text-gray-400',
              'px-3 py-2 font-medium text-sm rounded-md transition-colors duration-200'
            ]"
            @click.prevent="currentTab = 'users'"
          >
            PPP Users
          </a>
          <a
            href="#"
            :class="[
              currentTab === 'profiles'
                ? 'bg-gray-100 text-gray-700 dark:bg-gray-700 dark:text-gray-300'
                : 'text-gray-500 hover:text-gray-700 dark:text-gray-300 dark:hover:text-gray-400',
              'px-3 py-2 font-medium text-sm rounded-md transition-colors duration-200'
            ]"
            @click.prevent="currentTab = 'profiles'"
          >
            PPP Profiles
          </a>
        </nav>
      </div>

      <div v-if="currentTab === 'device'">
        <div class="bg-white dark:bg-gray-800 rounded-lg shadow-md p-4 md:p-6">
          <div class="grid grid-cols-1 md:grid-cols-2 gap-2 md:gap-4">
            <div v-for="(value, key) in device" :key="key" class="flex items-center space-x-1 md:space-x-2">
              <span class="font-medium text-gray-700 dark:text-gray-300 capitalize text-sm md:text-base">{{ key.replace(/-/g, ' ') }}:</span>
              <span class="text-gray-900 dark:text-white text-sm md:text-base">{{ value }}</span>
            </div>
          </div>
        </div>
      </div>

      <div v-if="currentTab === 'users'">
        <div class="overflow-x-auto">
          <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
            <thead class="bg-gray-50 dark:bg-gray-700">
              <tr>
                <th scope="col" class="px-2 md:px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">ID</th>
                <th scope="col" class="px-2 md:px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Name</th>
                <th scope="col" class="px-2 md:px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Service</th>
                <th scope="col" class="px-2 md:px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Caller ID</th>
                <th scope="col" class="px-2 md:px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Profile</th>
                <th scope="col" class="px-2 md:px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Routes</th>
                <th scope="col" class="px-2 md:px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">IPv6 Routes</th>
                <th scope="col" class="px-2 md:px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Limit Bytes In</th>
                <th scope="col" class="px-2 md:px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Limit Bytes Out</th>
                <th scope="col" class="px-2 md:px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Last Logged Out</th>
                <th scope="col" class="px-2 md:px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Disabled</th>
              </tr>
            </thead>
            <tbody class="bg-white dark:bg-gray-800 divide-y divide-gray-200 dark:divide-gray-700">
              <tr v-for="user in pppUsers" :key="user.name">
                <td class="px-2 md:px-6 py-2 md:py-4 whitespace-nowrap text-sm font-medium text-gray-900 dark:text-white">{{ user['.id'] }}</td>
                <td class="px-2 md:px-6 py-2 md:py-4 whitespace-nowrap text-sm font-medium text-gray-900 dark:text-white">{{ user.name }}</td>
                <td class="px-2 md:px-6 py-2 md:py-4 whitespace-nowrap text-sm text-gray-500 dark:text-gray-300">{{ user.service }}</td>
                <td class="px-2 md:px-6 py-2 md:py-4 whitespace-nowrap text-sm text-gray-500 dark:text-gray-300">{{ user['caller-id'] }}</td>
                <td class="px-2 md:px-6 py-2 md:py-4 whitespace-nowrap text-sm text-gray-500 dark:text-gray-300">{{ user.profile }}</td>
                <td class="px-2 md:px-6 py-2 md:py-4 whitespace-nowrap text-sm text-gray-500 dark:text-gray-300">{{ user.routes }}</td>
                <td class="px-2 md:px-6 py-2 md:py-4 whitespace-nowrap text-sm text-gray-500 dark:text-gray-300">{{ user['ipv6-routes'] }}</td>
                <td class="px-2 md:px-6 py-2 md:py-4 whitespace-nowrap text-sm text-gray-500 dark:text-gray-300">{{ user['limit-bytes-in'] }}</td>
                <td class="px-2 md:px-6 py-2 md:py-4 whitespace-nowrap text-sm text-gray-500 dark:text-gray-300">{{ user['limit-bytes-out'] }}</td>
                <td class="px-2 md:px-6 py-2 md:py-4 whitespace-nowrap text-sm text-gray-500 dark:text-gray-300">{{ user['last-logged-out'] }}</td>
                <td class="px-2 md:px-6 py-2 md:py-4 whitespace-nowrap text-sm text-gray-500 dark:text-gray-300">{{ user.disabled }}</td>
              </tr>
            </tbody>
          </table>
        </div>
      </div>
      <div v-if="currentTab === 'profiles'">
        <div class="overflow-x-auto">
          <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
            <thead class="bg-gray-50 dark:bg-gray-700">
              <tr>
                <th scope="col" class="px-2 md:px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">ID</th>
                <th scope="col" class="px-2 md:px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Name</th>
                <th scope="col" class="px-2 md:px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Remote Address</th>
                <th scope="col" class="px-2 md:px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Comment</th>
              </tr>
            </thead>
            <tbody class="bg-white dark:bg-gray-800 divide-y divide-gray-200 dark:divide-gray-700">
              <tr v-for="profile in pppProfiles" :key="profile.name">
                <td class="px-2 md:px-6 py-2 md:py-4 whitespace-nowrap text-sm font-medium text-gray-900 dark:text-white">{{ profile['.id'] }}</td>
                <td class="px-2 md:px-6 py-2 md:py-4 whitespace-nowrap text-sm font-medium text-gray-900 dark:text-white">{{ profile.name }}</td>
                <td class="px-2 md:px-6 py-2 md:py-4 whitespace-nowrap text-sm text-gray-500 dark:text-gray-300">{{ profile['remote-address'] }}</td>
                <td class="px-2 md:px-6 py-2 md:py-4 whitespace-nowrap text-sm text-gray-500 dark:text-gray-300">{{ profile.comment }}</td>
              </tr>
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import { ref, onMounted } from 'vue';
import axios from 'axios';

export default {
  props: {
    deviceId: {
      type: Number,
      required: true
    }
  },
  setup(props) {
    const pppUsers = ref([]);
    const device = ref({});
    const isLoading = ref(true);
    const error = ref(null);
    const currentTab = ref('device');
    const pppProfiles = ref([]);

    const fetchPppUsers = async () => {
      isLoading.value = true;
      error.value = null;
      try {
        const response = await axios.get(`/device/${props.deviceId}`);
        pppUsers.value = response.data.pppUsers;
        device.value = response.data.device[0];
        pppProfiles.value = response.data.pppProfiles;
      } catch (e) {
        error.value = 'Failed to load PPP Users and Device Info.';
        console.error("Error fetching PPP users and device info:", e);
      } finally {
        isLoading.value = false;
      }
    };

    onMounted(fetchPppUsers);

    return {
      pppUsers,
      device,
      isLoading,
      error,
      currentTab,
      pppProfiles
    };
  }
};
</script>

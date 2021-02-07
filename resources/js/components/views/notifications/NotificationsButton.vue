<template>
    <router-link to="/notifications" class="relative bg-white p-1 rounded-full text-gray-400 hover:text-gray-500 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-cyan-500">
        <span class="sr-only">View notifications</span>
        <i class="fas fa-bell fa-lg"></i>
        <span v-if="hasUnreadNotifications" class="absolute top-0 right-0 border mr-0\.5 mt-0\.5 rounded-full h-3 w-3 bg-blue-500"></span>
    </router-link>
</template>

<script>
import { mapGetters } from 'vuex';

export default {
    computed: {
        ...mapGetters('users', ['user']),
        unreadNotificationCount() {
            return this.user?.unreadNotificationCount;
        },
        hasUnreadNotifications() {
            return this.unreadNotificationCount > 0;
        }
    }
}
</script>

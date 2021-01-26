<template>
    <!-- Profile dropdown -->
    <div class="ml-3 relative">
        <div>
            <button @click="open = !open" class="max-w-xs relative bg-white rounded-full flex items-center text-sm focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-cyan-500 lg:p-2 lg:rounded-md lg:hover:bg-gray-50" id="user-menu" aria-haspopup="true">
                <img class="h-8 w-8 rounded-full" :src="avatar" alt="">
                <span class="hidden ml-3 text-gray-700 text-sm font-medium lg:block"><span class="sr-only">Open user menu for </span>{{fullName}}</span>
                <svg class="hidden flex-shrink-0 ml-1 h-5 w-5 text-gray-400 lg:block" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                    <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                </svg>
            </button>
        </div>

        <transition
            enter-active-class="transition ease-out duration-100"
            enter-class="transform opacity-0 scale-95"
            enter-to-class="transform opacity-100 scale-100"
            leave-active-class="transition ease-in duration-75"
            leave-class="transform opacity-100 scale-100"
            leave-to-class="transform opacity-0 scale-95">
            <div v-show="open" class="origin-top-right absolute z-30 right-0 mt-2 w-48 rounded-md shadow-lg py-1 bg-white ring-1 ring-black ring-opacity-5" role="menu" aria-orientation="vertical" aria-labelledby="user-menu">
                <router-link to="/profile" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100" role="menuitem">Your Profile</router-link>
                <a href="#" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100" role="menuitem">Settings</a>
                <a href="#" @click="logout" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100" role="menuitem">Logout</a>
            </div>
        </transition>
        <div v-show="open" @click="open = false" class="bg-gray-400 fixed bg-opacity-20 inset-0 z-10"></div>
    </div>
</template>

<script>
import { mapState } from 'vuex';

export default {
    name: "ProfileDropdown",
    data() {
        return {
            open: false
        }
    },
    methods: {
        logout() {
            axios.post('/logout').then(() => {window.location.href = '/login'});
        }
    },
    computed: {
        ...mapState('users', ['user']),
        fullName() {
            return this.user?.fullName;
        },
        avatar() {
            return this.user?.avatar
        }
    }
}
</script>

<style scoped>

</style>

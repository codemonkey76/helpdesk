<template>
    <div class="h-screen flex overflow-hidden bg-gray-100">
        <mobile-sidebar :open="sidebarOpen" @close="sidebarOpen = false" :menus="menus"
                        :menus-alt="menusAlt"></mobile-sidebar>
        <desktop-sidebar :menus="menus" :menus-alt="menusAlt"></desktop-sidebar>

        <router-view>
        </router-view>
    </div>
</template>
<script>
import {mapActions, mapMutations} from 'vuex';

export default {
    watch: {
        $route(to, from) {
            this.playSound();
        }
    },
    methods: {
        ...mapActions('users', ['GET_USER', 'GET_USERS']),
        ...mapActions('notifications', ['GET_NOTIFICATIONS']),

        ...mapMutations('notifications', ['ADD_TO_NOTIFICATIONS']),
        ...mapMutations('users', ['SET_ONLINE_USERS', 'ADD_TO_ONLINE_USERS', 'REMOVE_FROM_ONLINE_USERS', 'INCREMENT_NOTIFICATION_COUNT']),
        ...mapMutations('messages', ['ADD_TO_MESSAGES']),
        playSound() {
            this.audio.play();
        }
    },
    created() {
        // Get the current user
        this.GET_USER();

        // Get a list of all users
        this.GET_USERS();

        // Get all the current users notifications
        this.GET_NOTIFICATIONS();
    },
    mounted() {
        window.Echo.channel('global-notifications')
            .listen('GlobalNotification', (e) => {
                this.$toast.open({message: e.message, type: e.type});
                this.playSound();
            });

        window.Echo.private('App.Models.User.' + window.Laravel.user_id)
            .notification((notification) => {
                this.ADD_TO_NOTIFICATIONS(notification);
                this.INCREMENT_NOTIFICATION_COUNT();
                if (notification.type === 'App\\Notifications\\MessageReceivedNotification')
                    this.$toast.open('Message received from ' + notification.data.fromUser);
            });

        window.Echo.private('App.Models.Message.' + window.Laravel.user_id)
            .listen('MessageCreatedEvent', (e) => {
                this.ADD_TO_MESSAGES(e.message);
            });

        window.Echo.private('App.Models.User.' + window.Laravel.user_id)
            .listen('UserUpdatedEvent', (e) => {
                this.GET_USER();
                this.$toast.open({message: 'User has been updated, reloading', type: 'info'});
            });

        window.Echo.join('messaging')
            .here((users) => {
                this.SET_ONLINE_USERS(users);
            }).joining((user) => {
            this.ADD_TO_ONLINE_USERS(user);
            this.$toast.open(user.first_name + ' just logged in');
        }).leaving((user) => {
            console.log(user.name);
            this.REMOVE_FROM_ONLINE_USERS(user);
            this.$toast.open(user.first_name + ' just logged out');
        });
    },
    data() {
        return {
            sidebarOpen: false,
            menus: [
                {
                    route: '/',
                    label: 'Dashboard',
                    icon: 'fas fa-tachometer-alt'
                },
                {
                    route: '/directory',
                    label: 'Directory',
                    icon: 'far fa-address-card'
                },
                {
                    route: '/tickets',
                    label: 'Tickets',
                    icon: 'fas fa-ticket-alt'
                },
                {
                    route: '/organizations',
                    label: 'Organizations',
                    icon: 'fas fa-building'
                },
                {
                    route: '/companies',
                    label: 'Companies',
                    icon: 'fas fa-home'
                },
                {
                    route: '/contacts',
                    label: 'Contacts',
                    icon: 'far fa-address-card'
                },
                {
                    route: '/jobs',
                    label: 'Jobs',
                    icon: 'fas fa-tasks'
                }, {
                    route: '/messages',
                    label: 'Messages',
                    icon: 'fas fa-envelope'
                }, {
                    route: '/logs',
                    label: 'Logs',
                    icon: 'fab fa-buffer'
                },
                {
                    route: '/users',
                    label: 'Users',
                    icon: 'fas fa-users'
                },

            ],
            'menusAlt': [
                {
                    route: '/settings',
                    label: 'Settings',
                    icon: 'fas fa-cog'
                },
                {
                    route: '/bugs',
                    label: 'Bugs / Feature Requests',
                    icon: 'fas fa-bug'
                }
            ],
            audio: new Audio('/sounds/pop.mp3')
        }

    }
}
</script>

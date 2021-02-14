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
import { menus, menusAlt } from '../menus';
export default {
    watch: {
        $route(to, from) {
            this.playSound();
        }
    },
    methods: {
        ...mapActions(['LOAD_INITIAL_DATA']),
        ...mapActions('users', ['GET_USER']),
        ...mapActions('companies', ['GET_COMPANIES']),
        ...mapActions('organizations', ['GET_ORGANIZATIONS']),

        ...mapMutations('notifications', ['ADD_TO_NOTIFICATIONS']),
        ...mapMutations('users', ['SET_ONLINE_USERS', 'ADD_TO_ONLINE_USERS', 'REMOVE_FROM_ONLINE_USERS', 'INCREMENT_NOTIFICATION_COUNT']),
        ...mapMutations('messages', ['ADD_TO_MESSAGES']),
        ...mapMutations('bugs', ['SET_BUGS']),
        playSound() {
            this.audio.play();
        },
        // searchMessageResults(e) {
        //     this.SET_MESSAGES(e.results);
        //     this.$toast.open({message: 'Got message search results', type: 'info'});
        // },
        // searchBugResults(e) {
        //     this.SET_BUGS(e.results);
        //     this.$toast.open({message: 'Got bug search results', type: 'info'});
        // },
        globalNotification(notification) {
            this.$toast.open({message: notification.message, type: notification.type});
            this.playSound();
        },
        userNotification(notification) {
            this.ADD_TO_NOTIFICATIONS(notification);
            this.INCREMENT_NOTIFICATION_COUNT();
            if (notification.type === 'App\\Notifications\\MessageReceivedNotification')
                this.$toast.open('Message received from ' + notification.data.fromUser);
        },
        newMessage(e) {
            this.ADD_TO_MESSAGES(e.message);
        },
        userUpdated(e) {
            this.GET_USER();
            this.$toast.open({message: 'User has been updated, reloading', type: 'info'});
        },
        userLoggedIn(user) {
            this.ADD_TO_ONLINE_USERS(user);
            this.$toast.open(user.first_name + ' just logged in');
        },
        userLoggedOut(user) {
            this.REMOVE_FROM_ONLINE_USERS(user);
            this.$toast.open(user.first_name + ' just logged out');
        },
        setupEchoListeners() {
            window.Echo.channel('global-notifications')
                .listen('GlobalNotification', this.globalNotification);
            // window.Echo.channel('App.Models.User.' + window.Laravel.user_id + '.SearchResults')
            //     .listen('SearchMessageResultsEvent', this.searchMessageResults)
            //     .listen('SearchBugResultsEvent', this.searchBugResults)
            window.Echo.private('App.Models.User.' + window.Laravel.user_id).notification(this.userNotification);

            window.Echo.private('App.Models.User.' + window.Laravel.user_id).listen('UserUpdatedEvent', this.userUpdated);

            window.Echo.join('messaging')
                .here(this.SET_ONLINE_USERS)
                .joining(this.userLoggedIn)
                .leaving(this.userLoggedOut);
        }
    },
    created() {
        this.LOAD_INITIAL_DATA();
    },
    mounted() {
        this.setupEchoListeners();
    },
    data() {
        return {
            sidebarOpen: false,
            menus,
            menusAlt,
            audio: new Audio('/sounds/pop.mp3')
        }
    }
}
</script>

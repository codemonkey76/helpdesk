import {mapActions, mapGetters, mapMutations} from 'vuex';
import Vue from 'vue';

const handlers = {
    ...mapGetters('users', ['users']),
    ...mapMutations('messages', ['ADD_TO_MESSAGES', 'SET_MESSAGES']),
    ...mapActions('users', ['GET_USER']),
    ...mapActions('companies', ['GET_COMPANIES']),
    ...mapActions('organizations', ['GET_ORGANIZATIONS']),
    ...mapMutations('notifications', ['ADD_TO_NOTIFICATIONS']),
    ...mapMutations('users', ['SET_ONLINE_USERS', 'ADD_TO_ONLINE_USERS', 'REMOVE_FROM_ONLINE_USERS', 'INCREMENT_NOTIFICATION_COUNT']),
    ...mapMutations('bugs', ['SET_BUGS']),

    searchMessageResults(e) {
        this.SET_MESSAGES(e.results);
        Vue.prototype.$toast.open({message: 'Got message search results', type: 'info'});
    },
    searchBugResults(e) {
        this.SET_BUGS(e.results);
        Vue.prototype.$toast.open({message: 'Got bug search results', type: 'info'});
    },
    userUpdated(e) {
        this.GET_USER();
        Vue.prototype.$toast.open({message: 'User has been updated, reloading', type: 'info'});
    },
    userLoggedIn(user) {
        this.ADD_TO_ONLINE_USERS(user);
        Vue.prototype.$toast.open(user.first_name + ' just logged in');
    },
    userLoggedOut(user) {
        this.REMOVE_FROM_ONLINE_USERS(user);
        Vue.prototype.$toast.open(user.first_name + ' just logged out');
    },
    globalNotification(notification) {
        Vue.prototype.$toast.open({message: notification.message, type: notification.type});
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
    playSound() {
        this.audio.play();
    },
    audio: new Audio('/sounds/pop.mp3')
};

export default function() {
    console.log('Setting Event Handlers');
    window.Echo.channel('App.Models.User.' + window.Laravel.user_id + '.SearchResults')
        .listen('SearchMessageResultsEvent', handlers.searchMessageResults)

    window.Echo.channel('global-notifications')
        .listen('GlobalNotification', handlers.globalNotification);
    window.Echo.channel('App.Models.User.' + window.Laravel.user_id + '.SearchResults')
        .listen('SearchMessageResultsEvent', handlers.searchMessageResults)
        .listen('SearchBugResultsEvent', handlers.searchBugResults)
    window.Echo.private('App.Models.User.' + window.Laravel.user_id).notification(handlers.userNotification);
    window.Echo.private('App.Models.Message.' + window.Laravel.user_id).listen('MessageCreatedEvent', handlers.newMessage);
    window.Echo.private('App.Models.User.' + window.Laravel.user_id).listen('UserUpdatedEvent', handlers.userUpdated);

    window.Echo.join('messaging')
        .here(handlers.SET_ONLINE_USERS)
        .joining(handlers.userLoggedIn)
        .leaving(handlers.userLoggedOut);
}

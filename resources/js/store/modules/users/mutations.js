export default {
    SET_USER(state, payload) {
        state.user = payload;
    },
    SET_USERS(state, payload) {
        state.users = payload;
    },
    SET_ONLINE_USERS(state, users) {
        state.online = users;
    },
    ADD_TO_ONLINE_USERS(state, user) {
        state.online.push(user);
    },
    REMOVE_FROM_ONLINE_USERS(state, user) {
        const index = state.online.indexOf(user);
        if (index > -1) {
            state.online.splice(index, 1);
        }
    },
    DECREMENT_NOTIFICATION_COUNT(state) {
        state.user.unreadNotificationCount--;
    },
    INCREMENT_NOTIFICATION_COUNT(state) {
        state.user.unreadNotificationCount++;
    }
};

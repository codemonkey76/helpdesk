export default {
    SET_NOTIFICATIONS(state, notifications) {
        state.notifications = notifications;
    },
    ADD_TO_NOTIFICATIONS(state, notification) {
        state.notifications.unshift(notification);
    },
    REMOVE_NOTIFICATION(state, id) {
        state.notifications = state.notifications.filter((value) => value.id !== id);
    }

};

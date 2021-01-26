export default {
    SET_NOTIFICATIONS(state, notifications) {
        state.notifications = notifications;
    },
    ADD_TO_NOTIFICATIONS(state, notification) {
        state.notifications.unshift(notification);
    },
    REMOVE_NOTIFICATION(state, id) {
        let index = state.notifications.indexOf(x => x.id === id);
        state.notifications.splice(index, 1);
    }

};

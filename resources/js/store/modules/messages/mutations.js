export default {
    SET_MESSAGES(state, messages) {
        state.messages = messages;
    },
    ADD_TO_MESSAGES(state, message) {
        if (message.to_user_id === message.from_user_id)
            message.direction = 'received';
        else
            message.direction = 'sent';

        state.messages.unshift(message);
    }
};

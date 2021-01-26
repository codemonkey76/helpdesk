export default {
    GET_NOTIFICATIONS({commit}) {
        axios.get('/api/notifications')
            .then(response => {
                commit('SET_NOTIFICATIONS', response.data);
            }).catch(error => {
            console.error(error);
        })
    },
    MARK_AS_READ({commit}, id) {
        axios.post('/api/notifications/' + id, { _method: 'PATCH'})
            .then(response => {
                if (response.data === 'ok')
                    console.log('request sent successfully');
                commit('REMOVE_NOTIFICATION', id);
                commit('users/DECREMENT_NOTIFICATION_COUNT',null, {root: true});
            }).catch(error => {
                console.error(error);
        });
    }
};

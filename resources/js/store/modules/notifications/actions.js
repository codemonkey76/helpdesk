export default {
    GET_NOTIFICATIONS({commit}) {
        return axios.get('/api/notifications')
            .then(response => {
                commit('SET_NOTIFICATIONS', response.data);
            });
    },
    MARK_AS_READ({commit, dispatch}, id) {
        commit('REMOVE_NOTIFICATION', id);
        commit('users/DECREMENT_NOTIFICATION_COUNT',null, {root: true});
        return axios.post('/api/notifications/' + id, { _method: 'PATCH'})
            .then(response => {
            }).catch(error => {
                this.GET_NOTIFICATIONS();
                dispatch('users/GET_USER', null, {root:true});
        });
    }
};

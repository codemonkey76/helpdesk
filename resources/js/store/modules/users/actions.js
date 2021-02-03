export default {
    GET_USER({commit}) {
        return axios.get('/api/user')
            .then(response => {
                commit('SET_USER', response.data);
            });
    },
    GET_USERS({commit}) {
        return axios.get('/api/users')
            .then(response => {
                commit('SET_USERS', response.data);
            });
    },
};

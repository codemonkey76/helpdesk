export default {
    GET_USER({commit}) {
        axios.get('/api/user')
            .then(response => {
                commit('SET_USER', response.data)
            }).catch(error => {
            console.log(error);
        })
    },
    GET_USERS({commit}) {
        axios.get('/api/users')
            .then(response => {
                commit('SET_USERS', response.data)
            }).catch(error => {
            console.log(error);
        })
    },
};

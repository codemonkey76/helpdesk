export default {
    GET_ORGANIZATIONS({commit}) {
        return axios.get('/api/organizations')
            .then(response => {
                commit('SET_ORGANIZATIONS', response.data);
            });
    },
};

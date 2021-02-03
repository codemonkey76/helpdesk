export default {
    GET_COMPANIES({commit}) {
        return axios.get('/api/companies')
            .then(response => {
                commit('SET_COMPANIES', response.data);
            });
    },
};

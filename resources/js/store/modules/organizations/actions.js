import axios from "axios";

export default {
    GET_ORGANIZATIONS({commit}) {
        return axios.get('/api/organizations')
            .then(response => {
                commit('SET_ORGANIZATIONS', response.data);
            });
    },
    CREATE_ORGANIZATION({commit}) {
        return axios.post('/api/organizations')
    },
};

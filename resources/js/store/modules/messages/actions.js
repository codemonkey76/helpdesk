import axios from "axios";

export default {
    SEARCH_MESSAGES({commit}, query) {
        let params = {
            query
        };
        return axios.get('/api/search/messages', {params});
    },
    GET_MESSAGES({commit}) {
        return axios.get('/api/messages')
            .then(response => {
                commit('SET_MESSAGES', response.data);
            });
    },
    ARCHIVE_MESSAGE({commit}, id) {
        commit('ARCHIVE_MESSAGE', id);
        return axios.post('/api/messages/' + id + '/archive')
            .catch(error => {
                this.GET_MESSAGES();
        });
    },
    SEND_MESSAGE({commit}, message) {
        return axios.post('/api/messages', message)
    }
};

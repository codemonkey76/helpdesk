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
    GET_PAGINATED_MESSAGES({commit}, page) {
        return axios.get('/api/messages', {
            params: {
                page: page
            }
        })
            .then(response => {
                commit('SET_MESSAGES', response.data);
            });
    },
    ARCHIVE_MESSAGE({commit, dispatch}, id, page) {
        return axios.post('/api/messages/' + id + '/archive').then(() => {
            dispatch('GET_PAGINATED_MESSAGES', page);
        });
    },
    SEND_MESSAGE({commit}, message) {
        return axios.post('/api/messages', message)
    }
};

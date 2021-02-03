import axios from "axios";

export default {
    SEARCH_BUGS({commit}, query) {
        let params = {
            query
        };
        return axios.get('/api/search/bugs', {params})
            .catch(error => {
                console.error(error);
            });
    },
    GET_BUGS({commit}) {
        return axios.get('/api/bugs')
            .then(response => {
                commit('SET_BUGS', response.data)
            });
    },
    CLOSE_BUG({commit}, id) {
        commit('CLOSE_BUG', id);
        return axios.post('/api/bugs/' + id + '/close').catch(error => {
        console.error(error);
            commit('OPEN_BUG', id);
        })
    },
    OPEN_BUG({commit}, id) {
        commit('OPEN_BUG', id);
        return axios.delete('/api/bugs/' + id + '/close').catch(error => {
        console.error(error);
            commit('CLOSE_BUG', id);
        })
    },
    REPORT_BUG({commit}, bug) {
        commit('REPORT_BUG', bug);
        return axios.post('/api/bugs', bug)
            .then(response => {
                commit('UPDATE_BUG', response.data);
            })
            .catch(error => {
                console.error(error);
            })
    }
};

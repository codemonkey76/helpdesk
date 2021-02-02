import axios from "axios";

export default {
    GET_BUGS({commit}) {
        axios.get('/api/bugs')
            .then(response => {
                commit('SET_BUGS', response.data)
            }).catch(error => {
            console.error(error);
        })
    },
    CLOSE_BUG({commit}, id) {
        commit('CLOSE_BUG', id);
        axios.post('/api/bugs/' + id + '/close').catch(error => {
        console.error(error);
            commit('OPEN_BUG', id);
        })
    },
    OPEN_BUG({commit}, id) {
        commit('OPEN_BUG', id);
        axios.delete('/api/bugs/' + id + '/close').catch(error => {
        console.error(error);
            commit('CLOSE_BUG', id);
        })
    },
    REPORT_BUG({commit}, bug) {
        commit('REPORT_BUG', bug);
        axios.post('/api/bugs', bug)
            .then(response => {
                commit('UPDATE_BUG', response.data);
            })
            .catch(error => {
                console.error(error);
            })
    }
};
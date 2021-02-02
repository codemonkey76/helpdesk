import axios from "axios";

export default {
    SEARCH_MESSAGES({commit}, query) {
        let params = {
            query
        };
        axios.get('/api/search/messages', {params})
            .then(response => {
                if (response.data === 'ok')
                    console.log('request sent successfully')
            }).catch(error => {
            console.error(error);
        })
    },
    GET_MESSAGES({commit}) {
        axios.get('/api/messages')
            .then(response => {
                commit('SET_MESSAGES', response.data);
            }).catch(error => {
            console.error(error)
        });
    },
    ARCHIVE_MESSAGE({commit}, id) {
        commit('ARCHIVE_MESSAGE', id);
        axios.post('/api/messages/' + id + '/archive')
            .then(response => {
            }).catch(error => {
                this.GET_MESSAGES();
        })
    },
    SEND_MESSAGE({commit}, message) {
        axios.post('/api/messages')
            
    }
};

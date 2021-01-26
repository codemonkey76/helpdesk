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
            console.log(error)
        });
    },
};

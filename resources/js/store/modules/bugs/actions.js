export default {
    GET_BUGS({commit}) {
        axios.get('/api/bugs')
            .then(response => {
                commit('SET_BUGS', response.data)
            }).catch(error => {
            console.log(error);
        })
    },
};
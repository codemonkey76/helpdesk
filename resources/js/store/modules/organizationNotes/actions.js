import axios from "axios";

export default {
    ADD_NOTE({commit}, payload) {
        return axios.post('/api/organizations/' + payload.orgId + '/notes', payload.note);
    },
    UPDATE_NOTE({commit}, payload) {
        payload.note.append("_method", "patch");

        return axios.post(
            `/api/organizations/${payload.orgId}/notes/${payload.noteId}`,
            payload.note,
            {
                headers: {
                    'Content-Type': 'application/x-www-form-urlencoded'
                }
            }
        );
    },
    GET_NOTES({commit}, payload) {
        return axios.get('/api/organizations/' + payload.orgId + '/notes');
    },
    GET_PAGINATED_NOTES({commit}, payload) {
        return axios.get('/api/organizations/' + payload.orgId + '/notes', {
            params: {
                page: payload.page
            }
        })
            .then(response => {
                commit('SET_NOTES', response.data);
            });
    },
    SEARCH_NOTES({commit}, payload) {

        let params = {
            query: payload.query
        };
        return axios.get('/api/organizations/' + payload.orgId + '/notes', {params});
    },
};

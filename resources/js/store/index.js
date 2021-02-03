import Vue from 'vue';
import Vuex from 'vuex';

import ENUM from './enums';
import createLogger from './logger';
import bugs from './modules/bugs';
import companies from './modules/companies';
import contacts from './modules/contacts';
import global from './modules/global';
import messages from './modules/messages';
import notifications from './modules/notifications';
import organizations from './modules/organizations';
import tickets from './modules/tickets';
import users from './modules/users';


Vue.use(Vuex);

const debug = process.env.NODE_ENV !== 'production';


export default new Vuex.Store({
    modules: {
        bugs,
        companies,
        contacts,
        global,
        messages,
        notifications,
        organizations,
        tickets,
        users,
    },
    state: {
        apiState: ENUM.INIT
    },
    mutations: {
        SET_API_STATE(state, apiState) {
            state.apiState = apiState;
        }
    },
    actions: {
        LOAD_INITIAL_DATA({commit}) {
            commit('SET_API_STATE', ENUM.LOADING);

            const promises = [
                this.dispatch('users/GET_USER'),
                this.dispatch('users/GET_USERS'),
                this.dispatch('notifications/GET_NOTIFICATIONS'),
                this.dispatch('bugs/GET_BUGS'),
                this.dispatch('messages/GET_MESSAGES'),
                this.dispatch('organizations/GET_ORGANIZATIONS'),
                this.dispatch('companies/GET_COMPANIES')
            ];

            Promise.allSettled(promises).then((results) => {
                if (results.find(({status}) => status === 'rejected')) {
                    commit('SET_API_STATE', ENUM.ERROR);
                } else {
                    commit('SET_API_STATE', ENUM.LOADED);
                }
            });
        }
    },
    strict: debug,
    plugins: debug ? [createLogger()] : []
});

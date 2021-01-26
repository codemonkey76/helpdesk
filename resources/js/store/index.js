import Vue from 'vue';
import Vuex from 'vuex';

import users from './modules/users';
import messages from './modules/messages';
import notifications from './modules/notifications';

import createLogger from './logger';


Vue.use(Vuex);

const debug = process.env.NODE_ENV !== 'production';


export default new Vuex.Store({
    modules: {
        users,
        messages,
        notifications
    },
    strict: debug,
    plugins: debug ? [createLogger()] : []
});

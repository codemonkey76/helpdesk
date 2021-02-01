import Vue from 'vue';
import Vuex from 'vuex';

import global from './modules/global';
import users from './modules/users';
import messages from './modules/messages';
import notifications from './modules/notifications';
import bugs from './modules/bugs';

import createLogger from './logger';


Vue.use(Vuex);

const debug = process.env.NODE_ENV !== 'production';


export default new Vuex.Store({
    modules: {
        global,
        users,
        messages,
        notifications,
        bugs
    },
    strict: debug,
    plugins: debug ? [createLogger()] : []
});

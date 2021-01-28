require('./bootstrap');

import "tailwindcss/tailwind.css"

import Vue from 'vue';
import VueRouter from 'vue-router';
import {routes} from './routes';
import App from './components/App';

import moment from 'moment-timezone/builds/moment-timezone-with-data';

Vue.prototype.$moment = moment;
moment.tz.setDefault("Australia/Brisbane");

Vue.use(VueRouter);
import store from './store';

const router = new VueRouter({
    mode: 'history',
    routes,
    store
})


import VueToast from 'vue-toast-notification';
import 'vue-toast-notification/dist/theme-sugar.css';

Vue.use(VueToast);

import MultiSelect from "./components/controls/MultiSelect";
import VueTrix from '@dymantic/vue-trix-editor';
// import VueTrix from 'vue-trix';
Vue.component('vue-trix', VueTrix);
// Somewhere in your code where you have access to the Vue instance
Vue.config.ignoredElements = [
    'trix-editor'
];

Vue.component('multi-select', MultiSelect);

const files = require.context('./', true, /\.vue$/i)
files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default))


const app = new Vue({
    el: '#app',
    components: {App},
    router,
    store
});

window._ = require('lodash');

/**
 * We'll load jQuery and the Bootstrap jQuery plugin which provides support
 * for JavaScript based Bootstrap features such as modals and tabs. This
 * code may be modified to fit the specific needs of your application.
 */

try {
    window.Popper = require('popper.js').default;
    window.$ = window.jQuery = require('jquery');

    require('bootstrap');
} catch (e) {}

/**
 * We'll load the axios HTTP library which allows us to easily issue requests
 * to our Laravel back-end. This library automatically handles sending the
 * CSRF token as a header based on the value of the "XSRF" token cookie.
 */

window.axios = require('axios');

window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';

let token = document.head.querySelector('meta[name="csrf-token"]');

if (token) {
    window.axios.defaults.headers.common['X-CSRF-TOKEN'] = token.content;
} else {
    console.error('CSRF token not found: https://laravel.com/docs/csrf#csrf-x-csrf-token');
}

window.axios.interceptors.request.use(
    request => {
        request.headers['Authorization'] = 'Bearer ' + window.Laravel.api_token;
        request.headers['Accept'] = 'application/json';
        return request;
        },
    error => {
        return Promise.reject(error);
    }
);

import Swal from 'sweetalert2';

window.axios.interceptors.response.use(response => {
    return response;
}, error => {
   if (401 === error.response.status) {
       Swal.fire({
           title: 'Session Expired',
           text: 'Your session has expired, would you like to be redirected to the login page?',
           type: 'warning',
           showCancelButton: true,
           confirmButtonColor: '#dd6b55',
           confirmButtonText: 'Yes',
           closeOnConfirm: false
       }).then(result => {
           if (result.isConfirmed) {
               window.location = '/login';
           }
       });
   }  else {
       return Promise.reject(error);
   }
});

import Echo from "laravel-echo"

window.Pusher = require('pusher-js');

window.Echo = new Echo({
    broadcaster: 'pusher',
    key: process.env.MIX_PUSHER_APP_KEY,
    wsHost: 'socket.' + window.location.hostname,
    wsPort: 6001,
    wssPort: 6001,
    disableStats: true,
    forceTLS: false,
    enabledTransports: ['ws', 'wss'],
    encrypted: false
});

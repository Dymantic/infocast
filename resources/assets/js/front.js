window.axios = require('axios');

window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';

/**
 * Next we will register the CSRF Token as a common header with Axios so that
 * all outgoing HTTP requests automatically have it attached. This is just
 * a simple convenience so we don't have to attach every token manually.
 */

let token = document.head.querySelector('meta[name="csrf-token"]');

if (token) {
    window.axios.defaults.headers.common['X-CSRF-TOKEN'] = token.content;
} else {
    console.error('CSRF token not found: https://laravel.com/docs/csrf#csrf-x-csrf-token');
}
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */


window.Vue = require('vue');

import Menu from "./components/Menu";
import Usher from "./components/Usher";
import swal from "sweetalert";
window.swal = swal;

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */
import Flickity from "flickity";
window.Flickity = Flickity;

import { throttle} from "lodash";

Vue.component('application-form', require('./components/ApplicationForm.vue'));
Vue.component('file-attachment', require('./components/FormFileAttachment.vue'));
Vue.component('contact-form', require('./components/ContactForm.vue'));

window.eventHub = new Vue();

const app = new Vue({
    el: '#app',

    created() {
        eventHub.$on('user-alert', this.showAlert)
    },

    methods: {
        showAlert(message) {
            swal({
                icon: message.type,
                title: message.title,
                text: message.text,
                button: message.confirm
            });
        }
    }
});

let handleScrollForNav = throttle(() => {
    if(window.scrollY > 80) {
        document.querySelector('.main-nav').classList.add('scrolled');
        window.removeEventListener('scroll', handleScrollForNav);
    }
}, 250);

window.addEventListener('scroll', handleScrollForNav);


const menu = new Menu();
menu.init();
new Usher();
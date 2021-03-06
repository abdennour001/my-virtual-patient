/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

import {VueCookies} from "vue-cookies";

require('./bootstrap');

window.Vue = require('vue');


import axios from 'axios'
import VueAxios from 'vue-axios'

Vue.use(VueAxios, axios);

// global register at main.js
import VueCountdownTimer from 'vuejs-countdown-timer';
Vue.use(VueCountdownTimer);


import 'bootstrap'
import 'bootstrap/dist/css/bootstrap.min.css'
import '@fortawesome/fontawesome-free'
import '@fortawesome/fontawesome-free-solid'
import '@fortawesome/free-brands-svg-icons'
import '@fortawesome/fontawesome-free-brands'

import { FontAwesomeIcon } from '@fortawesome/vue-fontawesome'
Vue.component('font-awesome-icon', FontAwesomeIcon);

Vue.use(require('vue-cookies'));
// set cookies expire time to 1 hour = 60 * 60 seconds
window.$cookies.config(60 * 60);

/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/InteractiveCaseForm.vue -> <example-component></example-component>
 */

// const files = require.context('./', true, /\.vue$/i);
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default));

Vue.component('interactive-case-form', require('./views/InteractiveCaseForm.vue').default);
Vue.component('make-patient-character', require('./views/MakePatientCharacter').default);
Vue.component('interactive-case-question', require('./components/InteractiveCaseQuestion').default);
Vue.component('patient-form', require('./components/PatientForm').default);
Vue.component('session', require('./components/Session').default);
// Buttons
Vue.component('refresh-button', require('./components/Button/RefreshButton').default);
Vue.component('finish-button', require('./components/Button/FinishButton').default);

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */


window.app = new Vue({
    el: '#app',
});

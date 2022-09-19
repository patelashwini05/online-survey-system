/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue').default;

import App from './App.vue';
import VueAxios from 'vue-axios';
import axios from 'axios';
import router from './routes';
import { BootstrapVue } from 'bootstrap-vue'
import VueSweetalert2 from 'vue-sweetalert2';


// Import Bootstrap and BootstrapVue CSS files (order is important)
import 'bootstrap/dist/css/bootstrap.css'
import 'bootstrap-vue/dist/bootstrap-vue.css'

import 'sweetalert2/dist/sweetalert2.min.css';

Vue.use(VueAxios, axios);
Vue.use(BootstrapVue);
Vue.use(VueSweetalert2);
// Vue.component('jw-pagination', JwPagination);

const app = new Vue({
    el: '#app',
    router,
    render: h => h(App),
});
require('./bootstrap');

import Vue from 'vue';
import VueRouter from 'vue-router';

import router from './router'
import Form from 'form-backend-validation';
import Paginate from 'vuejs-paginate'

window.Vue = Vue;
window.Form = Form;
Vue.use(VueRouter);
Vue.component('paginate', Paginate);

// Vue.component('example-component', require('./components/userlist.vue').default);

const app = new Vue({
    el: '#app',
    router
});


/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue');

/**
 * Initalizing BootstrapVue
 */
import BootstrapVue from 'bootstrap-vue';

Vue.use(BootstrapVue);

/**
 * Initalizing Vue Router
 */
import VueRouter from 'vue-router';

Vue.use(VueRouter);

const routes = [
    {
        path: '/item/:type',
        component: require('./components/Item.vue').default
    },
    {
        path: '/system/parameters',
        component: require('./components/System.vue').default
    }
];
const router = new VueRouter({
    mode: 'abstract',
    routes 
});

/**
 * Initalizing global variables
 */
Vue.prototype.GLOBAL = {
    'SERVICE_STAFF': 'staff',
    'SERVICE_CUSTOMER': 'customer',
    'SERVICE_ROOM': 'room',
    'SERVICE_FOOD': 'food',
};

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

//Vue.component('example', require('./components/Example.vue').default);
Vue.component('headbar', require('./components/Headbar.vue').default);
Vue.component('sidebar', require('./components/Sidebar.vue').default);
//Vue.component('item', require('./components/Item.vue').default);

const app = new Vue({
    el: '#app',
    router
});


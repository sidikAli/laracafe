require('./bootstrap');

window.Vue = require('vue');

import VueRouter from 'vue-router';
Vue.use(VueRouter);

import VueAxios from 'vue-axios';
import axios from 'axios';
import VueToast from 'vue-toast-notification';
import 'vue-toast-notification/dist/theme-default.css';


import App from './App.vue';
Vue.use(VueAxios, axios);
Vue.use(VueToast);


import Index from './components/cafe/Index.vue';
import Foods from './components/cafe/Foods.vue';
import FoodDetails from './components/cafe/FoodDetails.vue';
import Cart from './components/cafe/Cart.vue';
import PesananSukses from './components/cafe/PesananSukses.vue';


const routes = [
    {
        name: 'home',
        path: '/',
        component: Index
    },
    {
        name: 'foods',
        path: '/foods',
        component: Foods
    },
    {
        name: 'foodDetails',
        path: '/foods/:id',
        component: FoodDetails
    },
    {
        name: 'cart',
        path: '/cart',
        component: Cart
    },
    {
        name: 'pesanan-sukses',
        path: '/pesanan-sukses',
        component: PesananSukses
    }
];

const router = new VueRouter({
    mode: 'history',
    routes: routes
});

const app = new Vue(Vue.util.extend({ router }, App)).$mount('#app');require('./bootstrap');

import Vue from 'vue'
import VueRouter from 'vue-router'

Vue.use(VueRouter);

import App from './views/App'
import Catalog from './views/Catalog'
import Home from './views/Home';

const router = new VueRouter({
    mode: 'history',
    routes: [
        {
            path: '/manager2/',
            name: 'home',
            component: Home
        },
        {
            path: '/manager2/catalog',
            name: 'catalog',
            component: Catalog,
        },
    ],
});

const app = new Vue({
    el: '#app',
    components: { App },
    router,
});
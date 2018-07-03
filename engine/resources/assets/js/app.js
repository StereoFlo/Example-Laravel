import Vue from 'vue'
import VueRouter from 'vue-router'

Vue.use(VueRouter);

import App from './views/components/App/App'
import Catalog from './views/components/Catalog/List/List'
import Home from './views/components/Home/Home';

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
import Vue from 'vue'
import VueRouter from 'vue-router'

Vue.use(VueRouter);

import App from './views/components/App/App'
import CatalogList from './views/components/Catalog/List/List'
import CatalogForm from './views/components/Catalog/Form/index'
import Home from './views/components/Home/Home';
import Slogan from './views/components/Slogan/index';

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
            component: CatalogList,
        },
        {
            path: '/manager2/catalog/edit/:categoryId',
            name: 'catalogFormEdit',
            component: CatalogForm,
        },
        {
            path: '/manager2/catalog/new',
            name: 'catalogFormNew',
            component: CatalogForm,
        },
        {
            path: '/manager2/slogan',
            name: 'slogan',
            component: Slogan,
        },
    ],
});

const app = new Vue({
    el: '#app',
    components: { App },
    router,
});
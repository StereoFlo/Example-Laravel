import Vue from 'vue'
import VueRouter from 'vue-router'

Vue.use(VueRouter);

import App from './views/components/App/App'
import CatalogList from './views/components/Catalog/List/List'
import CatalogForm from './views/components/Catalog/Form/index'
import Home from './views/components/Home/Home';
import Slogan from './views/components/Settings/index';
import Material from './views/components/Material/List/index';
import MaterialForm from './views/components/Material/Create/index';
import PagesList from './views/components/Pages/List/index';
import PagesForm from './views/components/Pages/Form/index';
import NewsList from './views/components/News/List/index';
import NewsForm from './views/components/News/Form/index';

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
            path: '/manager2/settings',
            name: 'settings',
            component: Slogan,
        },
        {
            path: '/manager2/materials',
            name: 'materials',
            component: Material,
        },
        {
            path: '/manager2/materials/add',
            name: 'materialsAdd',
            component: MaterialForm,
        },
        {
            path: '/manager2/pages',
            name: 'pagesList',
            component: PagesList,
        },
        {
            path: '/manager2/pages/form',
            name: 'pagesForm',
            component: PagesForm,
        },
        {
            path: '/manager2/news',
            name: 'newsList',
            component: NewsList,
        },
        {
            path: '/manager2/news/form',
            name: 'newsForm',
            component: NewsForm,
        },
    ],
});

const app = new Vue({
    el: '#app',
    components: { App },
    router,
});
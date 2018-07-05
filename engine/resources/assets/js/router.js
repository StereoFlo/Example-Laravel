import Vue from 'vue'
import VueRouter from "vue-router";
Vue.use(VueRouter);

import CatalogList from './views/components/Catalog/List/List'
import CatalogForm from './views/components/Catalog/Form/index'
import Home from './views/components/App/Home';
import Main from './views/components/App/Main';
import Slogan from './views/components/Settings/index';
import Material from './views/components/Material/List/index';
import MaterialForm from './views/components/Material/Create/index';
import PagesList from './views/components/Page/List/index';
import PagesForm from './views/components/Page/Form/index';
import NewsList from './views/components/News/List/index';
import NewsForm from './views/components/News/Form/index';
import WorkList from './views/components/Work/List/index';
import UserList from './views/components/User/List/index';
import UserShow from './views/components/User/Show/index';

const router = new VueRouter({
    mode: 'history',
    linkActiveClass: 'active',
    routes: [
        {
            path: '/manager2',
            name: 'main',
            component: Main,
            redirect: '/manager2/home',
            children: [
                {
                    path: 'home',
                    name: 'home',
                    component: Home
                },
                {
                    path: 'catalog',
                    name: 'catalog',
                    component: CatalogList,
                },
                {
                    path: 'catalog/form/:categoryId',
                    name: 'catalogFormEdit',
                    component: CatalogForm,
                },
                {
                    path: 'catalog/form',
                    name: 'catalogFormNew',
                    component: CatalogForm,
                },
                {
                    path: 'settings',
                    name: 'settings',
                    component: Slogan,
                },
                {
                    path: 'materials',
                    name: 'materials',
                    component: Material,
                },
                {
                    path: 'materials/add',
                    name: 'materialsAdd',
                    component: MaterialForm,
                },
                {
                    path: 'pages',
                    name: 'pagesList',
                    component: PagesList,
                },
                {
                    path: 'pages/form/:pageId',
                    name: 'pagesFormEdit',
                    component: PagesForm,
                },
                {
                    path: 'pages/form',
                    name: 'pagesForm',
                    component: PagesForm,
                },
                {
                    path: 'news',
                    name: 'newsList',
                    component: NewsList,
                },
                {
                    path: 'news/form',
                    name: 'newsForm',
                    component: NewsForm,
                },
                {
                    path: 'news/form/:newsId',
                    name: 'newsFormEdit',
                    component: NewsForm,
                },
                {
                    path: 'work',
                    name: 'workList',
                    component: WorkList,
                },
                {
                    path: 'user',
                    name: 'userList',
                    component: UserList,
                },
                {
                    path: 'user/:userId',
                    name: 'userShow',
                    component: UserShow,
                },
            ],
        },
    ],
});

export default router;
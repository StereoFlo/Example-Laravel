import Vue from 'vue'

import App from './views/components/App/App'
import router from './router';
import store from './store';
import http from './http';

const app = new Vue({
    el: '#app',
    store,
    components: { App },
    router,
    http,
});
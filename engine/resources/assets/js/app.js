import Vue from 'vue'

import App from './views/components/App/App'
import router from './router';
import store from './store';

const app = new Vue({
    el: '#app',
    store,
    components: { App },
    router,
});
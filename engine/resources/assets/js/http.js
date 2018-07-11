import Vue from 'vue'
import VueResource from "vue-resource";

Vue.use(VueResource);

function getCsrfToken() {
    let meta = document.getElementsByTagName('meta');
    for (let item of meta) {
        if (item.getAttribute('name') === 'csrf-token') {
            return item.getAttribute('content');
        }
    }
    return null;
}
Vue.http.options.credentials = true;
Vue.http.interceptors.push((request, next) => {
    request.headers.set('Authorization', 'Bearer ' + document.getElementById('token').getAttribute('data-token'));
    request.headers.set('Accept', 'application/json');
    request.headers.set('X-CSRF-TOKEN', getCsrfToken());
    next()
});

const http = {
    root: '/'
};

export default http;
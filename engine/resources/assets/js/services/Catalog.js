import http from 'http';

export default {
    getList() {
        console.log(http.get('/api/manager/catalog/list'));
    }
}
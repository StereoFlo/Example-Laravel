class CatalogApi {
    get(url = '', params = '', method = 'GET') {
        return new Promise(function (resolve, reject) {
            const xhr = new XMLHttpRequest();
            xhr.open(method, url, true);
            xhr.setRequestHeader('Authorization', 'Bearer ' + CatalogApi.getToken());
            xhr.setRequestHeader("X-Requested-With", "XMLHttpRequest");
            if (method === 'POST') {
                xhr.setRequestHeader('X-CSRF-TOKEN', CatalogApi.getCsrfToken());
            }
            xhr.onload = function () {
                if (this.status === 200) {
                    resolve(this.response);
                } else {
                    const error = new Error(this.statusText);
                    error.code = this.status;
                    reject(error);
                }
            };
            xhr.onerror = function () {
                reject(new Error("Network Error"));
            };
            if (params) {
                if (params instanceof Object) {
                    xhr.send($.param(params));
                } else {
                    xhr.send(params);
                }
            } else {
                xhr.send();
            }
        });
    }

    getCsrfToken() {
        let meta = document.getElementsByTagName('meta');
        for (let item of meta) {
            if (item.getAttribute('name') === 'csrf-token') {
                return item.getAttribute('content');
            }
        }
        return null;
    }

    getToken() {
        let tokenContainer = document.getElementById('token');
        return tokenContainer.getAttribute('data-token');
    }
}

export default {}
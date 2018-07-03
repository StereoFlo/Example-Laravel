export default {
    transport(url = '', params = '', method = 'GET') {
        return new Promise(function (resolve, reject) {
            const xhr = new XMLHttpRequest();
            xhr.open(method, url, true);
            xhr.setRequestHeader("X-Requested-With", "XMLHttpRequest");
            xhr.setRequestHeader("Authorization", "Bearer " + document.getElementById('token').getAttribute('data-token'));
            if (method === 'POST') {
                xhr.setRequestHeader('X-CSRF-TOKEN', getCsrfToken());
                xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
            }
            xhr.onload = function () {
                if (this.status === 200) {
                    resolve(JSON.parse(this.response));
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
}
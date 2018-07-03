<template src="./index.html"></template>

<script>
    import http from "../../../../services/http";

    export default {
        data() {
            return {
                nameError: '',
                form: {
                    name: '',
                    description: ''
                }
            }
        },
        methods: {
            submit(form) {
                const name = form.name;
                const description = form.description;

                if (!name) {
                    this.nameError = 'Имя является обязательным параметром!';
                    return;
                }

                const response = http.transport('/api/manager/catalog/process', {name: name, description: description}, 'POST');
                response.then((response) => {
                    if (response.success) {
                        this.$router.push('../catalog')
                    }
                }, error => {
                    console.log(error);
                });
            }

        }
    }
</script>
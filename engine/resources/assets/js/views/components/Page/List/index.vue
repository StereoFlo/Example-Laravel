<template src="./index.html"></template>

<script>

    export default {
        name: "index",
        data() {
            return {
                pages: []
            }
        },
        created() {
            this.getPages();
        },
        methods: {
            async getPages() {
                this.$http.get('/api/manager/pages/list').then(response => {
                    this.pages = response.body;
                });
            },
            async deletePage(slug) {
                this.$http.get('/api/manager/pages/' + slug + '/delete').then(response => {
                    if (response.ok) {
                        this.getPages();
                    }
                });
            }
        }
    }
</script>
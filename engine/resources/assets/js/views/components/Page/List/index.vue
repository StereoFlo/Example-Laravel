<template src="./index.html"></template>

<script>
    import http from "../../../../services/http";

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
                http.transport('/api/manager/pages/list').then(response => {
                    this.pages = response;
                });
            },
            async deletePage(slug) {
                http.transport('/api/manager/pages/' + slug + '/delete').then(response => {
                    if (response.success) {
                        this.getPages();
                    }
                });
            }
        }
    }
</script>
<template src="./list.html"></template>

<script>
    import http from '../../../../services/http'
    export default {
        data() {
            return {
                categories: [],
            }
        },
        created() {
            this.getCategories();
        },
        methods: {
            async getCategories() {
                this.categories = await http.http('/api/manager/catalog/list');
            }
        },
        name: "Catalog"
    }
</script>
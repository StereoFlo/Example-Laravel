<template src="./list.html"></template>

<script>
    import http from "../../../../services/http";
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
                this.categories = await http.transport('/api/manager/catalog/list');
            },
            async deleteCategory(id) {
                console.log(id);
                http.transport('/api/manager/catalog/'+ id +'/remove').then(response => {
                    if (response.success) {
                        this.getCategories();
                    }
                }, error => {
                    console.log(error);
                })
            }
        },
        name: "Catalog"
    }
</script>
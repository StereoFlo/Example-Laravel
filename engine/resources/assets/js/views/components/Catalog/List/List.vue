<template src="./list.html"></template>

<script>
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
                this.$http.get('/api/manager/catalog/list').then(response => {
                    this.categories = response.body;
                });
            },
            async deleteCategory(id) {
                this.$http.get('/api/manager/catalog/'+ id +'/remove').then(response => {
                    if (response.ok) {
                        this.getCategories();
                    }
                }, error => {
                    console.log(error);
                })
            }
        },
        name: "Catalog"
    }
</script>œ
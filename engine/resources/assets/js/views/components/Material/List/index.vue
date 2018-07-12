<template src="./index.html"></template>

<script>
    export default {
        data() {
            return {
                materials: []
            }
        },
        created() {
            this.getMaterials();
        },
        methods: {
            async getMaterials() {
                this.$http.get('/api/manager/material/list').then(response => {
                    this.materials = response.body;
                })
            },
            async removeMaterial(id) {
                this.$http.get('/api/manager/material/'+ id +'/remove').then(response => {
                    if (response.ok) {
                        this.getMaterials();
                    }
                })
            }
        }
    }
</script>
<template src="./index.html"></template>

<script>
    import http from "../../../../services/http";

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
                http.transport('/api/manager/material/list').then(response => {
                    this.materials = response;
                })
            }
        }
    }
</script>
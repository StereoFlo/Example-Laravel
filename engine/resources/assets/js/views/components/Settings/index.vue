<template src="./index.html"></template>

<script>
    import { VueEditor } from 'vue2-editor'
    import http from "../../../services/http";
    export default {
        components: {
            VueEditor
        },
        data() {
            return {
                settings: []
            }
        },
        created() {
            this.getSettings();
        },
        methods: {
            async getSettings() {
                http.transport('/api/manager/settings/list').then(response => {
                    console.log(response);
                    this.settings = response;
                })
            }
        }
    }
</script>
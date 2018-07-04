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
                settings: [],
                generalPageBlock: {},
                slogan: {},
                limitWorksForGallery: {},
            }
        },
        created() {
            this.getSettings();
        },
        methods: {
            async getSettings() {
                http.transport('/api/manager/settings/list').then(response => {
                    this.settings = response;
                    for (const item of response) {
                        if (item.setting_slug === 'limitWorksForGallery') {
                            this.limitWorksForGallery = item;
                        }
                        if (item.setting_slug === 'generalPageBlock') {
                            this.generalPageBlock = item;
                        }
                        if (item.setting_slug === 'slogan') {
                            this.slogan = item;
                        }
                    }

                })
            }
        }
    }
</script>
<template src="./index.html"></template>

<script>
    import { VueEditor } from 'vue2-editor'

    export default {
        components: {
            VueEditor
        },
        data() {
            return {
                settings: [],
                form: {
                    generalPageBlock: {},
                    slogan: {},
                    limitWorksForGallery: {},
                }
            }
        },
        created() {
            this.getSettings();
        },
        methods: {
            async getSettings() {
                this.$http.get('/api/manager/settings/list').then(response => {
                    this.settings = response.body;
                    for (const item of response.body) {
                        if (item.setting_slug === 'limitWorksForGallery') {
                            this.form.limitWorksForGallery = item;
                        }
                        if (item.setting_slug === 'generalPageBlock') {
                            this.form.generalPageBlock = item;
                        }
                        if (item.setting_slug === 'slogan') {
                            this.form.slogan = item;
                        }
                    }

                })
            },
            submit(e) {
                this.$http.post('/api/manager/settings/process', {
                    [e.generalPageBlock.setting_slug]: e.generalPageBlock.setting_value,
                    [e.limitWorksForGallery.setting_slug]: e.limitWorksForGallery.setting_value,
                    [e.slogan.setting_slug]: e.slogan.setting_value,
                })
            }
        }
    }
</script>
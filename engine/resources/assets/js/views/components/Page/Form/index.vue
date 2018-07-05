<template src="./index.html"></template>

<script>
    import {VueEditor} from 'vue2-editor'
    import http from "../../../../services/http";
    export default {
        components: {
            VueEditor
        },
        data() {
            return {
                pageId: this.$route.params.pageId || null,
                form: {
                    slug: '',
                    name: '',
                    content: '',
                    id: '',
                }
            }
        },
        created() {
            this.getPage();
        },
        methods: {
            submit(form) {
                http.transport('/api/manager/pages/process', form, 'POST').then(response => {
                    if (response.success) {
                        this.$router.push('../pages')
                    }
                });
            },
            async getPage() {
                if (this.pageId) {
                    http.transport('/api/manager/pages/' + this.pageId).then(response => {
                        this.form.slug = response.slug;
                        this.form.name = response.name;
                        this.form.content = response.content;
                        this.form.id = response.slug;
                    });
                }
            }
        },
    }
</script>
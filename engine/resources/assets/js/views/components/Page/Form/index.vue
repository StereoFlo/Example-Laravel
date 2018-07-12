<template src="./index.html"></template>

<script>
    import {VueEditor} from 'vue2-editor'

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
                this.$http.post('/api/manager/pages/process', form).then(response => {
                    if (response.success) {
                        this.$router.push({ name: 'pagesList' })
                    }
                });
            },
            async getPage() {
                if (this.pageId) {
                    this.$http.get('/api/manager/pages/' + this.pageId).then(response => {
                        this.form.slug = response.body.slug;
                        this.form.name = response.body.name;
                        this.form.content = response.body.content;
                        this.form.id = response.body.slug;
                    });
                }
            }
        },
    }
</script>
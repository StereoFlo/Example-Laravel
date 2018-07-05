<template src="./index.html"></template>

<script>
    import { VueEditor } from 'vue2-editor'
    import http from "../../../../services/http";
    export default {
        components: {
            VueEditor
        },
        data() {
           return {
               form: {
                   slug: '',
                   name: '',
                   content: ''
               }
           }
        },
        methods: {
            submit(form) {
                // if (form.name && form.slug && form.desc) {
                    http.transport('/api/manager/pages/process', {name: form.name, content: form.content, slug: form.slug}, 'POST').then(response => {
                        if (response.success) {
                            this.$router.push('../pages')
                        }
                    });
                // }
            }
        }
    }
</script>
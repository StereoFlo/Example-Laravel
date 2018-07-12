<template src="./index.html"></template>

<script>
    import { VueEditor } from 'vue2-editor'

    export default {
        components: {
            VueEditor
        },
        data() {
            return {
                form: {
                    name: '',
                    desc: '',
                    file: File,
                },
            }
        },
        methods: {
            files() {
                this.form.file = event.target.files[0];
            },
            submit(form) {
                const formData = new FormData();
                formData.append('name', form.name);
                formData.append('description', form.desc);
                formData.append('file', form.file);

                this.$http.post('/api/manager/material/process', formData).then(response => {
                    if (response.ok) {
                        this.$router.push({ name: 'materials' });
                    }
                });
            }
        }
    }
</script>
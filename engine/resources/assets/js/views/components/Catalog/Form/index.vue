<template src="./index.html"></template>

<script>
    export default {
        data() {
            return {
                form: {
                    name: '',
                    description: ''
                }
            }
        },
        methods: {
            submit(submitEvent) {
                console.log(submitEvent);
            }
        }
    }
</script>
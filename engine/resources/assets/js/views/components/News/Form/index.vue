<template>
    <div class="panel panel-default">
        <div class="panel-heading">Форма новости</div>
        <div class="panel-body">
            <form class="form-horizontal" @submit.prevent="submit(form)">
                <div class="form-group">
                    <label for="name" class="col-md-4 control-label">Название</label>
                    <div class="col-md-6">
                        <input id="name" type="text" class="form-control" name="name" v-model="form.name" required autofocus>
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-md-4 control-label">Содержание</label>
                    <div class="col-md-6">
                        <vue-editor id="content" name="content" v-model="form.content" ></vue-editor>
                    </div>
                </div>
                <div v-if="form.id">
                    <input type="hidden" name="id" v-model="form.id"/>
                </div>
                <div class="form-group">
                    <div class="col-md-8 col-md-offset-4">
                        <button type="submit" class="btn btn-primary">
                            OK
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</template>

<script>
    import { VueEditor } from 'vue2-editor'
    export default {
        components: {
            VueEditor
        },
        data() {
            return {
                newsId: this.$route.params.newsId || null,
                form: {
                    name: '',
                    content: '',
                    id: '',
                }
            }
        },
        created() {
            this.getNews();
        },
        methods: {
            submit(form) {
                this.$http.post('/api/manager/news/process', form).then(response => {
                    if (response.ok) {
                        this.$router.push({ name: 'newsList' });
                    }
                });
            },
            async getNews() {
                if (this.newsId) {
                    this.$http.get('/api/manager/news/' + this.newsId).then(response => {
                        this.form.name = response.body.name;
                        this.form.content = response.body.content;
                        this.form.id = response.body.id;
                    });
                }
            }
        }
    }
</script>

<style scoped>

</style>
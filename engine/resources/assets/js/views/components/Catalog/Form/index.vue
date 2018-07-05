<template>
    <div class="panel panel-default">
        <div class="panel-heading">Добавление категории</div>
        <div class="panel-body">
            <form @submit.prevent="submit(form)" class="form-horizontal" method="POST">
                <div class="form-group">
                    <label for="name" class="col-md-4 control-label">Название</label>
                    <div class="col-md-6">
                        <input class="input" type="text" id="name" v-model="form.name">
                        <p v-if="nameError">Имя является обязательным параметром</p>
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-md-4 control-label">Описание</label>
                    <div class="col-md-6">
                        <vue-editor id="description" name="description" v-model="form.description"></vue-editor>
                    </div>
                </div>
                <input v-if="form.id" type="hidden" name="id" v-model="form.id">
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
    import http from "../../../../services/http";
    import { VueEditor } from 'vue2-editor';

    export default {
        components: {
            VueEditor
        },
        data() {
            return {
                categoryId: this.$route.params.categoryId || null,
                category: {},
                nameError: '',
                form: {
                    id: '',
                    name: '',
                    description: '',

                }
            }
        },
        created() {
            this.getCategory();
        },
        methods: {
            async getCategory() {
                if (this.categoryId) {
                    http.transport('/api/manager/catalog/' + this.categoryId).then(response => {
                        this.form.name = response.name;
                        this.form.description = response.description;
                        this.form.id = response.id;
                    });
                }
            },
            submit(form) {
                const name = form.name;
                const description = form.description;

                if (!name) {
                    this.nameError = 'Имя является обязательным параметром!';
                    return;
                }

                const response = http.transport('/api/manager/catalog/process', this.form, 'POST');
                response.then((response) => {
                    if (response.success) {
                        this.$router.push('../catalog')
                    }
                }, error => {
                    console.log(error);
                });
            }

        }
    }
</script>
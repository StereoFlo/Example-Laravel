<template>
    <div class="panel panel-default">
        <div class="panel-heading">
            Категории (
            <router-link :to="{ name: 'newsForm' }">
                Добавить
            </router-link>
            )
        </div>
        <div class="panel-body">
            <div v-if="workList">
                <table class="table table-hover table-responsive">
                    <tr>
                        <td>ID</td>
                        <td>Название</td>
                        <td>Автор</td>
                        <td>Действия</td>
                    </tr>
                    <tr v-for="work in workList">
                        <td>{{ work.id }}</td>
                        <td>{{ work.workName }}</td>
                        <td>{{ work.userName }}</td>
                        <td>
                            <a :href="'/cabinet/work/' + work.id">Открыть</a> |
                            <a :href="'/cabinet/work/' + work.id + '/edit'">Изменить</a> |
                            <a @click.prevent="deleteWork(news.id)" href="#">Удалить</a>
                        </td>
                    </tr>
                </table>
            </div>
            <p v-if="!workList">Новостей пока нет</p>
        </div>
    </div>
</template>

<script>
    import http from "../../../../services/http";

    export default {
        data() {
            return {
                workList: []
            }
        },
        created() {
            this.getWorks();
        },
        methods: {
            async getWorks() {
                http.transport('/api/manager/work/list').then(response => {
                    this.workList = response;
                });
            },
            deleteWork(id) {
                http.transport('/api/manager/work/' + id + '/delete').then(response => {
                    if (response.success) {
                        this.getWorks();
                    }
                })
            }
        }
    }
</script>

<style scoped>

</style>
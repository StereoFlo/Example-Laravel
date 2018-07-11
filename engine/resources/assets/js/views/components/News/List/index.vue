<template>
    <div class="panel panel-default">
        <div class="panel-heading">
            Новости (
            <router-link :to="{ name: 'newsForm' }">
                Добавить
            </router-link>
            )
        </div>
        <div class="panel-body">
            <div v-if="newsList.length">
                <table class="table table-hover table-responsive">
                    <tr>
                        <td>ID</td>
                        <td>Название</td>
                        <td>Действия</td>
                    </tr>
                    <tr v-for="news in newsList">
                        <td>{{ news.id }}</td>
                        <td>{{ news.name }}</td>
                        <td>
                            <router-link :to="{ name: 'newsFormEdit', params: {newsId: news.id} }">
                                Изменить
                            </router-link> |
                            <a @click.prevent="deleteNews(news.id)" href="#">Удалить</a>
                        </td>
                    </tr>
                </table>
            </div>
            <p v-if="!newsList.length">Новостей пока нет</p>
        </div>
    </div>
</template>

<script>
    export default {
        data() {
            return {
                newsList: []
            }
        },
        created() {
            this.getNews();
        },
        methods: {
            async getNews() {
                this.$http.get('/api/manager/news/list').then(response => {
                    this.newsList = response.body;
                });
            },
            deleteNews(id) {
                this.$http.get('/api/manager/news/' + id + '/delete').then(response => {
                    if (response.ok) {
                        this.getNews();
                    }
                })
            }
        }
    }
</script>

<style scoped>

</style>
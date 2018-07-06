<template>
    <div class="panel panel-default">
        <div class="panel-heading">
            Работы
        </div>
        <div class="panel-body">
            <div v-if="workList.length">
                <table class="table table-hover table-responsive">
                    <tr>
                        <td>ID</td>
                        <td>Название</td>
                        <td>Проверена</td>
                        <td>Действия</td>
                    </tr>
                    <tr v-for="work in workList">
                        <td>{{ work.id }}</td>
                        <td>{{ work.workName }}</td>
                        <td>
                            <input type="checkbox" v-model="work.approved" @change="toggleApprove(work.id)"/>
                        </td>
                        <td>
                            <a :href="'/cabinet/work/' + work.id">Открыть</a> |
                            <a :href="'/cabinet/work/' + work.id + '/edit'">Изменить</a> |
                            <a @click.prevent="deleteWork(news.id)" href="#">Удалить</a>
                        </td>
                    </tr>
                </table>
                <div class="pagination">
                    <div v-if="showMore">
                        <router-link :to="{ name: 'workPagination', params: {page: prevPage} }">
                            &laquo;
                        </router-link>
                    </div>
                    <a class="active">{{ showCurrentPage }}</a> из {{ totalPages }}
                    <div v-if="showLess">
                        <router-link :to="{ name: 'workPagination', params: {page: nextPage} }">
                            &raquo;
                        </router-link>
                    </div>
                </div>
            </div>
            <p v-if="!workList.length">Работ пока нет</p>
        </div>
    </div>
</template>

<script>
    import http from "../../../../services/http";

    export default {
        data() {
            return {
                currentPage: this.$route.params.page || 0,
                workList: [],
                total: 0,
                limit: 0
            }
        },
        computed: {
            totalPages: function () {
                return Math.floor(this.total / this.limit)
            },
            showLess: function () {
                return (this.total / this.limit) > 1 && (this.total / this.limit) > this.currentPage + 1;
            },
            showMore: function () {
                return this.currentPage > 0;
            },
            showCurrentPage: function () {
                return this.currentPage + 1;
            },
            nextPage: function () {
                return this.currentPage + 1;
            },
            prevPage: function () {
                return this.currentPage - 1;
            }
        },
        created() {
            this.getWorks();
        },
        methods: {
            async getWorks() {
                http.transport('/api/manager/work/list/' + this.currentPage).then(response => {
                    this.workList = response.items;
                    this.total = response.total;
                    this.limit = response.limit;
                });
            },
            deleteWork(id) {
                http.transport('/api/manager/work/' + id + '/delete').then(response => {
                    if (response.success) {
                        this.getWorks();
                    }
                })
            },
            toggleApprove(id) {
                http.transport('/api/manager/work/approve/' + id).then(response => {
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
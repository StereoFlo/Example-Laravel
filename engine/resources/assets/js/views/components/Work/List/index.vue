<template>
    <div class="panel panel-default">
        <div class="panel-heading">
            Работы
        </div>
        <div class="panel-body">
            <div v-if="workList && workList.length > 0">
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
                <pgn-btns :pgn-sets="pgnSets" :action="getWorks"></pgn-btns>
            </div>
            <p v-else>Работ пока нет</p>
        </div>
    </div>
</template>

<script>
    import http from "../../../../services/http";
    import pgn from 'vue-pagination-btns';

    export default {
        mixins: [pgn],
        data() {
            return {
                currentPage: this.$route.params.page || 0,
                workList: [],
                total: 0,
                limit: 0
            }
        },
        created() {
            this.getWorks();
        },
        methods: {
            async getWorks(params) {
                http.transport('/api/manager/work/list/', params).then(response => {
                    this.workList = response.items;
                    this.pgnSets.total = response.total;
                    this.pgnSets.limit = response.limit;
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
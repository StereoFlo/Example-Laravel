<template>
    <div class="panel panel-default">
        <div class="panel-heading">Просмотр пользователя {{ user.name }}</div>
        <div class="panel-body">
            <p>
                Включенеые роли:
            </p>
            <ul v-for="role in userRoles">
                <li v-if="userRoles.length > 1">{{ role.name }} (<a @click.prevent="removeRole(user.id, role.id)" href="#">Выключить</a>) </li>
                <li v-else>{{ role.name }}</li>
            </ul>
            <p>
                Выключенеые роли:
            </p>
            <ul v-for="role in roles">
                <li>{{ role.name }} (<a @click.prevent="addRole(user.id, role.id)" href="#">Включить</a>)</li>
            </ul>
            <p v-if="!works.length">У пользователя нет работ</p>
            <div v-else>
                <p>
                    Работы пользователя ({{works.length}})
                </p>
                <table class="table table-hover table-responsive">
                    <tr>
                        <td>ID</td>
                        <td>Название</td>
                        <td>Проверена</td>
                        <td>Действия</td>
                    </tr>
                    <tr v-for="work in works">
                        <td>{{ work.id }}</td>
                        <td>{{ work.workName }}</td>
                        <td>
                            <span v-if="work.approved">Да</span>
                            <span v-if="!work.approved">Нет</span>
                        </td>
                        <td>
                            <a :href="'/cabinet/work/' + work.id">Открыть</a> |
                            <a :href="'/cabinet/work/' + work.id + '/edit'">Изменить</a> |
                            <a @click.prevent="deleteWork(news.id)" href="#">Удалить</a>
                        </td>
                    </tr>
                </table>
            </div>
            <p>Действия:</p>
            <a @click.prevent="removeUser(user.id)" href="">Удалить</a>
            <i>Внимание! Удаление пользователя приведет к удалению всех его работ и прочего.</i>
        </div>
    </div>
</template>

<script>
    export default {
        data() {
            return {
                userId: this.$route.params.userId || null,
                user: {},
                works: [],
                userRoles: [],
                roles: [],
            }
        },
        created() {
            this.getUser();
        },
        methods: {
            getUser() {
                this.$http.get('/api/manager/user/' + this.userId).then(response => {
                    this.user = response.body.user;
                    this.works = response.body.works;
                    this.userRoles = response.body.userRoles;
                    this.roles = response.body.roles;
                });
            },
            async removeRole(userId, roleId) {
                this.$http.get('/api/manager/user/role/remove/' + userId + '/' + roleId).then(response => {
                    if (response.ok) {
                        this.getUser();
                    }
                });
            },
            async addRole(userId, roleId) {
                this.$http.get('/api/manager/user/role/add/' + userId + '/' + roleId).then(response => {
                    if (response.ok) {
                        this.getUser();
                    }
                });
            },
            async removeUser(userId) {
                this.$http.get('/api/manager/user/' + userId + '/remove').then(response => {
                    if (response.ok) {
                        this.$router.push({ name: 'userList' })
                    }
                });
            }
        }
    }
</script>

<style scoped>

</style>
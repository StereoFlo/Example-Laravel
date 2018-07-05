<template>
    <div class="panel panel-default">
        <div class="panel-heading">Просмотр пользователя {{ user.user.name }}</div>
        <div class="panel-body">
            <p>
                Включенеые роли:
            </p>
            <ul v-for="role in user.userRoles">
                <li v-if="user.userRoles.length > 1">{{ role.name }} (<a @click.prevent="removeRole(user.user.id, role.id)" href="#">Выключить</a>) </li>
                <li v-else>{{ role.name }}</li>
            </ul>
            <p>
                Выключенеые роли:
            </p>
            <ul v-for="role in user.roles">
                <li>{{ role.name }} (<a @click.prevent="addRole(user.user.id, role.id)" href="#">Включить</a>)</li>
            </ul>
            <p v-if="!user.works.length">У пользователя нет работ</p>
            <div v-if="user.works.length">
                <p>
                    Работы пользователя ({{user.works.length}})
                </p>
                <ul v-for="work in user.works">
                    <li>{{ work.workName }}</li>
                </ul>
            </div>
            <p>Действия:</p>
            <a @click.prevent="removeUser(user.user.id)" href="">Удалить</a>
            <i>Внимание! Удаление пользователя приведет к удалению всех его работ и прочего.</i>
        </div>
    </div>
</template>

<script>
    import http from "../../../../services/http";

    export default {
        data() {
            return {
                userId: this.$route.params.userId || null,
                user: {},
            }
        },
        created() {
            this.getUser();
        },
        methods: {
            async getUser() {
                http.transport('/api/manager/user/' + this.userId).then(response => {
                    this.user = response;
                });
            },
            async removeRole(userId, roleId) {
                http.transport('/api/manager/user/role/remove/' + userId + '/' + roleId).then(response => {
                    if (response.success) {
                        this.getUser();
                    }
                });
            },
            async addRole(userId, roleId) {
                http.transport('/api/manager/user/role/add/' + userId + '/' + roleId).then(response => {
                    if (response.success) {
                        this.getUser();
                    }
                });
            },
            async removeUser(userId) {
                http.transport('/api/manager/user/' + userId + '/remove').then(response => {
                    if (response.success) {
                        this.$router.push({ name: 'userList' })
                    }
                });
            }
        }
    }
</script>

<style scoped>

</style>
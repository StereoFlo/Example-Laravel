<template>
    <div class="panel panel-default">
        <div class="panel-heading">Зарегистрированные пользователи</div>
        <div class="panel-body">
            <table class="table table-hover table-responsive">
                <tr>
                    <td>ID1</td>
                    <td>Имя</td>
                    <td>email</td>
                    <td>Ативен</td>
                </tr>
                <tr v-for="user in userList">
                    <td>{{ user.id }}</td>
                    <td>{{ user.name }}</td>
                    <td>{{ user.email }}</td>
                    <td>
                        <span v-if="!user.isActive">не активен</span>
                        <span v-else>активен</span>
                    </td>
                    <td>
                        <router-link :to="{ name: 'userShow', params: {userId: user.id} }">
                            Просмотр
                        </router-link>
                    </td>
                </tr>
            </table>
        </div>
    </div>
</template>

<script>
    import http from "../../../../services/http";

    export default {
        name: "index",
        data() {
            return {
                userList: [],
            }
        },
        created() {
            this.getUsers();
        },
        methods: {
            async getUsers() {
                http.transport('/api/manager/user/list').then(response => {
                    this.userList = response;
                });
            }
        }
    }
</script>
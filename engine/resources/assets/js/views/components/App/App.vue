<template>
    <div class="container">
        <div class="row">
            <div class="col-md-3 col-sm-12 sidebar">
                <div class="mini-submenu">
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </div>
                <div class="list-group">
                    <span href="#" class="list-group-item active">
                        Меню админа
                        <span class="pull-right" id="slide-submenu">
                            <i class="fa fa-times"></i>
                        </span>
                    </span>
                    <router-link :to="{ name: 'home' }" class="list-group-item">
                        <i class="fa fa-comment-o"></i> Главная
                    </router-link>
                    <router-link :to="{ name: 'settings' }" class="list-group-item">
                        <i class="fa fa-comment-o"></i> Настройки
                    </router-link>
                    <router-link :to="{ name: 'materials' }" class="list-group-item">
                        <i class="fa fa-comment-o"></i> Материалы
                    </router-link>
                    <router-link :to="{ name: 'pagesList' }" class="list-group-item">
                        <i class="fa fa-comment-o"></i> Страницы
                    </router-link>
                    <router-link :to="{ name: 'catalog' }" class="list-group-item">
                        <i class="fa fa-comment-o"></i> Категории
                    </router-link>
                    <a href="#" class="list-group-item">
                        <i class="fa fa-comment-o"></i> Новости <span class="badge">0</span>
                    </a>
                    <a href="#" class="list-group-item">
                        <i class="fa fa-comment-o"></i> Работы <span class="badge">0</span>
                    </a>
                </div>
            </div>
            <div class="col-md-8 col-md-offset-0">
                <router-view></router-view>
            </div>
        </div>
    </div>

</template>
<script>
    export default {}
</script>
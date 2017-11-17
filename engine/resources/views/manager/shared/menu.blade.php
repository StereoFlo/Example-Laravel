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
        <a href="{{ route('managerUserList') }}" class="list-group-item">
            <i class="fa fa-comment-o"></i> Пользователи <span class="badge">{{ $userCount }}</span>
        </a>
        <a href="{{ route('sloganIndex') }}" class="list-group-item">
            <i class="fa fa-comment-o"></i> Слоган
        </a>
        <a href="{{ route('managerPageList') }}" class="list-group-item">
            <i class="fa fa-comment-o"></i> Страницы
        </a>
        <a href="{{ route('managerCatalogList') }}" class="list-group-item">
            <i class="fa fa-comment-o"></i> Каталог
        </a>
        <a href="{{ route('newsList') }}" class="list-group-item">
            <i class="fa fa-comment-o"></i> Новости <span class="badge">{{ $newsCount }}</span>
        </a>
        <a href="{{ route('workListManager') }}" class="list-group-item">
            <i class="fa fa-comment-o"></i> Работы <span class="badge">{{ $workCount }}</span>
        </a>
    </div>
</div>
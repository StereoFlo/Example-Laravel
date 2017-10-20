@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-sm-4 col-md-3 sidebar">
                <div class="mini-submenu">
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </div>
                <div class="list-group">
                    <span href="#" class="list-group-item active">
                        Submenu
                        <span class="pull-right" id="slide-submenu">
                            <i class="fa fa-times"></i>
                        </span>
                    </span>
                    <a href="#" class="list-group-item">
                        <i class="fa fa-comment-o"></i> Lorem ipsum
                    </a>
                    <a href="#" class="list-group-item">
                        <i class="fa fa-folder-open-o"></i> Lorem ipsum <span class="badge">14</span>
                    </a>
                </div>
            </div>
            <div class="col-md-8 col-md-offset-0">
                <div class="panel panel-default">
                    <div class="panel-heading">Зарегистрированные пользователи</div>
                    <div class="panel-body">
                        <? if (empty($users)) { ?>
                        <p>У вас пока нет работ</p>
                        <? } else { ?>
                        <table class="table table-hover table-responsive">
                            <thead>
                                <td>ID</td>
                                <td>Имя</td>
                                <td>email</td>
                                <td>Роль</td>
                            </thead>
                            <? foreach ($users as $user) { ?>
                            <tr>
                                <td><?= $user['id'] ?></td>
                                <td><?= $user['name'] ?></td>
                                <td><?= $user['email'] ?></td>
                                <td><?= $user['roleName'] ?></td>
                            </tr>
                            <? } ?>
                        </table>
                        <? } ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

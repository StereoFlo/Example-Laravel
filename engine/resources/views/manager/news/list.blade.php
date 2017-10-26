@extends('layouts.bootstrap')

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
                    <div class="panel-heading">Новости (<a href="{{ route('newsNew') }}">Добавить</a>)</div>
                    <div class="panel-body">
                        @if (empty($news))
                        <p>Новостей пока нет</p>
                        @else
                        <table class="table table-hover table-responsive">
                            <tr>
                                <td>ID</td>
                                <td>Название</td>
                                <td>Котент</td>
                                <td>Действия</td>
                            </tr>
                            @foreach ($news as $item)
                                <tr>
                                    <td>{{ $item['id'] }}</td>
                                    <td>{{ $item['name'] }}</td>
                                    <td>{{ $item['content'] }}</td>
                                    <td><a href="{{ route('newsUpdate', ['id' => $item['id']]) }}">Изменить</a> | <a href="{{ route('newsDelete', ['id' => $item['id']]) }}">Удалить</a></td>
                                </tr>
                            @endforeach
                        </table>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

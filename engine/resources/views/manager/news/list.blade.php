@extends('layouts.manager')

@section('content')
    <div class="container">
        <div class="row">
            @include('manager.shared.menu')
            <div class="col-md-8 col-md-offset-0">
                <div class="panel panel-default">
                    <div class="panel-heading">Новости (<a href="{{ route('newsNew') }}">Добавить</a>)</div>
                    <div class="panel-body">
                        <p>{{ session('newsFlash') }}</p>
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
                                        <td><a href="{{ route('newsUpdate', ['id' => $item['id']]) }}">Изменить</a> | <a
                                                    href="{{ route('newsDelete', ['id' => $item['id']]) }}">Удалить</a></td>
                                    </tr>
                                @endforeach
                            </table>
                        @endif
                        <ul class="pagination">
                            @if($currentPage > 0)
                                <li><a href="{{ route('newsListPage', ['id' => $currentPage - 1]) }}">«</a></li>
                            @endif
                            @if(($newsCount / $parPage) > 0 && ($newsCount / $parPage) > $currentPage )
                                <li><a href="{{ route('newsListPage', ['id' => $currentPage + 1]) }}">»</a></li>
                            @endif
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

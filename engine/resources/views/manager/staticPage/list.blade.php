@extends('layouts.manager')

@section('content')
    <div class="container">
        <div class="row">
            @include('manager.shared.menu')
            <div class="col-md-8 col-md-offset-0">
                <div class="panel panel-default">
                    <div class="panel-heading">Страницы (<a href="{{ route('managerPageNew') }}">Добавить</a>)</div>
                    <div class="panel-body">
                        <p>{{ session('pageFlash') }}</p>
                        @if (empty($pages))
                            <p>Страниц пока нет</p>
                        @else
                            <table class="table table-hover table-responsive">
                                <tr>
                                    <td>ID</td>
                                    <td>Название</td>
                                    <td>Действия</td>
                                </tr>
                                @foreach ($pages as $page)
                                    <tr>
                                        <td>{{ $page['slug'] }}</td>
                                        <td>{{ $page['name'] }}</td>
                                        <td><a href="{{ route('managerPageEdit', ['id' => $page['slug']]) }}">Изменить</a> |
                                            <a href="{{ route('managerPageDelete', ['id' => $page['slug']]) }}">Удалить</a></td>
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

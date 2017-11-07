@extends('layouts.manager')

@section('content')
    <div class="container">
        <div class="row">
            @include('manager.shared.menu')
            <div class="col-md-8 col-md-offset-0">
                <div class="panel panel-default">
                    <div class="panel-heading">Категории (<a href="{{ route('managerCatalogAdd') }}">Добавить</a>)</div>
                    <div class="panel-body">
                        <p>{{ session('flash') }}</p>
                        @if (empty($categories))
                        <p>Категорий пока нет</p>
                        @else
                        <table class="table table-hover table-responsive">
                            <tr>
                                <td>ID</td>
                                <td>Название</td>
                                <td>Действия</td>
                            </tr>
                            @foreach ($categories as $category)
                                <tr>
                                    <td>{{ $category['id'] }}</td>
                                    <td>{{ $category['name'] }}</td>
                                    <td>
                                        <a href="{{ route('managerCatalogEdit', ['id' => $category['id']]) }}">Изменить</a> |
                                        <a href="{{ route('managerCatalogRemove', ['id' => $category['id']]) }}">Удалить</a>
                                    </td>
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

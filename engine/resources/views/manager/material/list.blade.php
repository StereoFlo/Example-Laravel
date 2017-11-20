@extends('layouts.manager')

@section('content')
    <div class="container">
        <div class="row">
            @include('manager.shared.menu')
            <div class="col-md-8 col-md-offset-0">
                <div class="panel panel-default">
                    <div class="panel-heading">Материалы (<a href="{{ route('managerMaterialAdd') }}">Добавить</a>)</div>
                    <div class="panel-body">
                        <p>{{ session('materialFlash') }}</p>
                        @if (empty($list))
                            <p>Материалов пока нет</p>
                        @else
                            <table class="table table-hover table-responsive">
                                <tr>
                                    <td>ID</td>
                                    <td>Название</td>
                                    <td>Действия</td>
                                </tr>
                                @foreach ($list as $page)
                                    <tr>
                                        <td>{{ $page['name'] }}</td>
                                        <td>{{ $page['url'] }}</td>
                                        <td>
                                            {{--<a href="{{ route('managerMaterialEdit', ['id' => $page['id']]) }}">Изменить</a> | --}}
                                            <a href="{{ route('managerMaterialRemove', ['id' => $page['id']]) }}">Удалить</a></td>
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

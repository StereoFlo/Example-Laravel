@extends('layouts.manager')

@section('content')
    <div class="container">
        <div class="row">
            @include('manager.shared.menu')
            <div class="col-md-8 col-md-offset-0">
                <div class="panel panel-default">
                    <div class="panel-heading">Не проверенные работы</div>
                    <div class="panel-body">
                        @if (empty($works))
                            <p>Пользователей нет! Что оооочень странно.</p>
                        @else
                            <table class="table table-hover table-responsive">
                                <tr>
                                    <td>ID</td>
                                    <td>Имя</td>
                                    <td>автор</td>
                                    <td>Просмотреть</td>
                                </tr>
                                @foreach ($works as $work)
                                    <tr>
                                        <td>{{ $work['id'] }}</td>
                                        <td>{{ $work['workName'] }}</td>
                                        <td>{{ $work['userName'] }}</td>
                                        <td><a href="{{ route('workShow', ['id' => $work['id']]) }}">show</a> </td>
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

@extends('layouts.manager')

@section('content')
    <div class="container">
        <div class="row">
            @include('manager.shared.menu')
            <div class="col-md-8 col-md-offset-0">
                <div class="panel panel-default">
                    <div class="panel-heading">Зарегистрированные пользователи</div>
                    <div class="panel-body">
                        @if (empty($users))
                        <p>Пользователей нет! Что оооочень странно.</p>
                        @else
                        <table class="table table-hover table-responsive">
                            <tr>
                                <td>ID1</td>
                                <td>Имя</td>
                                <td>email</td>
                                <td>Ативен</td>
                            </tr>
                            @foreach ($users as $user)
                                <tr>
                                    <td>{{ $user['id'] }}</td>
                                    <td>{{ $user['name'] }}</td>
                                    <td>{{ $user['email'] }}</td>
                                    <td>
                                        @if(empty($user['isActive']))
                                            не активен
                                        @else
                                            активен
                                        @endif
                                    </td>
                                    <td><a href="{{ url('manager/user/show/' . $user['id']) }}">show</a> </td>
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

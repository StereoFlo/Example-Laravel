@extends('layouts.manager')

@section('content')
    <div class="container">
        <div class="row">
            @include('manager.shared.menu')
            <div class="col-md-8 col-md-offset-0">
                <div class="panel panel-default">
                    <div class="panel-heading">Просмотр пользователя {{ $user['name'] }}</div>
                    <div class="panel-body">
                        <p>
                            Включенеые роли:<br>
                            <ul>
                            @foreach($userRoles as $userRole)
                                @if(count($userRoles) > 1)
                                    <li>{{$userRole['name']}} (<a href="{{ url('/manager/user/role/remove/' . $user['id'] . '/' . $userRole['id']) }}">Выключить</a>)</li>
                                @else
                                    <li>{{$userRole['name']}}</li>
                                @endif
                            @endforeach
                            </ul>
                        </p>
                        <p>
                            Выключенеые роли:<br>
                        <ul>
                            @foreach($roles as $role)
                                <li>{{$role['name']}} (<a href="{{ url('/manager/user/role/add/' . $user['id'] . '/' . $role['id']) }}">Включить</a>)</li>
                            @endforeach
                        </ul>
                        </p>
                        <p>Работы пользователя</p>
                        @if(empty($works))
                            У пользователя нет пока работ
                        @else
                            <? var_dump($works); ?>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

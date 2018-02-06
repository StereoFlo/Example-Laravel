@extends('layouts.manager')

@section('content')
    <div class="container">
        <div class="row">
            @include('manager.shared.menu')
            <div class="col-md-8 col-md-offset-0">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <a href="{{ route('workListManager') }}">Все</a> |
                        <a href="{{ route('workListUnapprovedManager') }}">Не проверенные работы</a> |
                        <a href="{{ route('workListManagerApproved') }}">Проверенные</a>
                    </div>
                    <div class="panel-body">
                        @if (empty($works))
                            <p>Работ нет у этого автора нет</p>
                        @else
                            <table class="table table-hover table-responsive">
                                <tr>
                                    <td>ID</td>
                                    <td>Имя</td>
                                    <td>автор</td>
                                    <td>Проверена</td>
                                    <td>Действия</td>
                                </tr>
                                @foreach ($works as $work)
                                    <tr>
                                        <td>{{ $work['id'] }}</td>
                                        <td>{{ $work['workName'] }}</td>
                                        <td>
                                            <a href="{{ route('workListAuthorManager', ['id' => $work['userId']]) }}">{{ $work['userName'] }}</a>
                                        </td>
                                        <td>
                                            <input data-url="{{ route('managerWorkApprove', ['workId' => $work['id']]) }}" id="work_{{ $work['id'] }}" type="checkbox" {{ empty($work['approved']) ? null : 'checked' }}>
                                        </td>
                                        <td>
                                            <a href="{{ route('workShow', ['id' => $work['id']]) }}">Открыть</a> |
                                            <a href="{{ route('workEdit', ['id' => $work['id']]) }}">Изменить</a> |
                                            <a href="{{ route('managerWorkRemove', ['workId' => $work['id']]) }}">Удалить</a>
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

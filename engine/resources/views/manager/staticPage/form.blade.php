@extends('layouts.manager')

@section('content')

    {{--сюда возвращается переменная $page - может быть пустой--}}

    <div class="container">
        <div class="row">
            @include('manager.shared.menu')
            <div class="col-md-8 col-md-offset-0">
                <div class="panel panel-default">
                    <div class="panel-heading">Форма новости</div>
                    <div class="panel-body">
                        <form class="form-horizontal" method="POST" action="{{ route('managerPageProcess') }}">
                            {{ csrf_field() }}
                            <p>{{ session('pageFlash') }}</p>
                            <div class="form-group">
                                <label for="slug" class="col-md-4 control-label">Url страницы</label>
                                <div class="col-md-6">
                                    <input id="slug" type="text" class="form-control" name="slug" value="{{ isset($page['slug']) ? $page['slug'] : ''}}" required autofocus>
                                    @if ($errors->has('slug'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('slug') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="name" class="col-md-4 control-label">Название</label>
                                <div class="col-md-6">
                                    <input id="name" type="text" class="form-control" name="name" value="{{ isset($page['name']) ? $page['name'] : ''}}" required autofocus>
                                    @if ($errors->has('name'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="content" class="col-md-4 control-label">Содержание</label>
                                <div class="col-md-6">
                                    <textarea id="content" class="form-control" name="content">{{ isset($page['content']) ? $page['content'] : null }}</textarea>
                                    @if ($errors->has('content'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('content') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>
                            @if(!empty($page))
                                <input type="hidden" name="id" value="{{$page['slug']}}">
                            @endif
                            <div class="form-group">
                                <div class="col-md-8 col-md-offset-4">
                                    <button type="submit" class="btn btn-primary">
                                        OK
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

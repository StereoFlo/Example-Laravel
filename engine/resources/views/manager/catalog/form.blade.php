@extends('layouts.manager')

@section('content')
    <div class="container">
        <div class="row">
            @include('manager.shared.menu')
            <div class="col-md-8 col-md-offset-0">
                <div class="panel panel-default">
                    <div class="panel-heading">Добавление категории</div>
                    <div class="panel-body">
                        <form class="form-horizontal" method="POST" action="{{ route('managerCatalogProcess') }}">
                            {{ csrf_field() }}
                            <p>{{ session('flash') }}</p>
                            <div class="form-group">
                                <label for="name" class="col-md-4 control-label">Название</label>
                                <div class="col-md-6">
                                    <input id="name" type="text" class="form-control" name="name" value="{{ isset($category['name']) ? $category['name'] : ''}}" required autofocus>
                                    @if ($errors->has('name'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="content" class="col-md-4 control-label">Описание</label>
                                <div class="col-md-6">
                                    <textarea id="description" class="form-control" name="description">{{ isset($category['description']) ? $category['description'] : null }}</textarea>
                                    @if ($errors->has('description'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('description') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>
                            @if(!empty($category))
                                <input type="hidden" name="id" value="{{$category['id']}}">
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

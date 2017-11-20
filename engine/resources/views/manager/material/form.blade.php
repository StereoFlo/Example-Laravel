@extends('layouts.manager')

@section('content')
    <div class="container">
        <div class="row">
            @include('manager.shared.menu')
            <div class="col-md-8 col-md-offset-0">
                <div class="panel panel-default">
                    <div class="panel-heading">Добавить материал</div>
                    <div class="panel-body">
                        <form class="form-horizontal" method="POST" action="{{ route('managerMaterialProcess') }}" enctype="multipart/form-data">
                            {{ csrf_field() }}
                            <p>{{ session('materialFlash') }}</p>
                            <div class="form-group">
                                <label for="name" class="col-md-4 control-label">Название</label>
                                <div class="col-md-6">
                                    <input id="name" type="text" class="form-control" name="name" value="{{ isset($material['name']) ? $material['name'] : ''}}" required autofocus>
                                    @if ($errors->has('name'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="file" class="col-md-4 control-label">Изображение</label>
                                <div class="col-md-6">
                                    <input type="file" name="file" id="file">
                                    @if ($errors->has('file'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('file') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="description" class="col-md-4 control-label">Описание</label>
                                <div class="col-md-6">
                                    <textarea id="description" class="form-control" name="description">{{ isset($material['description']) ? $material['description'] : null }}</textarea>
                                    @if ($errors->has('description'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('description') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>
                            @if(!empty($material))
                                <input type="hidden" name="id" value="{{$material['id']}}">
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

@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Добавление новой работы</div>
                {{ session('addWorkResult') }}
                <div class="panel-body">
                    <form class="form-horizontal" method="POST" action="{{ route('workAddProcess') }}" enctype="multipart/form-data">
                        {{ csrf_field() }}

                        <div class="form-group{{ $errors->has('workName') ? ' has-error' : '' }}">
                            <label for="workName" class="col-md-4 control-label">Наименование</label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control" name="workName" value="" required autofocus>

                                @if ($errors->has('workName'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('workName') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('description') ? ' has-error' : '' }}">
                            <label for="description" class="col-md-4 control-label">Описание работы</label>

                            <div class="col-md-6">
                                <textarea id="name" class="form-control" name="description"></textarea>

                                @if ($errors->has('description'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('description') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group{{ $errors->has('images') ? ' has-error' : '' }}">
                            <label for="images" class="col-md-4 control-label">Ищображения</label>

                            <div class="col-md-6">
                                <input type="file" name="images[]" id="images" class="form-control" value="{{ old('images') }}" multiple>

                                @if ($errors->has('images'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('images') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>


                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <button type="submit" class="btn btn-primary">
                                    Добавить
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

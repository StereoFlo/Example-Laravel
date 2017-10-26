@extends('layouts.bootstrap')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-sm-4 col-md-3 sidebar">
                <div class="mini-submenu">
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </div>
                <div class="list-group">
                    <span href="#" class="list-group-item active">
                        Submenu
                        <span class="pull-right" id="slide-submenu">
                            <i class="fa fa-times"></i>
                        </span>
                    </span>
                    <a href="#" class="list-group-item">
                        <i class="fa fa-comment-o"></i> Lorem ipsum
                    </a>
                    <a href="#" class="list-group-item">
                        <i class="fa fa-folder-open-o"></i> Lorem ipsum <span class="badge">14</span>
                    </a>
                </div>
            </div>
            <div class="col-md-8 col-md-offset-0">
                <div class="panel panel-default">
                    <div class="panel-heading">Форма новости</div>
                    <div class="panel-body">
                        <form class="form-horizontal" method="POST" action="{{ route('newsProcess') }}">
                            {{ csrf_field() }}
                            <div class="form-group">
                                <label for="name" class="col-md-4 control-label">Название</label>
                                <div class="col-md-6">
                                    <input id="name" type="text" class="form-control" name="name" value="<?= isset($news['name']) ? $news['name'] : ''?>" required autofocus>
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
                                    <textarea id="content" name="content">
                                        <?= isset($news['content']) ? $news['content'] : ''?>"
                                    </textarea>

                                    @if ($errors->has('content'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('content') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>
                            @if(!empty($news))
                                <input type="hidden" name="id" value="{{$news['id']}}">
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

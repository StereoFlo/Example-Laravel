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
                    <div class="panel-heading">Слоган</div>
                    <div class="panel-body">
                        <p>{{ session('sloganUpdate') }}</p>
                        <form method="post" action="{{ route('sloganUpdate') }}" enctype="multipart/form-data" class="form registrationForm">
                            {{ csrf_field() }}
                        <textarea name="content">
                            {{ $content }}
                        </textarea>
                            <button type="submit" name="button" class="button">Обновить</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

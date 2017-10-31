@extends('layouts.manager')

@section('content')
    <div class="container">
        <div class="row">
            @include('manager.shared.menu')
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

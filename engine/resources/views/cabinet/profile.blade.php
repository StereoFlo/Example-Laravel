@extends('layouts.app')

@section('content')
<section class="userRegistration">
    <div class="container">
        {{ session('updateResult') }}
        <form method="POST" action="{{ route('profileUpdate') }}" enctype="multipart/form-data" class="form registrationForm">
            {{ csrf_field() }}

            <div class="inputGroup{{ $errors->has('name') ? ' has-error' : '' }}">
                <label for="name">логин:</label>
                <input id="name" type="text" name="name" value="{{ Auth::user()->name }}" required autofocus>
                @if ($errors->has('name'))
                    <span class="errorText">
                        <strong>{{ $errors->first('name') }}</strong>
                    </span>
                @endif
            </div>

            <div class="inputGroup{{ $errors->has('location') ? ' has-error' : '' }}">
                <label for="location">location</label>
                <input type="text" name="location" value="{{ Auth::user()->location }}">
                @if ($errors->has('location'))
                    <span class="errorText">
                        <strong>{{ $errors->first('location') }}</strong>
                    </span>
                @endif
            </div>

            <div class="inputGroup{{ $errors->has('phone') ? ' has-error' : '' }}">
                <label for="phone">телефон:</label>
                <input type="text" name="phone" value="{{ Auth::user()->phone }}">
                @if ($errors->has('phone'))
                    <span class="errorText">
                        <strong>{{ $errors->first('phone') }}</strong>
                    </span>
                @endif
            </div>

            <div class="inputGroup{{ $errors->has('about') ? ' has-error' : '' }}">
                <label for="about">о себе:</label>
                <textarea name="about" rows="8" cols="80">{{ Auth::user()->about }}</textarea>
                @if ($errors->has('about'))
                    <span class="errorText">
                        <strong>{{ $errors->first('about') }}</strong>
                    </span>
                @endif
            </div>

            <? if (empty(Auth::user()->avatar)) { ?>
            <div class="inputGroup{{ $errors->has('avatar') ? ' has-error' : '' }}">
                <label for="avatar">фото:</label>
                <input type="file" name="avatar" value="{{ Auth::user()->avatar }}">
                @if ($errors->has('avatar'))
                    <span class="errorText">
                        <strong>{{ $errors->first('avatar') }}</strong>
                    </span>
                @endif
            </div>
            <? } else { ?>
                <img src="{{ Auth::user()->avatar }}">
                <a href="">delete</a>
            <? } ?>

            <div class="inputGroup{{ $errors->has('email') ? ' has-error' : '' }}">
                <label for="email">email:</label>
                <input type="text" name="email" value="{{ Auth::user()->email }}" required>
                @if ($errors->has('email'))
                    <span class="errorText">
                        <strong>{{ $errors->first('email') }}</strong>
                    </span>
                @endif
            </div>

            <div class="inputGroup{{ $errors->has('password') ? ' has-error' : '' }}">
                <label for="password">пароль:</label>
                <input type="text" name="password" value="">
                @if ($errors->has('password'))
                    <span class="errorText">
                        <strong>{{ $errors->first('password') }}</strong>
                    </span>
                @endif
            </div>
            <div class="inputGroup{{ $errors->has('password') ? ' has-error' : '' }}">
                <label for="password">пароль:</label>
                <input type="text" name="password_confirmation" value="">
                @if ($errors->has('password'))
                    <span class="errorText">
                        <strong>{{ $errors->first('password') }}</strong>
                    </span>
                @endif
            </div>

            <button type="submit" name="button" class="button">регистрация</button>
        </form>

        {{--<div class="row">--}}
            {{--<div class="col-md-8 col-md-offset-2">--}}
                {{--<div class="panel panel-default">--}}
                    {{--<div class="panel-heading">Register</div>--}}
                    {{--{{ session('updateResult') }}--}}
                    {{--<div class="panel-body">--}}
                        {{--<form class="form-horizontal" method="POST" action="{{ route('profileUpdate') }}" enctype="multipart/form-data">--}}
                            {{--{{ csrf_field() }}--}}

                            {{--<div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">--}}
                                {{--<label for="name" class="col-md-4 control-label">Name</label>--}}

                                {{--<div class="col-md-6">--}}
                                    {{--<input id="name" type="text" class="form-control" name="name" value="{{ Auth::user()->name }}" required autofocus>--}}

                                    {{--@if ($errors->has('name'))--}}
                                        {{--<span class="help-block">--}}
                                        {{--<strong>{{ $errors->first('name') }}</strong>--}}
                                    {{--</span>--}}
                                    {{--@endif--}}
                                {{--</div>--}}
                            {{--</div>--}}

                            {{--<div class="form-group{{ $errors->has('location') ? ' has-error' : '' }}">--}}
                                {{--<label for="name" class="col-md-4 control-label">Location</label>--}}

                                {{--<div class="col-md-6">--}}
                                    {{--<input id="name" type="text" class="form-control" name="location" value="{{ Auth::user()->location }}">--}}

                                    {{--@if ($errors->has('location'))--}}
                                        {{--<span class="help-block">--}}
                                        {{--<strong>{{ $errors->first('location') }}</strong>--}}
                                    {{--</span>--}}
                                    {{--@endif--}}
                                {{--</div>--}}
                            {{--</div>--}}

                            {{--<div class="form-group{{ $errors->has('phone') ? ' has-error' : '' }}">--}}
                                {{--<label for="name" class="col-md-4 control-label">Phone</label>--}}

                                {{--<div class="col-md-6">--}}
                                    {{--<input id="name" type="text" class="form-control" name="phone" value="{{ Auth::user()->phone }}">--}}

                                    {{--@if ($errors->has('phone'))--}}
                                        {{--<span class="help-block">--}}
                                        {{--<strong>{{ $errors->first('phone') }}</strong>--}}
                                    {{--</span>--}}
                                    {{--@endif--}}
                                {{--</div>--}}
                            {{--</div>--}}

                            {{--<div class="form-group{{ $errors->has('about') ? ' has-error' : '' }}">--}}
                                {{--<label for="name" class="col-md-4 control-label">about</label>--}}

                                {{--<div class="col-md-6">--}}
                                    {{--<textarea id="name" class="form-control" name="about">{{ Auth::user()->about }}</textarea>--}}

                                    {{--@if ($errors->has('about'))--}}
                                        {{--<span class="help-block">--}}
                                        {{--<strong>{{ $errors->first('about') }}</strong>--}}
                                    {{--</span>--}}
                                    {{--@endif--}}
                                {{--</div>--}}
                            {{--</div>--}}

                            {{--<div class="form-group{{ $errors->has('avatar') ? ' has-error' : '' }}">--}}
                                {{--<label for="avatar" class="col-md-4 control-label">avatar</label>--}}

                                {{--<div class="col-md-6">--}}
                                    {{--<input type="file" name="avatar" id="avatar" class="form-control" value="{{ old('avatar') }}">--}}

                                    {{--@if ($errors->has('avatar'))--}}
                                        {{--<span class="help-block">--}}
                                        {{--<strong>{{ $errors->first('avatar') }}</strong>--}}
                                    {{--</span>--}}
                                    {{--@endif--}}
                                {{--</div>--}}
                            {{--</div>--}}

                            {{--<div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">--}}
                                {{--<label for="email" class="col-md-4 control-label">E-Mail Address</label>--}}

                                {{--<div class="col-md-6">--}}
                                    {{--<input id="email" type="email" class="form-control" name="email" value="{{ Auth::user()->email }}" required>--}}

                                    {{--@if ($errors->has('email'))--}}
                                        {{--<span class="help-block">--}}
                                        {{--<strong>{{ $errors->first('email') }}</strong>--}}
                                    {{--</span>--}}
                                    {{--@endif--}}
                                {{--</div>--}}
                            {{--</div>--}}

                            {{--<div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">--}}
                                {{--<label for="password" class="col-md-4 control-label">Password</label>--}}

                                {{--<div class="col-md-6">--}}
                                    {{--<input id="password" type="password" class="form-control" name="password">--}}

                                    {{--@if ($errors->has('password'))--}}
                                        {{--<span class="help-block">--}}
                                        {{--<strong>{{ $errors->first('password') }}</strong>--}}
                                    {{--</span>--}}
                                    {{--@endif--}}
                                {{--</div>--}}
                            {{--</div>--}}

                            {{--<div class="form-group">--}}
                                {{--<label for="password-confirm" class="col-md-4 control-label">Confirm Password</label>--}}

                                {{--<div class="col-md-6">--}}
                                    {{--<input id="password-confirm" type="password" class="form-control" name="password_confirmation">--}}
                                {{--</div>--}}
                            {{--</div>--}}

                            {{--<div class="form-group">--}}
                                {{--<div class="col-md-6 col-md-offset-4">--}}
                                    {{--<button type="submit" class="btn btn-primary">--}}
                                        {{--update--}}
                                    {{--</button>--}}
                                {{--</div>--}}
                            {{--</div>--}}
                        {{--</form>--}}
                    {{--</div>--}}
                {{--</div>--}}
            {{--</div>--}}
        {{--</div>--}}

    </div>
</section>
@endsection

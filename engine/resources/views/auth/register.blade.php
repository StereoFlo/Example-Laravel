@extends('layouts.app')

@section('content')
    <section class="register">
        <div class="container">
            <form class="registration registration_dark" method="POST" action="{{ route('register') }}" onsubmit="return false;">
                {{ csrf_field() }}

                <div class="inputGroup{{ $errors->has('name') ? ' has-error' : '' }}">
                    <label for="email">имя:</label>
                    <input id="name" class="registration__name" type="text" name="name" value="{{ old('name') }}" required autofocus>
                    <i class="fa fa-user" aria-hidden="true"></i>
                    <span class="errorText">
                @if ($errors->has('name'))
                            <strong>{{ $errors->first('name') }}</strong>
                        @endif
            </span>
                </div>

                <div class="inputGroup{{ $errors->has('location') ? ' has-error' : '' }}">
                    <label for="email">город:</label>
                    <input id="location" class="registration__location" type="text" name="location" value="{{ old('location') }}" required autofocus>
                    <i class="fa fa-user" aria-hidden="true"></i>
                    <span class="errorText">
                @if ($errors->has('location'))
                            <strong>{{ $errors->first('location') }}</strong>
                        @endif
            </span>
                </div>

                <div class="inputGroup{{ $errors->has('phone') ? ' has-error' : '' }}">
                    <label for="email">телефон:</label>
                    <input id="phone" class="registration__phone" type="text" name="phone" value="{{ old('phone') }}" required autofocus>
                    <i class="fa fa-user" aria-hidden="true"></i>
                    <span class="errorText">
                @if ($errors->has('phone'))
                            <strong>{{ $errors->first('phone') }}</strong>
                        @endif
            </span>
                </div>

                <div class="inputGroup{{ $errors->has('about') ? ' has-error' : '' }}">
                    <label for="email">о себе:</label>
                    <input id="about" class="registration__about" type="text" name="about" value="{{ old('about') }}" required autofocus>
                    <i class="fa fa-user" aria-hidden="true"></i>
                    <span class="errorText">
                @if ($errors->has('about'))
                            <strong>{{ $errors->first('about') }}</strong>
                        @endif
            </span>
                </div>

                <div class="inputGroup{{ $errors->has('email') ? ' has-error' : '' }}">
                    <label for="email">email:</label>
                    <input id="email" class="registration__email" type="email" name="email" value="{{ old('email') }}" required autofocus>
                    <i class="fa fa-user" aria-hidden="true"></i>
                    <span class="errorText">
                @if ($errors->has('email'))
                            <strong>{{ $errors->first('email') }}</strong>
                        @endif
            </span>
                </div>

                <div class="inputGroup{{ $errors->has('password') ? ' has-error' : '' }}">
                    <label for="password">пароль:</label>
                    <input id="password" class="registration__pass" type="password" name="password" required>
                    <i class="fa fa-unlock-alt" aria-hidden="true"></i>
                    <span class="errorText">
                @if ($errors->has('password'))
                            <strong>{{ $errors->first('password') }}</strong>
                        @endif
            </span>
                </div>

                <div class="inputGroup{{ $errors->has('password') ? ' has-error' : '' }}">
                    <label for="password_confirmation">пароль:</label>
                    <input id="password_confirmation" class="registration__pass" type="password" name="password_confirmation" required>
                    <i class="fa fa-unlock-alt" aria-hidden="true"></i>
                    <span class="errorText"></span>
                </div>

                <div class="registration__buttons">
                    <button id="ajaxRegistrationButton" type="button" name="button" class="button registration__enter">регистрация</button>
                </div>

                <a href="{{ route('login') }}" class="formToggle">Вход >></a>

            </form>
        </div>
    </section>
{{--<div class="container">--}}
    {{--<div class="row">--}}
        {{--<div class="col-md-8 col-md-offset-2">--}}
            {{--<div class="panel panel-default">--}}
                {{--<div class="panel-heading">Register</div>--}}

                {{--<div class="panel-body">--}}
                    {{--<form class="form-horizontal" method="POST" action="{{ route('register') }}">--}}
                        {{--{{ csrf_field() }}--}}

                        {{--<div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">--}}
                            {{--<label for="name" class="col-md-4 control-label">Name</label>--}}

                            {{--<div class="col-md-6">--}}
                                {{--<input id="name" type="text" class="form-control" name="name" value="{{ old('name') }}" required autofocus>--}}

                                {{--@if ($errors->has('name'))--}}
                                    {{--<span class="help-block">--}}
                                        {{--<strong>{{ $errors->first('name') }}</strong>--}}
                                    {{--</span>--}}
                                {{--@endif--}}
                            {{--</div>--}}
                        {{--</div>--}}

                        {{--<div class="form-group{{ $errors->has('location') ? ' has-error' : '' }}">--}}
                            {{--<label for="location" class="col-md-4 control-label">Location</label>--}}

                            {{--<div class="col-md-6">--}}
                                {{--<input id="location" type="text" class="form-control" name="location" value="{{ old('location') }}">--}}

                                {{--@if ($errors->has('location'))--}}
                                    {{--<span class="help-block">--}}
                                        {{--<strong>{{ $errors->first('location') }}</strong>--}}
                                    {{--</span>--}}
                                {{--@endif--}}
                            {{--</div>--}}
                        {{--</div>--}}

                        {{--<div class="form-group{{ $errors->has('phone') ? ' has-error' : '' }}">--}}
                            {{--<label for="phone" class="col-md-4 control-label">Phone</label>--}}

                            {{--<div class="col-md-6">--}}
                                {{--<input id="phone" type="text" class="form-control" name="phone" value="{{ old('phone') }}">--}}

                                {{--@if ($errors->has('phone'))--}}
                                    {{--<span class="help-block">--}}
                                        {{--<strong>{{ $errors->first('phone') }}</strong>--}}
                                    {{--</span>--}}
                                {{--@endif--}}
                            {{--</div>--}}
                        {{--</div>--}}

                        {{--<div class="form-group{{ $errors->has('about') ? ' has-error' : '' }}">--}}
                            {{--<label for="about" class="col-md-4 control-label">about</label>--}}

                            {{--<div class="col-md-6">--}}
                                {{--<input id="about" type="text" class="form-control" name="about" value="{{ old('about') }}">--}}

                                {{--@if ($errors->has('about'))--}}
                                    {{--<span class="help-block">--}}
                                        {{--<strong>{{ $errors->first('about') }}</strong>--}}
                                    {{--</span>--}}
                                {{--@endif--}}
                            {{--</div>--}}
                        {{--</div>--}}

                        {{--<div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">--}}
                            {{--<label for="email" class="col-md-4 control-label">E-Mail Address</label>--}}

                            {{--<div class="col-md-6">--}}
                                {{--<input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" required>--}}

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
                                {{--<input id="password" type="password" class="form-control" name="password" required>--}}

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
                                {{--<input id="password-confirm" type="password" class="form-control" name="password_confirmation" required>--}}
                            {{--</div>--}}
                        {{--</div>--}}

                        {{--<div class="form-group">--}}
                            {{--<div class="col-md-6 col-md-offset-4">--}}
                                {{--<button type="submit" class="btn btn-primary">--}}
                                    {{--Register--}}
                                {{--</button>--}}
                            {{--</div>--}}
                        {{--</div>--}}
                    {{--</form>--}}
                {{--</div>--}}
            {{--</div>--}}
        {{--</div>--}}
    {{--</div>--}}
{{--</div>--}}
@endsection

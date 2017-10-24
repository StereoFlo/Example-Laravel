@if(Auth::check())
    вы уже вошли
    {{auth-}}
@else
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

    <form id="ajaxRegistration" class="registration" method="POST" action="{{ route('register') }}" onsubmit="return false;">
        {{ csrf_field() }}

        <div class="inputGroup{{ $errors->has('name') ? ' has-error' : '' }}">
            <label for="email">email:</label>
            <input id="name" class="signIn__email" type="text" name="name" value="{{ old('name') }}" required autofocus>
            <i class="fa fa-user" aria-hidden="true"></i>
            <span class="errorText">
                @if ($errors->has('name'))
                    <strong>{{ $errors->first('name') }}</strong>
                @endif
            </span>
        </div>

        <div class="inputGroup{{ $errors->has('location') ? ' has-error' : '' }}">
            <label for="email">email:</label>
            <input id="location" class="signIn__email" type="text" name="location" value="{{ old('location') }}" required autofocus>
            <i class="fa fa-user" aria-hidden="true"></i>
            <span class="errorText">
                @if ($errors->has('location'))
                    <strong>{{ $errors->first('location') }}</strong>
                @endif
            </span>
        </div>

        <div class="inputGroup{{ $errors->has('phone') ? ' has-error' : '' }}">
            <label for="email">phone:</label>
            <input id="phone" class="signIn__email" type="text" name="phone" value="{{ old('phone') }}" required autofocus>
            <i class="fa fa-user" aria-hidden="true"></i>
            <span class="errorText">
                @if ($errors->has('phone'))
                    <strong>{{ $errors->first('phone') }}</strong>
                @endif
            </span>
        </div>

        <div class="inputGroup{{ $errors->has('about') ? ' has-error' : '' }}">
            <label for="email">email:</label>
            <input id="about" class="signIn__email" type="text" name="about" value="{{ old('about') }}" required autofocus>
            <i class="fa fa-user" aria-hidden="true"></i>
            <span class="errorText">
                @if ($errors->has('about'))
                    <strong>{{ $errors->first('about') }}</strong>
                @endif
            </span>
        </div>

        <div class="inputGroup{{ $errors->has('email') ? ' has-error' : '' }}">
            <label for="email">email:</label>
            <input id="email" class="signIn__email" type="email" name="email" value="{{ old('email') }}" required autofocus>
            <i class="fa fa-user" aria-hidden="true"></i>
            <span class="errorText">
                @if ($errors->has('email'))
                    <strong>{{ $errors->first('email') }}</strong>
                @endif
            </span>
        </div>

        <div class="inputGroup{{ $errors->has('password') ? ' has-error' : '' }}">
            <label for="password">пароль:</label>
            <input id="password" class="signIn__pass" type="password" name="password" required>
            <i class="fa fa-unlock-alt" aria-hidden="true"></i>
            <span class="errorText">
                @if ($errors->has('password'))
                    <strong>{{ $errors->first('password') }}</strong>
                @endif
            </span>
        </div>

        <div class="inputGroup{{ $errors->has('password') ? ' has-error' : '' }}">
            <label for="password_confirmation">пароль:</label>
            <input id="password_confirmation" class="signIn__pass" type="password" name="password_confirmation" required>
            <i class="fa fa-unlock-alt" aria-hidden="true"></i>
            <span class="errorText"></span>
        </div>

        <div class="inputGroup">
            <label for="remember">Запомнить e-mail ?</label><input type="checkbox" id="remember" name="remember" {{old('remember') ? 'checked' : ''}}/>
        </div>

        <div class="signIn__buttons">
            <button id="ajaxRegistrationButton" type="button" name="button" class="button registration__enter">регистрация</button>
        </div>

        <a href="#" class="signIn__toRegisterBtn">Регистрация</a>

    </form>
@endif
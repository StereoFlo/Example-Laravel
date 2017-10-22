{{--<div class="container">--}}
    {{--<div class="row">--}}
        {{--<div class="col-md-8 col-md-offset-2">--}}
            {{--<div class="panel panel-default">--}}
                {{--<div class="panel-heading">Login</div>--}}

                {{--<div class="panel-body">--}}
                    {{--<form id="ajaxLogin" class="form-horizontal" method="POST" action="{{ route('login') }}" onsubmit="return false;">--}}
                        {{--{{ csrf_field() }}--}}

                        {{--<div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">--}}
                            {{--<label for="email" class="col-md-4 control-label">E-Mail Address</label>--}}

                            {{--<div class="col-md-6">--}}
                                {{--<input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" required autofocus>--}}

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
                            {{--<div class="col-md-6 col-md-offset-4">--}}
                                {{--<div class="checkbox">--}}
                                    {{--<label>--}}
                                        {{--<input type="checkbox" name="remember" {{ old('remember') ? 'checked' : '' }}> Remember Me--}}
                                    {{--</label>--}}
                                {{--</div>--}}
                            {{--</div>--}}
                        {{--</div>--}}

                        {{--<div class="form-group">--}}
                            {{--<div class="col-md-8 col-md-offset-4">--}}
                                {{--<button type="submit" class="btn btn-primary" id="ajaxLoginButton">--}}
                                    {{--Login--}}
                            {{--</div>--}}
                        {{--</div>--}}
                    {{--</form>--}}
                {{--</div>--}}
            {{--</div>--}}
        {{--</div>--}}
    {{--</div>--}}
{{--</div>--}}

<form id="ajaxLogin" class="signIn" method="POST" action="{{ route('login') }}" onsubmit="return false;">
    {{ csrf_field() }}

    <div class="inputGroup{{ $errors->has('email') ? ' has-error' : '' }}">
        <label for="email">email:</label>
        <input id="email" class="signIn__email" type="email" name="email" value="{{ old('email') }}" required autofocus>
        <span class="errorText">
            @if ($errors->has('email'))
                <strong>{{ $errors->first('email') }}</strong>
            @endif
        </span>
    </div>
    <div class="inputGroup{{ $errors->has('password') ? ' has-error' : '' }}">
        <label for="password">пароль:</label>
        <input id="password" class="signIn__pass" type="password" name="password" required>
        <span class="errorText">
            @if ($errors->has('password'))
                <strong>{{ $errors->first('password') }}</strong>
            @endif
        </span>
    </div>
    <div class="inputGroup">
        <label for="remember">Запомнить e-mail ?</label><input type="checkbox" id="remember" name="remember" {{old('remember') ? 'checked' : ''}}/>
    </div>
    <div class="signIn__buttons">
        <a href="#" class="signIn__forgot">забыл пароль :(</a>
        <button type="button" name="button" class="button signIn__enter">войти</button>
    </div>
    <a href="#" class="signIn__toRegisterBtn">Регистрация</a>

</form>

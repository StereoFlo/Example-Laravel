@extends('layouts.app')
@section('content')
<section class="auth">
    <div class="container">

        <div class="sectionTitle">
            <h2>Авторизация</h2>
        </div>

        <form id="login" class="signIn signIn_dark" method="POST" action="{{ route('login') }}">
            {{ csrf_field() }}

            <div class="inputGroup{{ $errors->has('email') ? ' has-error' : '' }}">
                <label for="email">email:</label>
                <input id="email" class="signIn__email" type="email" name="email" value="{{ old('email') }}" required autofocus>
                <i class="fa fa-user" aria-hidden="true"></i>
                <span class="errorText" id="emailError">
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
            <div class="inputGroup">
                <label for="remember">Запомнить e-mail ?</label><input type="checkbox" id="remember" name="remember" {{old('remember') ? 'checked' : ''}}/>
            </div>
            <div class="signIn__buttons">
                <a href="{{ route('password.request') }}" class="signIn__forgot">забыл пароль :(</a>
                <button type="submit" name="button" class="button signIn__enter">войти</button>
            </div>
            <a href="{{ route('register') }}" class="formToggle">Регистрация</a>

        </form>
    </div>
</section>
@endsection

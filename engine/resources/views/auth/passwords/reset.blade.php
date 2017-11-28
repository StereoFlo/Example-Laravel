@extends('layouts.app')

@section('content')
    <section class="resetPassword">
        <div class="container">

            <div class="sectionTitle">
                <h2>Сброс пароля</h2>
            </div>

            <form class="form resetPasswordForm" method="POST" action="{{ route('password.request') }}">
                {{ csrf_field() }}

                <div class="inputGroup{{ $errors->has('email') ? ' has-error' : '' }}">
                    <label for="email" >E-Mail:</label>
                    <input id="email" type="email" name="email" value="{{ $email or old('email') }}" required>
                    <span class="errorText">
                        @if ($errors->has('email'))
                            <strong>{{ $errors->first('email') }}</strong>
                        @endif
                    </span>
                </div>

                <div class="inputGroup{{ $errors->has('password') ? ' has-error' : '' }}">
                    <label for="password">пароль:</label>
                    <input type="password" name="password" value="" placeholder="Новый пароль">
                    <span class="errorText">
                            @if ($errors->has('password'))
                            <strong>{{ $errors->first('password') }}</strong>
                        @endif
                        </span>
                </div>
                <div class="inputGroup{{ $errors->has('password_confirmation') ? ' has-error' : '' }}">
                    <label for="password">подтверждение:</label>
                    <input type="password" name="password_confirmation" value="" placeholder="Новый пароль">
                    <span class="errorText">
                            @if ($errors->has('password_confirmation'))
                            <strong>{{ $errors->first('password_confirmation') }}</strong>
                        @endif
                        </span>
                </div>

                <button type="submit" name="button" class="button">отправить</button>
            </form>
        </div>
    </section>
@endsection

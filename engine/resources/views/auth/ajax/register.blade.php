@if(Auth::check())
    вы уже зарегистрированы
@else
    <form id="ajaxRegistration" class="registration" method="POST" action="{{ route('register') }}" onsubmit="return false;">
        {{ csrf_field() }}

        <div class="inputGroup{{ $errors->has('name') ? ' has-error' : '' }}">
            <label for="email">имя:</label>
            <input id="name" class="signIn__email" type="text" name="name" value="{{ old('name') }}" required autofocus>
            <i class="fa fa-user" aria-hidden="true"></i>
            <span class="errorText">
                @if ($errors->has('name'))
                    <strong>{{ $errors->first('name') }}</strong>
                @endif
            </span>
        </div>

        <div class="inputGroup{{ $errors->has('location') ? ' has-error' : '' }}">
            <label for="email">город:</label>
            <input id="location" class="signIn__email" type="text" name="location" value="{{ old('location') }}" required autofocus>
            <i class="fa fa-user" aria-hidden="true"></i>
            <span class="errorText">
                @if ($errors->has('location'))
                    <strong>{{ $errors->first('location') }}</strong>
                @endif
            </span>
        </div>

        <div class="inputGroup{{ $errors->has('phone') ? ' has-error' : '' }}">
            <label for="email">телефон:</label>
            <input id="phone" class="signIn__email" type="text" name="phone" value="{{ old('phone') }}" required autofocus>
            <i class="fa fa-user" aria-hidden="true"></i>
            <span class="errorText">
                @if ($errors->has('phone'))
                    <strong>{{ $errors->first('phone') }}</strong>
                @endif
            </span>
        </div>

        <div class="inputGroup{{ $errors->has('about') ? ' has-error' : '' }}">
            <label for="email">о себе:</label>
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
@if(Auth::check())

@else
    <form id="ajaxRegistration" class="registrationForm" method="POST" action="{{ route('register') }}" onsubmit="return false;">
        {{ csrf_field() }}

        <div class="inputGroup{{ $errors->has('name') ? ' has-error' : '' }}">
            <div id="nameError"></div>
            <label for="name">имя:</label>
            <input id="name" class="registrationForm__name" type="text" name="name" value="{{ old('name') }}" required autofocus>
            <i class="fa fa-id-card-o" aria-hidden="true"></i>
            <span class="errorText">
                @if ($errors->has('name'))
                    <strong>{{ $errors->first('name') }}</strong>
                @endif
            </span>
        </div>

        <div class="inputGroup{{ $errors->has('email') ? ' has-error' : '' }}">
            <div id="emailError"></div>
            <label for="email">email:</label>
            <input id="email" class="registrationForm__email" type="email" name="email" value="{{ old('email') }}" required>
            <i class="fa fa-envelope" aria-hidden="true"></i>
            <span class="errorText">
                @if ($errors->has('email'))
                    <strong>{{ $errors->first('email') }}</strong>
                @endif
            </span>
        </div>

        <div class="inputGroup{{ $errors->has('password') ? ' has-error' : '' }}">
            <div id="passwordError"></div>
            <label for="password">пароль:</label>
            <input id="password" class="registrationForm__pass" type="password" name="password" required>
            <i class="fa fa-unlock-alt" aria-hidden="true"></i>
            <span class="errorText">
                @if ($errors->has('password'))
                    <strong>{{ $errors->first('password') }}</strong>
                @endif
            </span>
        </div>

        <div class="inputGroup{{ $errors->has('password') ? ' has-error' : '' }}">
            <div id="password_confirmationError"></div>
            <label for="password_confirmation">пароль:</label>
            <input id="password_confirmation" class="registrationForm__pass" type="password" name="password_confirmation" required>
            <i class="fa fa-unlock-alt" aria-hidden="true"></i>
            <span class="errorText"></span>
        </div>

        <div class="registrationForm__buttons">
            <button type="submit" name="button" class="button registrationForm__enter">регистрация</button>
        </div>

        <a href="#" id="toLog" class="formToggle">Вход</a>

    </form>
@endif
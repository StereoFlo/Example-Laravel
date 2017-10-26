@if(Auth::check())

@else
    <form id="ajaxRegistration" class="registrationForm" method="POST" action="{{ route('register') }}" onsubmit="return false;">
        {{ csrf_field() }}

        <div class="inputGroup{{ $errors->has('name') ? ' has-error' : '' }}">
            <label for="email">имя:</label>
            <input id="name" class="registrationForm__name" type="text" name="name" value="{{ old('name') }}" required autofocus>
            <i class="fa fa-id-card-o" aria-hidden="true"></i>
            <span class="errorText">
                @if ($errors->has('name'))
                    <strong>{{ $errors->first('name') }}</strong>
                @endif
            </span>
        </div>

        <div class="inputGroup{{ $errors->has('location') ? ' has-error' : '' }}">
            <label for="email">город:</label>
            <input id="location" class="registrationForm__location" type="text" name="location" value="{{ old('location') }}">
            <i class="fa fa-map-marker" aria-hidden="true"></i>
            <span class="errorText">
                @if ($errors->has('location'))
                    <strong>{{ $errors->first('location') }}</strong>
                @endif
            </span>
        </div>

        <div class="inputGroup{{ $errors->has('phone') ? ' has-error' : '' }}">
            <label for="email">телефон:</label>
            <input id="phone" class="registrationForm__phone" type="text" name="phone" value="{{ old('phone') }}">
            <i class="fa fa-phone-square" aria-hidden="true"></i>
            <span class="errorText">
                @if ($errors->has('phone'))
                    <strong>{{ $errors->first('phone') }}</strong>
                @endif
            </span>
        </div>

        <div class="inputGroup{{ $errors->has('about') ? ' has-error' : '' }}">
            <label for="email">о себе:</label>
            <input id="about" class="registrationForm__about" type="text" name="about" value="{{ old('about') }}">
            <i class="fa fa-file-text-o" aria-hidden="true"></i>
            <span class="errorText">
                @if ($errors->has('about'))
                    <strong>{{ $errors->first('about') }}</strong>
                @endif
            </span>
        </div>

        <div class="inputGroup{{ $errors->has('email') ? ' has-error' : '' }}">
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
            <label for="password_confirmation">пароль:</label>
            <input id="password_confirmation" class="registrationForm__pass" type="password" name="password_confirmation" required>
            <i class="fa fa-unlock-alt" aria-hidden="true"></i>
            <span class="errorText"></span>
        </div>

        <div class="registrationForm__buttons">
            <button id="ajaxRegistrationButton" type="button" name="button" class="button registrationForm__enter">регистрация</button>
        </div>

        <a href="#" id="toLog" class="formToggle">Вход</a>

    </form>
@endif
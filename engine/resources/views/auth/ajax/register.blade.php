@if(Auth::check())

@else
    <form id="ajaxRegistration" class="registrationForm" method="POST" action="{{ route('register') }}" onsubmit="return false;">
        <div id="errors"></div>
        {{ csrf_field() }}

        <div class="inputGroup">
            <label for="name">имя:</label>
            <input id="name" class="registrationForm__name" type="text" name="name" value="{{ old('name') }}" required autofocus>
            <i class="fa fa-id-card-o" aria-hidden="true"></i>
            <span class="errorText " id="nameError"></span>
        </div>

        <div class="inputGroup">
            <label for="email">email:</label>
            <input id="email" class="registrationForm__email" type="email" name="email" value="{{ old('email') }}" required>
            <i class="fa fa-envelope" aria-hidden="true"></i>
            <span class="errorText" id="emailError"></span>
        </div>

        <div class="inputGroup{{ $errors->has('vkId') ? ' has-error' : '' }}">
            <label for="vkId">VK ID:</label>
            <input id="vkId" class="registrationForm__vkId" type="text" name="vkId" value="{{ old('vkId') }}">
            <i class="fa fa-envelope" aria-hidden="true"></i>
            <span class="errorText">
                @if ($errors->has('vkId'))
                    <strong>{{ $errors->first('vkId') }}</strong>
                @endif
            </span>
        </div>

        <div class="inputGroup">
            <label for="password">пароль:</label>
            <input id="password" class="registrationForm__pass" type="password" name="password" required>
            <i class="fa fa-unlock-alt" aria-hidden="true"></i>
            <span class="errorText" id="passwordError"></span>
        </div>

        <div class="inputGroup">
            <label for="password_confirmation">пароль:</label>
            <input id="password_confirmation" class="registrationForm__pass" type="password" name="password_confirmation" required>
            <i class="fa fa-unlock-alt" aria-hidden="true"></i>
            <span class="errorText" id="password_confirmationError"></span>
        </div>

        <div class="registrationForm__buttons">
            <button type="submit" name="button" class="button registrationForm__enter">регистрация</button>
        </div>

        <a href="#" id="toLog" class="formToggle">Вход</a>

    </form>
@endif
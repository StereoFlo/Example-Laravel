@if(Auth::check())
    <div class="entered">
        @if (empty(Auth::user()->avatar))
            <img src="{{url('static/images/user.jpg')}}" class="entered__pic" alt="">
        @else
            <img src="{{ Auth::user()->avatar }}" class="entered__pic" alt="">
        @endif
        <p class="entered__login">{{ Auth::user()->email }}</p>
        <a href="{{ route('workList') }}" class="entered__link">Кабинет</a>
        @if (Auth::user()->isModerator())
            <a href="{{ route('managerIndex') }}" class="entered__link">Админка</a>
        @endif
        <button class="button logoutBtn" onclick="event.preventDefault();document.getElementById('logout-form').submit();">Выйти</button>
        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
            {{ csrf_field() }}
        </form>
    </div>
@else
    <form id="ajaxLogin" class="signIn" method="POST" action="{{ route('login') }}" onsubmit="return false;">
        {{ csrf_field() }}

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

        <div class="inputGroup">
            <label for="remember">Запомнить e-mail ?</label><input type="checkbox" id="remember" name="remember" {{old('remember') ? 'checked' : ''}}/>
        </div>

        <div class="signIn__buttons">
            <a href="{{route('password.request')}}" class="signIn__forgot">забыл пароль :(</a>
            <button id="ajaxLoginButton" type="button" name="button" class="button signIn__enter">войти</button>
        </div>
        <a href="#" id="toReg" class="formToggle">Регистрация</a>

    </form>
@endif
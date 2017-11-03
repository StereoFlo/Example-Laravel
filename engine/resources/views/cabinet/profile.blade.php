@extends('layouts.app')

@section('content')
<section class="profileUpdate">
    <div class="container">

        <div class="sectionTitle">
            <h2>Обновление профиля</h2>
        </div>

        <div class="sessionUpdateResult">
            <h3 class="message">{{ session('updateResult') }}</h3>
        </div>


        <form method="POST" action="{{ route('profileUpdate') }}" enctype="multipart/form-data" id="profileUpdateForm" class="form profileUpdateForm">
            {{ csrf_field() }}

            <div class="inputGroup{{ $errors->has('name') ? ' has-error' : '' }}">
                <label for="name">Имя:</label>
                <input id="name" type="text" name="name" value="{{ Auth::user()->name }}" required>
                <span class="errorText">
                    @if ($errors->has('name'))
                    <strong>{{ $errors->first('name') }}</strong>
                    @endif
                </span>
            </div>

            <div class="inputGroup{{ $errors->has('email') ? ' has-error' : '' }}">
                <label for="email">email:</label>
                <input type="text" name="email" value="{{ Auth::user()->email }}" required>
                <span class="errorText">
                    @if ($errors->has('email'))
                        <strong>{{ $errors->first('email') }}</strong>
                    @endif
                </span>
            </div>

            <div class="inputGroup{{ $errors->has('location') ? ' has-error' : '' }}">
                <label for="location">город:</label>
                <input type="text" name="location" value="{{ Auth::user()->location }}">
                <span class="errorText">
                    @if ($errors->has('location'))
                        <strong>{{ $errors->first('location') }}</strong>
                    @endif
                </span>
            </div>

            <div class="inputGroup{{ $errors->has('phone') ? ' has-error' : '' }}">
                <label for="phone">телефон:</label>
                <input id="phone" type="text" name="phone" value="{{ Auth::user()->phone }}">
                <span class="errorText">
                    @if ($errors->has('phone'))
                        <strong>{{ $errors->first('phone') }}</strong>
                    @endif
                </span>
            </div>

            <div class="inputGroup{{ $errors->has('about') ? ' has-error' : '' }}">
                <label for="about">о себе:</label>
                <textarea name="about" rows="8" cols="80">{{ Auth::user()->about }}</textarea>
                <span class="errorText">
                    @if ($errors->has('about'))
                        <strong>{{ $errors->first('about') }}</strong>
                    @endif
                </span>
            </div>

            <div class="inputGroup{{ $errors->has('password') ? ' has-error' : '' }}">
                <label for="password">пароль:</label>
                <input type="text" name="password" value="" placeholder="Новый пароль">
                <span class="errorText">
                    @if ($errors->has('password'))
                        <strong>{{ $errors->first('password') }}</strong>
                    @endif
                </span>
            </div>
            <div class="inputGroup{{ $errors->has('password') ? ' has-error' : '' }}">
                <label for="password">подтверждение:</label>
                <input type="text" name="password_confirmation" value="" placeholder="Новый пароль">
                <span class="errorText">
                    @if ($errors->has('name'))
                        <strong>{{ $errors->first('name') }}</strong>
                    @endif
                </span>
            </div>

            @if (empty(Auth::user()->avatar))
            <div class="inputGroup{{ $errors->has('avatar') ? ' has-error' : '' }}">
                <label for="avatar">фото:</label>
                <div class="filearea">
                    <span>Перенесите файл сюда или нажмите на эту зону!</span>
                    <input type="file" name="avatar" value="{{ old('avatar') }}">
                </div>
                <div class="fileareaPreview"></div>
                <span class="errorText">
                    @if ($errors->has('avatar'))
                        <strong>{{ $errors->first('avatar') }}</strong>
                    @endif
                </span>
            </div>
            @else
                <label for="">аватар:</label>
                <div id="avatar" class="avatar">
                    <img src="{{ Auth::user()->avatar }}">
                    <a href="{{ route('removeAvatar') }} " class="del">
                        <i class="fa fa-trash" aria-hidden="true"></i>
                    </a>
                </div>
            @endif

            <button type="submit" name="button" class="button">Обновить</button>
        </form>
    </div>
</section>
@endsection

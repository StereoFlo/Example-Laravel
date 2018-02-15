@extends('layouts.app')

@section('content')
<section class="profileUpdate">
    <div class="container">

        <div class="sectionTitle">
            <h2>Обновление профиля</h2>
        </div>

        @if(!empty(session('updateResult')))
        <div class="sessionUpdateResult">
            <h3 class="message">{{ session('updateResult') }}. Вернуться в <a href="{{ route('cabinetIndex') }}">личный кабинет</a> </h3>
        </div>
        @endif


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

            <div class="inputGroup{{ $errors->has('vk_id') ? ' has-error' : '' }}">
                <label for="vkId">VK ID:</label>
                <input id="vkId" type="text" name="vkId" value="{{ Auth::user()->vk_id }}">
                <span class="errorText">
                    @if ($errors->has('vkId'))
                        <strong>{{ $errors->first('vk_id') }}</strong>
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
            <div class="inputGroup{{ $errors->has('password_confirmation') ? ' has-error' : '' }}">
                <label for="password">подтверждение:</label>
                <input type="text" name="password_confirmation" value="" placeholder="Новый пароль">
                <span class="errorText">
                    @if ($errors->has('password_confirmation'))
                        <strong>{{ $errors->first('password_confirmation') }}</strong>
                    @endif
                </span>
            </div>
            @if (!empty(Auth::user()->avatar))
            <div class="userId hidden" data-userId="{{Auth::user()->id}}"></div>

            <div class="inputGroup{{ $errors->has('avatar') ? ' has-error' : '' }}">
                <label for="avatar">фото (1:1, jpeg):</label>
                <div class="filearea">
                    <input id="avatarInput" type="file" name="avatar" {{ !empty($errors->has('images')) ? 'required' : null }}
                    data-fileuploader-files=
                    '[{
                        "name":"Avatar",
                        "type":"image\/jpeg",
                        "file":"{{ Auth::user()->avatar }}"
                    }]'
                    >
                </div>
                <span class="errorText">
                    @if ($errors->has('avatar'))
                        <strong>{{ $errors->first('avatar') }}</strong>
                    @endif
                </span>
            </div>
            @else
                <label for="">аватар:</label>
                <div class="filearea">
                    <input id="avatarInput" type="file" name="avatar" {{ !empty($errors->has('images')) ? 'required' : null }}>
                </div>
            @endif


            <button type="submit" name="button" class="button">Обновить</button>
        </form>
    </div>
</section>
@endsection

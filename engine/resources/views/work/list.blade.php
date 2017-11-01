@extends('layouts.app')

@section('content')
    <section class="profile">
        <div class="container">

            <div class="sectionTitle">
                <h2>Кабинет</h2>
            </div>

            <div class="account">
                <div class="account__card">
                    @if (empty(Auth::user()->avatar))
                        <img src="{{url('static/images/user.jpg')}}" class="account__pic" alt="">
                    @else
                        <img src="{{ Auth::user()->avatar }}" class="account__pic" alt="">
                    @endif
                    <p class="account__login">{{ Auth::user()->email }}</p>
                    <a href="{{ route('profileForm') }}" class="account__btn button">редактировать</a>
                </div>
                <div class="account__info">
                    <dl>
                        <dt>Имя:</dt><dd>{{ Auth::user()->name }}</dd>
                        <br>
                        <dt>Город:</dt><dd>{{ Auth::user()->location }}</dd>
                        <br>
                        <dt>Телефон:</dt><dd>{{ Auth::user()->phone }}</dd>
                        <br>
                        <dt>О себе:</dt><dd>{{ Auth::user()->about }}</dd>
                    </dl>
                </div>
            </div>

            <div class="works">
                <div class="blockTitle">
                    <h3>Мои работы</h3>
                </div>

                <a href="{{ route('workAdd') }}" class="works__new">
                    Добавить <i class="fa fa-plus-square" aria-hidden="true"></i>
                </a>

                @if (empty($works))
                    <p>Работы отсутствуют</p>
                @else
                    @foreach($works as $work)
                        <div class="works__item">
                            <a href="{{ route('workShow', ['id' => $work['id']]) }}" class="works__name">{{ $work['workName']}}</a>

                            <div class="works__control">
                                <a href="{{ route('workEdit', ['id' => $work['id']]) }}" class="works__edit">
                                    <i class="fa fa-pencil" aria-hidden="true"></i>
                                </a>

                                <a href="{{ route('workRemove', ['id' => $work['id']]) }}" class="works__remove">
                                    <i class="fa fa-trash" aria-hidden="true"></i>
                                </a>
                            </div>
                        </div>
                    @endforeach
                @endif
            </div>

        </div>
    </section>
@endsection

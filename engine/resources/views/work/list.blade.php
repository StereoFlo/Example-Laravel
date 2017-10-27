@extends('layouts.app')

@section('content')
    {{--<section class="profile">--}}
        {{--<div class="container">--}}

            {{--<div class="sectionTitle">--}}
                {{--<h2>Кабинет</h2>--}}
            {{--</div>--}}

            {{--<div class="account">--}}
                {{--<div class="account__card">--}}
                    {{--@if (empty(Auth::user()->avatar))--}}
                        {{--<img src="{{url('static/images/user.jpg')}}" class="account__pic" alt="">--}}
                    {{--@else--}}
                        {{--<img src="{{ Auth::user()->avatar }}" class="account__pic" alt="">--}}
                    {{--@endif--}}
                    {{--<p class="account__login">{{ Auth::user()->email }}</p>--}}
                {{--</div>--}}
                {{--<div class="account__info">--}}
                    {{--<dl>--}}
                        {{--<dt>Имя:</dt><dd>{{ Auth::user()->name }}</dd>--}}
                        {{--<br>--}}
                        {{--<dt>E-mail:</dt><dd>{{ Auth::user()->email }}</dd>--}}
                        {{--<br>--}}
                        {{--<dt>Город:</dt><dd>{{ Auth::user()->location }}</dd>--}}
                        {{--<br>--}}
                        {{--<dt>Телефон:</dt><dd>{{ Auth::user()->phone }}</dd>--}}
                    {{--</dl>--}}
                {{--</div>--}}
            {{--</div>--}}

            {{--<div class="works">--}}
                {{--<div class="blockTitle">--}}
                    {{--<h3>Мои работы</h3>--}}
                {{--</div>--}}

                {{--<div class="works__item">--}}
                    {{--<a href="/cabinet/work/<?= $work['id'] ?>"><?= $work['workName'] ?></a>--}}
                    {{--<a href="{{ route('work', ['id' => $workId]) }}"><?= $work['workName'] ?></a>--}}

                    {{--<div class="works__control">--}}
                        {{--<a href="{{ route('workEdit', ['id' => $workId]) }}" class="works__edit">--}}
                            {{--<i class="fa fa-pencil" aria-hidden="true"></i>--}}
                        {{--</a>--}}
                        {{--<a href="/cabinet/work/<?= $work['id'] ?>/remove" class="works__remove">--}}
                            {{--<i class="fa fa-trash" aria-hidden="true"></i>--}}
                        {{--</a>--}}
                    {{--</div>--}}
                {{--</div>--}}

            {{--</div>--}}

        {{--</div>--}}
    {{--</section>--}}
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">Мои работы (<a href="{{ route('workAdd') }}">добавить</a>)</div>
                    {{ session('addWorkResult') }}
                    <div class="panel-body">
                        <? if (empty($works)) { ?>
                        <p>У вас пока нет работ</p>
                        <? } else { ?>
                        <? foreach ($works as $work) { ?>
                        <p><a href="/cabinet/work/<?= $work['id'] ?>"><?= $work['workName'] ?></a>(<a href="/cabinet/work/<?= $work['id'] ?>/remove">X</a>)</p>
                        <? } ?>
                        <? } ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@extends('layouts.error')

@section('content')
    <section class="error">
        <img src="{{ url('static/images/recycle_err.png') }}" alt="" class="error__pic">
        <p class="error__code">401</p>
        <p class="error__text">Требуется авторизация! <br> Приносим свои извинения.</p>
        <p class="error__desc"></p>
        <a href="{{ url('index.html') }}" class="error__link">Главная страница</a>
    </section>
@endsection
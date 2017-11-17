@extends('layouts.error')

@section('content')
    <section class="error">
        <img src="{{ url('static/images/recycle_err.png') }}" alt="" class="error__pic">
        <p class="error__code">404</p>
        <p class="error__text">Такой страницы нет.</p>
        <p class="error__desc">Возможные причины:
            <ul>
                <li>ошибка при наборе адреса страницы (URL);</li>
                <li>переход по неработающей или  неправильной  ссылке;</li>
                <li>отсутствие запрашиваемой страницы на сайте;</li>
            </ul>
        </p>
        <a href="{{ url('index.html') }}" class="error__link">Главная страница</a>
    </section>
@endsection
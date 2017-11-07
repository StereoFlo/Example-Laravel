@extends('layouts.error')

@section('content')
    <section class="error">
        <img src="{{ url('static/images/recycle_err.png') }}" alt="" class="error__pic">
        <p class="error__code">500</p>
        <p class="error__text">Что-то пошло не так! <br> Приносим свои извинения.</p>
        <p class="error__desc">С большой вероятностью мы уже знаем о проблеме и работаем над её исправлением</p>
        <a href="{{ url('index.html') }}" class="error__link">Главная страница</a>
    </section>
@endsection
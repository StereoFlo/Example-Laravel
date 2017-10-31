@extends('layouts.app')
@section('content')
{{--{{ var_dump($news) }}--}}

    <section class="allNews">
        <div class="container">
            <div class="sectionTitle">
                <h2>Новости</h2>
            </div>

            @if(!empty($news))
                <div class="news__item">
                    @foreach($news as $item)
                        <div class="allNews__item">
                            <h4 class="allNews__name">{{ $item['name'] }}</h4>
                            <span class="allNews__date">{{ date('d.m.Y', strtotime($item['created_at'])) }}</span>
                            <hr>
                            <p class="allNews__text">{{ $item['content'] }}</p>
                        </div>
                    @endforeach
                </div>
            @endif

            <div class="allNews__controls">
                <a href="#" class="allNews__prew">
                    <i class="fa fa-arrow-left" aria-hidden="true"></i>
                </a>
                <a href="#" class="allNews__next">
                    <i class="fa fa-arrow-right" aria-hidden="true"></i>
                </a>
            </div>
        </div>
    </section>
@endsection
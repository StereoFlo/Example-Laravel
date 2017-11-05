@extends('layouts.welcome')

@section('content')
    <section id="welcome" class="welcome">
        <div class="filter"></div>
        <div class="container">
            <div class="flex">
                <img src="{{ url('static/images/logo.png') }}" alt="Logo" class="sloganShow">
                <div class="slogan">
                    <p class="slogan__item">
                        {{ $slogan }}
                    </p>
                </div>

                @if(!empty($news))

                    <div class="news">

                        @foreach($news as $item)
                            <a href="{{ route('news') }}">
                                <div class="news__item">
                                    <h4 class="news__name">{{ $item['name'] }}</h4>
                                    <span class="news__date">{{ date('d.m.Y', strtotime($item['created_at'])) }}</span>
                                    <p class="news__text">{{ $item['content'] }}</p>
                                </div>
                            </a>
                        @endforeach

                    </div>

                @endif
            </div>
        </div>
        <a href="#products" class="scrollDown">
            <img src="{{ url('static/images/scroll.png') }}" alt="scroll">
            <img src="{{ url('static/images/scroll.png') }}" alt="scroll">
            <img src="{{ url('static/images/scroll.png') }}" alt="scroll">
        </a>
    </section>

    <section id="products" class="products">
            <div class="flex">
                @if(empty($works))
                    <p>Работ от авторов пока нет</p>
                    @else
                    @foreach($works as $work)
                        <a href="{{ route('workPublicShow', ['id' => $work['workId']]) }}" class="item">
                            <div class="content">
                                <div class="border">
                                    <div class="valign">
                                        <h3>{{ $work['name'] }}</h3>
                                        <p>{{ $work['workName'] }}</p>
                                    </div>
                                </div>
                            </div>
                            <img src="{{ url($work['link']) }}" alt="">
                        </a>
                    @endforeach
                @endif
            </div>
    </section>
@endsection
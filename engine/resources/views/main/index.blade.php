@extends('layouts.welcome')

@section('content')
    <section id="welcome" class="welcome">
        <div class="filter"></div>
        <div class="container">
            <div class="flex">
                <a href="{{url('pages/style.html')}}" class="sloganShow">
                    <img src="{{ url('static/images/logo.png') }}" alt="Logo" class="">
                </a>
                {{--<img src="{{ url('static/images/logo.png') }}" alt="Logo" class="sloganShow">--}}

                <div class="slogan">
                    <p class="slogan__item">
                        {!! $slogan['setting_value'] !!}
                    </p>
                </div>

                <div class="callToUser">
                    <p class="callToUser__item">
                        {!! $generalPageBlock['setting_value'] !!}
                    </p>
                </div>

                @if(!empty($news))
                    <div class="news">
                        @foreach($news as $item)
                            <div class="news__item">
                                <a href="{{ route('news') }}" class="news__name">
                                    <h4 class="">{{ $item['name'] }}</h4>
                                </a>
                                <span class="news__date">
                                    {{ date('d.m.Y', strtotime($item['created_at'])) }}
                                </span>
                                <div class="news__text">{!! $item['content'] !!}</div>
                            </div>
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
        <div class="products__wrap">
            @if(empty($works))
                <p>Работ от авторов пока нет</p>
                @else
                @foreach($works as $work)
                    <a href="/work/{{$work['workId']}}" class="item">
                        <div class="content">
                            <div class="border">
                                <div class="valign">
                                    <h3>{{ $work['name'] }}</h3>
                                    <p>{{ $work['workName'] }}</p>
                                </div>
                            </div>
                        </div>
                        @if(!isset($work['thumb']))
                            <img src="{{ url($work['link']) }}" alt="">
                        @else
                            <img src="{{ url($work['thumb']) }}" alt="">
                        @endif
                    </a>
                @endforeach
            @endif
        </div>
        <h2 class="products__toGallery"><a href="{{ route('galleryPublicIndex') }}">Все работы</a></h2>
    </section>
@endsection
@extends('layouts.app')

@section('content')
    <section class="work">
        <div class="container">
            <div class="work__header flex">
                <h2 class="work__title">{{ $work['workName']  }}</h2>
                <a href="/author/{{$work['userId']}}" class="work__author">by {{$work['userName']}}</a>
            </div>
            <div class="work__item">
                <div class="work__slider">
                    <ul class="bxslider">
                        @if (empty($work['images']))
                            <p>У этой работы нет изображений</p>
                        @else
                            @foreach ($work['images'] as $image)
                            <li><img src="{{$image['link']}}" alt="" class="work__pic"></li>
                            @endforeach
                        @endif
                    </ul>
                    <div id="bx-pager">
                        @if (empty($work['images']))
                            <p>У этой работы нет изображений</p>
                        @else
                            @foreach ($work['images'] as $image)
                                <a data-slide-index="{{$image['id']}}" href=""><img src="{{$image['link']}}" /></a>
                            @endforeach
                        @endif
                    </div>
                </div>
                <div class="work__desc">
                    <p>
                        {{$work['description']}}
                    </p>
                </div>
            </div>
            <div class="work__toolbar">
                <div class="work__counts">
                    <div class="work__likes">
                        <a href="#"></a>
                        <span>0</span>
                    </div>
                </div>
                <div class="work__circles">
                    <div class="work__circle">
                        <span>Бумага</span>
                        <img src="images/icons/1.png" alt="">
                    </div>
                    <div class="work__circle">
                        <span>Бумага</span>
                        <img src="images/icons/2.png" alt="">
                    </div>
                    <div class="work__circle">
                        <span>Бумага</span>
                        <img src="images/icons/3.png" alt="">
                    </div>
                    <div class="work__circle">
                        <span>Бумага</span>
                        <img src="images/icons/4.png" alt="">
                    </div>
                    <div class="work__circle">
                        <span>Бумага</span>
                        <img src="images/icons/6.png" alt="">
                    </div>
                    <div class="work__circle">
                        <span>Бумага</span>
                        <img src="images/icons/7.png" alt="">
                    </div>
                    <div class="work__circle">
                        <span>Бумага</span>
                        <img src="images/icons/4.png" alt="">
                    </div>
                </div>

                {{--<button class="work__buyBtn button">Заказать</button>--}}
            </div>
            <div class="work__meta">
                @if (empty($work['tags']))
                    <p>У этой работы нет тегов</p>
                @else
                    <span>мета теги:</span>
                    @foreach ($work['tags'] as $tag)
                        <a href="#">{{$tag['tag']}},</a>
                    @endforeach
                @endif
            </div>
            <div  id="work__comments" class="work__comments">

            </div>
        </div>
    </section>
@endsection

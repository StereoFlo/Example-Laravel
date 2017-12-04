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
                    <div class="fotorama"
                         data-nav="thumbs"
                         data-allowfullscreen="true"
                         data-arrows="true"
                         data-click="true"
                         data-loop="true"
                         data-thumbwidth="110"
                         data-thumbheight="60"
                         data-width="100%"
                         data-maxheight="400"
                    >
                        @if (empty($work['images']))
                            <p>У этой работы нет изображений</p>
                        @else
                            @foreach ($work['images'] as $image)
                            <img src="{{ url($image['link']) }}" alt="" class="work__pic">
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
                    <div class="work__likes {{ $isLiked ? 'work__likes_checked' : null }}">
                        <a id="setLike" href="{{ route('workPublicLike', ['id' => $work['id']]) }}" ></a>
                        <span id="likesCount">{{ $work['likes'] }}</span>
                    </div>
                </div>
                <div class="work__circles">
                    @if(!empty($work['materials']['inWork']))
                        @foreach($work['materials']['inWork'] as $material)
                            <div class="work__circle" data-tt="{{ $material['name'] }}">
                                <img src="{{ url($material['url']) }}" alt="">
                            </div>
                        @endforeach
                    @endif
                </div>

                {{--<button class="work__buyBtn button">Заказать</button>--}}
            </div>
            {{--<div class="work__tags">--}}
                {{--<p>мета теги:</p>--}}
                {{--@if (empty($work['tags']))--}}
                    {{--<p>У этой работы нет тегов</p>--}}
                {{--@else--}}
                    {{--@foreach ($work['tags'] as $tag)--}}
                        {{--<a href="#">{{$tag['tag']}}</a>--}}
                    {{--@endforeach--}}
                {{--@endif--}}
            {{--</div>--}}
            <div class="work__categories">
                <p>категории:</p>
                @if (empty($work['categories']['inWork']))
                    <p>У этой работы нет категорий</p>
                @else
                    @foreach ($work['categories']['inWork'] as $categories)
                        <a href="{{ route('galleryPublicIndex') }}?categories[]={{ $categories['id'] }}">{{ $categories['name'] }}</a>
                    @endforeach
                @endif
            </div>
            <div  id="work__comments" class="work__comments">

            </div>
            <script type="text/javascript">VK.init({apiId: 6283406, onlyWidgets: true});</script>
            <script type="text/javascript">
                VK.Widgets.Comments("work__comments", {limit: 20, attach: "*"}, {{$work['id']}});
            </script>
        </div>
    </section>
@endsection

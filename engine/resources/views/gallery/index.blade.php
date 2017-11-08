@extends('layouts.app')

@section('content')
    <section class="gallery">

        <div class="category">
            <div class="side-title">
                <span>Категории</span>
            </div>
            <ul class="side-list">
                @foreach($categories as $category)
                    <li>
                        <input type="checkbox" class="checkbox" id="{{ $category['id'] }}"/>
                        <label for="{{ $category['id'] }}">{{ $category['name'] }}</label>
                    </li>
                @endforeach
            </ul>

        </div>

        <div class="works">
            <div class="works__best">
                <div class="sectionTitle">
                    <h2>Лучшие работы</h2>
                </div>
                <div class="products">
                    @foreach($recentlyLiked as $work)
                        <a href="/author/{{ $work['userId'] }}" class="item">
                            <div class="content">
                                <div class="border">
                                    <div class="valign">
                                        <h3>{{ $work['workName'] }}</h3>
                                        <p>{{ $work['description'] }}</p>
                                    </div>
                                </div>
                            </div>
                            <img src="{{ url($work['link']) }}" alt="">
                        </a>
                    @endforeach
                </div>
            </div>
            <div class="works__all">
                <div class="sectionTitle">
                    <h2>Все работы</h2>
                </div>

                <div class="products">
                    @if(empty($list))
                        <p>В этой категории работ нет</p>
                    @else
                        @foreach($list as $work)
                            <a href="/author/{{ $work['userId'] }}" class="item">
                                <div class="content">
                                    <div class="border">
                                        <div class="valign">
                                            <h3>{{ $work['workName'] }}</h3>
                                            <p>{{ $work['description'] }}</p>
                                        </div>
                                    </div>
                                </div>
                                <img src="{{ url($work['link']) }}" alt="">
                            </a>
                        @endforeach
                    @endif
                </div>
            </div>
        </div>

    </section>
@endsection
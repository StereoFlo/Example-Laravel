@extends('layouts.app')

@section('content')
    <section class="gallery">
        <div class="gallery__wrap">

            <div class="galleryCategory__wrap">
                <div class="galleryCategory galleryCategory_opened">
                    <div class="galleryCategory__title">
                        <span>Категории</span>
                        <a href="#"></a>
                    </div>
                    <ul class="galleryCategory__list">
                        @foreach($categories as $category)
                            <li>
                                <input type="checkbox" class="checkbox" id="cid_{{ $category['id'] }}" data-id="{{ $category['id'] }}"/>
                                <label for="cid_{{ $category['id'] }}">{{ $category['name'] }}</label>
                            </li>
                        @endforeach
                    </ul>
                </div>
            </div>

            <div class="galleryWorks">
                <div class="galleryWorks__best">
                    <div class="sectionTitle">
                        <h2>Лучшие работы</h2>
                    </div>
                    <div class="products">
                        <div class="products__wrap">
                            @foreach($recentlyLiked as $work)
                                <a href="/work/{{ $work['id'] }}" class="item">
                                    <div class="content">
                                        <div class="border">
                                            <div class="valign">
                                                <h3>{{ $work['userName'] }}</h3>
                                                <p>{{ $work['workName'] }}</p>
                                            </div>
                                        </div>
                                    </div>
                                    <img src="{{ url($work['link']) }}" alt="">
                                </a>
                            @endforeach
                        </div>
                    </div>
                </div>

                <div class="galleryWorks__all">
                    <div class="sectionTitle">
                        <h2>Все работы</h2>
                    </div>

                    <div class="products" id="galleryWorksAll"></div>
                </div>
            </div>
        </div>
    </section>
@endsection
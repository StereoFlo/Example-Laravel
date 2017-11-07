@extends('layouts.app')

@section('content')
<section class="gallery">

    <div class="category">
        <div class="side-title">
            <span>Категории</span>
        </div>
        <ul class="side-list">
            <li>
                <input type="checkbox" class="checkbox" id="m1" />
                <label for="m1">Мебель</label>
            </li>
            <li>
                <input type="checkbox" class="checkbox" id="m2" />
                <label for="m2">Часы</label>
            </li>
            <li>
                <input type="checkbox" class="checkbox" id="m3" />
                <label for="m3">Светильники</label>
            </li>
            <li>
                <input type="checkbox" class="checkbox" id="m4" />
                <label for="m4">Фигурки</label>
            </li>
            <li>
                <input type="checkbox" class="checkbox" id="m5" />
                <label for="m5">Поставить</label>
            </li>
            <li>
                <input type="checkbox" class="checkbox" id="m6" />
                <label for="m6">Повесить</label>
            </li>
        </ul>

    </div>

    <div class="works">

        <div class="works__best">
            <div class="sectionTitle">
                <h2>Лучшие работы</h2>
            </div>

            <div class="products">

                <a href="/author/{{$work['userId']}}" class="item">
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

            </div>
        </div>
        <div class="works__all">
            <div class="sectionTitle">
                <h2>Все работы</h2>
            </div>

            <div class="products">

                <a href="/author/{{$work['userId']}}" class="item">
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

            </div>
        </div>
    </div>

</section>
@endsection
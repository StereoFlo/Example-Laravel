@extends('layouts.app')
@section('content')
    <section class="allNews">
        <div class="container">
            <div class="sectionTitle">
                <h1>Новости</h1>
            </div>

            @if(!empty($news))
                <div class="news__item">
                    @foreach($news as $item)
                        <div class="allNews__item">
                            <h4 class="allNews__name">{{ $item['name'] }}</h4>
                            <span class="allNews__date">{{ date('d.m.Y', strtotime($item['created_at'])) }}</span>
                            <hr>
                            <p class="allNews__text">{!! $item['content'] !!}</p>
                        </div>
                    @endforeach
                </div>
            @else
                <div class="news__item">
                    <p>Новостей пока нет</p>
                </div>
            @endif

            <div class="pagination">
                @if($currentPage > 0)
                    <a href="{{ url('news/page', ['id' => $currentPage - 1]) }}" class="previous">
                        <i class="fa fa-arrow-left" aria-hidden="true"></i>
                    </a>
                @endif
                    <a class="active">{{ $currentPage+1 }}</a>
                @if(($newsCount / $parPage) > 1 && ($newsCount / $parPage) > $currentPage+1)
                    <a href="{{ url('news/page', ['id' => $currentPage + 1]) }}" class="next">
                        <i class="fa fa-arrow-right" aria-hidden="true"></i>
                    </a>
                @endif
            </div>
        </div>
    </section>
@endsection
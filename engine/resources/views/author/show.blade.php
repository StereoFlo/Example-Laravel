@extends('layouts.forAuthor')

@section('content')
    <section class="author">
        <div class="container">

            <div class="authorProfile">

                <div class="authorProfile__card">
                    @if(empty($author['avatar']))
                        <img src="{{ url('static/images/user.jpg') }}" class="author__pic" alt="">
                    @else
                        <img src="{{ url($author['avatar']) }}" class="author__pic" alt="">
                    @endif
                </div>

                <div class="authorProfile__info">
                    <h1 class="authorProfile__name">{{ $author['name'] }}</h1>
                    <dl>
                        <dt>Город:</dt><dd> {{ $author['location'] }}</dd>
                        <br>
                        <dt>Телефон:</dt><dd>{{ $author['phone'] }}</dd>
                        <br>
                        <dt>О себе:</dt><dd>{{ $author['about'] }}</dd>
                    </dl>
                </div>
            </div>

        </div>

        <a href="#authorWorks" class="scrollDown">
            <img src="{{ url('static/images/scroll.png') }}" alt="scroll">
            <img src="{{ url('static/images/scroll.png') }}" alt="scroll">
            <img src="{{ url('static/images/scroll.png') }}" alt="scroll">
        </a>
    </section>

    <section id="authorWorks" class="products">
        <div class="container">

            <div class="sectionTitle">
                <h2>Работы автора</h2>
            </div>
            <div class="flex">
                @if(empty($works))
                    <p>У этого пользователя работ нет</p>
                @else
                     @foreach($works as $work)
                        <a href="#" class="item">
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

        </div>
    </section>
@endsection
@extends('layouts.forAuthor')

@section('content')
    <section class="author">
        <div class="container">

            <div class="authorProfile">

                <div class="authorProfile__card">
                    @if (empty(Auth::user()->avatar))
                        <img src="{{url('static/images/user.jpg')}}" class="author__pic" alt="">
                    @else
                        <img src="{{ Auth::user()->avatar }}" class="author__pic" alt="">
                    @endif
                </div>

                <div class="authorProfile__info">
                    <h1 class="authorProfile__name">{{ Auth::user()->name }}</h1>
                    <dl>
                        <dt>Город:</dt><dd>{{ Auth::user()->location }}</dd>
                        <br>
                        <dt>Телефон:</dt><dd>{{ Auth::user()->phone }}</dd>
                        <br>
                        <dt>О себе:</dt><dd>{{ Auth::user()->about }}</dd>
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
                <a href="#" class="item">
                    <div class="content">
                        <div class="border">
                            <div class="valign">
                                <h3>Анна Каренина</h3>
                                <p>«Мусор, как искусство<br> воплощать свои идеи»</p>
                            </div>
                        </div>
                    </div>
                    <img src="{{ url('static/images/items/img1.jpg') }}" alt="">
                </a>
                <a href="#" class="item">
                    <div class="content">
                        <div class="border">
                            <div class="valign">
                                <h3>Анна Каренина</h3>
                                <p>«Мусор, как искусство<br> воплощать свои идеи»</p>
                            </div>
                        </div>
                    </div>
                    <img src="{{ url('static/images/items/img2.jpg') }}" alt="">
                </a>
                <a href="#" class="item">
                    <div class="content">
                        <div class="border">
                            <div class="valign">
                                <h3>Анна Каренина</h3>
                                <p>«Мусор, как искусство<br> воплощать свои идеи»</p>
                            </div>
                        </div>
                    </div>
                    <img src="{{ url('static/images/items/img3.jpg') }}" alt="">
                </a>
                <a href="#" class="item">
                    <div class="content">
                        <div class="border">
                            <div class="valign">
                                <h3>Анна Каренина</h3>
                                <p>«Мусор, как искусство<br> воплощать свои идеи»</p>
                            </div>
                        </div>
                    </div>
                    <img src="{{ url('static/images/items/img4.jpg') }}" alt="">
                </a>
                <a href="#" class="item">
                    <div class="content">
                        <div class="border">
                            <div class="valign">
                                <h3>Анна Каренина</h3>
                                <p>«Мусор, как искусство<br> воплощать свои идеи»</p>
                            </div>
                        </div>
                    </div>
                    <img src="{{ url('static/images/items/img5.jpg') }}" alt="">
                </a>
                <a href="#" class="item">
                    <div class="content">
                        <div class="border">
                            <div class="valign">
                                <h3>Анна Каренина</h3>
                                <p>«Мусор, как искусство<br> воплощать свои идеи»</p>
                            </div>
                        </div>
                    </div>
                    <img src="{{ url('static/images/items/img6.jpg') }}" alt="">
                </a>
            </div>

        </div>
    </section>
@endsection
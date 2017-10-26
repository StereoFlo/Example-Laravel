@extends('layouts.forWelcome')

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
                <div class="news">
                    <div class="news__item">
                        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Fugiat incidunt labore modi nisi placeat praesentium similique. Accusamus aut blanditiis doloribus ea eum nulla, quam qui rem vero. Aliquid aut autem commodi, culpa ducimus ea earum eligendi fugiat illo ipsa iusto, minima necessitatibus nemo non omnis placeat quo ratione saepe, soluta?</p>
                    </div>
                    <div class="news__item">
                        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Fugiat incidunt labore modi nisi placeat praesentium similique. Accusamus aut blanditiis doloribus ea eum nulla, quam qui rem vero. Aliquid aut autem commodi, culpa ducimus ea earum eligendi fugiat illo ipsa iusto, minima necessitatibus nemo non omnis placeat quo ratione sae
                    </div>
                </div>

            </div>
        </div>
        <a href="#products" class="scrollDown">
            <img src="{{ url('static/images/scroll.png') }}" alt="scroll">
            <img src="{{ url('static/images/scroll.png') }}" alt="scroll">
            <img src="{{ url('static/images/scroll.png') }}" alt="scroll">
        </a>
    </section>

    <section id="products" class="products">
        <div class="container">
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
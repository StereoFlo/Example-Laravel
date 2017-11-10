<div class="products__wrap">
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
<div class="products__wrap">
    @if(empty($list))
        <p>В этой категории работ нет</p>
    @else
        @foreach($list as $work)
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
    @endif
</div>
<div class="pagination">
@if($currentPage > 0)
    <a href="#page_{{ $currentPage - 1 }}" data-page="{{ $currentPage - 1 }}" class="previous" id="workPrevious">
        &laquo;
    </a>
@endif
@if(($workCount / $parPage) > 1 && ($workCount / $parPage) > $currentPage)
    <a href="#page_{{ $currentPage + 1 }}" data-page="{{ $currentPage + 1 }}" class="next" id="workNext">
        &raquo;
    </a>
@endif
</div>

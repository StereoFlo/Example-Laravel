<div class="category">
    @if(!empty($work['id']))
        <label>Категории работы:</label>
        <div class="inWork">
            @if(empty($work['categories']['inWork']))
                <span>Вы не добавили свою работу не в одну категорию</span>
            @else
                @foreach($work['categories']['inWork'] as $category)
                    <a href="{{ route('deleteFromCategory', ['workId' => $work['id'], 'catId' => $category['id']]) }}" id="dcid_{{ $category['id'] }}" class="category__item">
                        <span class="name">{{ $category['name'] }}</span>
                        <i class="fa fa-trash" aria-hidden="true"></i>
                    </a>
                @endforeach
            @endif
        </div>
        <div class="notInWork">
            <label>Все категории:</label>
            @if(empty($work['categories']['notInWork']))
                <span class="empty">Ваша работа сейчас во всех возможных категориях</span>
                <div class="inputGroup checkboxes"></div>
            @else
                <div class="inputGroup checkboxes">
                    @foreach($work['categories']['notInWork'] as $category)
                        <input id="{{ $category['id'] }}" type="checkbox" name="categories[]" value="{{ $category['id'] }}">
                        <label for="{{ $category['id'] }}">{{ $category['name'] }}</label>
                    @endforeach
                </div>
            @endif
            <input type="hidden" name="workId" value="{{ $work['id'] }}">
        </div>
    @else
        @if(!empty($categories))
            <label>Категории:</label>
            <div class="inputGroup checkboxes">
                @foreach($categories as $category)
                    <input id="{{ $category['id'] }}" type="checkbox" name="categories[]" value="{{ $category['id'] }}">
                    <label for="{{ $category['id'] }}">{{ $category['name'] }}</label>
                @endforeach
            </div>
        @endif
    @endif
</div>
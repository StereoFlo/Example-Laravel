<div class="materials">
    @if(!empty($work['id']))
        <label>Материалы работы:</label>
        <div class="inWork">
            @if(empty($work['materials']['inWork']))
                <span>Вы не добавили свою работу не одного материала</span>
            @else
                @foreach($work['materials']['inWork'] as $material)
                    <a href="{{ route('removeMaterialFromWork', ['workId' => $work['id'], 'materialId' => $material['material_id']]) }}" id="dmid_{{$material['material_id']}} " class="materials__item">
                        <span class="name">{{ $material['name'] }}</span>
                        <i class="fa fa-trash" aria-hidden="true"></i>
                    </a>
                @endforeach
            @endif
        </div>
        <div class="notInWork">
            <label>Все материалы:</label>
            @if(empty($work['materials']['notInWork']))
                <span class="empty">Все возможные материалы добавлены в работу</span>
                <div class="inputGroup checkboxes"></div>
            @else
                <div class="inputGroup checkboxes">
                    @foreach($work['materials']['notInWork'] as $material)
                        <input id="{{ $material['id'] }}" type="checkbox" name="materials[]" value="{{ $material['id'] }}">
                        <label for="{{ $material['id'] }}">{{ $material['name'] }}</label>
                    @endforeach
                </div>
            @endif
            <input type="hidden" name="workId" value="{{ $work['id'] }}">
        </div>
    @else
        @if(!empty($materials))
            <label>Материалы:</label>
            <div class="inputGroup checkboxes">
                @foreach($materials as $material)
                    <input id="{{ $material['id'] }}" type="checkbox" name="materials[]" value="{{ $material['id'] }}">
                    <label for="{{ $material['id'] }}">{{ $material['name'] }}</label>
                @endforeach
            </div>
        @endif
    @endif
</div>
<div class="inputGroup{{ $errors->has('tags') ? ' has-error' : '' }}">
    <label for="tags">Теги:</label>
    <input id="tags" type="text" name="tags" placeholder="добавьте теги через ',' ">
    <span class="errorText">
                        @if ($errors->has('tags'))
            <strong>{{ $errors->first('tags') }}</strong>
        @endif
                    </span>
    @if(!empty($work['tags']))
        <p>Теги работы:</p>
        <div class="tag">
            @foreach($work['tags'] as $tag)
                <a id="tag_{{ $tag['id'] }}" href="{{ route('deleteFromWork', ['tagId' => $tag['id'], 'workId' => $work['id']]) }}"
                   class="tag__item">
                    <span class="name">{{ $tag['tag'] }}</span>
                    <i class="fa fa-trash" aria-hidden="true"></i>
                </a>
            @endforeach
        </div>
    @endif
</div>
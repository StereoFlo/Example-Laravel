<div class="inputGroup{{ $errors->has('images') ? ' has-error' : '' }}">
    @if(isset($work['id']))
        <div class="workId hidden" data-workId="{{$work['id']}}"></div>
    @endif
    <label for="images">Фото:</label>
    <div class="filearea">
        @if(!empty($work['images']))
            @php
                $keys = array_keys($work['images']);
            @endphp
            <input id="fotoInput" type="file" name="images[]"  {{ !empty($errors->has('images')) ? 'required' : null }}
                data-fileuploader-files=
                '[
                    @foreach($work['images'] as $key => $image)
                            {
                                "name":"{{$image['id']}}",
                                "size":1024,
                                "type":"image\/jpeg",
                                "file":"{{ url($image['link']) }}"
                            } {{ end($keys) !== $key ? ',' : '' }}
                    @endforeach
                ]'
            >
        @else
            <input id="fotoInput" type="file" name="images[]" multiple {{ !empty($errors->has('images')) ? 'required' : null }}>
        @endif

        @if(empty($work['id']))
            <p class="muted">Первое загруженное изображение является обложкой</p>
            <p class="muted">Для редактирования изображения нажмите на него после загрузки</p>
        @else
            <p class="muted">Для редактирования изображения нажмите на него</p>
            <p class="muted">Сменить обложку работы можно в редакторе изображения</p>
        @endif
    </div>
    <span class="errorText">
        @if ($errors->has('images'))
            <strong>{{ $errors->first('images') }}</strong>
        @endif
    </span>
    @if(!empty($work['images']))
        <label for="">Обложка работы:</label>
        <div class="imageDefault">
            @foreach($work['images'] as $image)
                @if($image['isDefault'])
                    <img src="{{ url($image['link']) }}" alt="Обложка">
                @endif
            @endforeach
        </div>
    @endif
</div>
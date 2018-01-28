<div class="inputGroup{{ $errors->has('images') ? ' has-error' : '' }}">
    @if(isset($work['id']))
        <div class="workId hidden" data-workId="{{$work['id']}}"></div>
    @endif
    <label for="images">@lang('work.photoOfNewWork') (16:9, jpeg):</label>
    <div class="filearea">
        @if(!empty($work['images']))
            @php
                $keys = array_keys($work['images']);
            @endphp
            <input id="fotoInput" type="file" name="images[]" multiple {{ !empty($errors->has('images')) ? 'required' : null }}
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
    </div>
    <div class="fileareaPreview hidden"></div>
    <span class="errorText">
        @if ($errors->has('images'))
            <strong>{{ $errors->first('images') }}</strong>
        @endif
    </span>
    @if(!empty($work['images']))
        <div class="imageGroup hidden">
            @foreach($work['images'] as $image)
                @if($image['isDefault'])
                    <div class="image">
                        <div class="default">
                            <i class="fa fa-check-square" aria-hidden="true"></i>
                        </div>
                        <img id="workImg_{{$image['id']}}" src="{{ url($image['link']) }}" alt="">
                        <a href="{{ route('imageDeleteFromWork', ['workId' => $work['id'], 'imageId' => $image['id']]) }}" class="workImgDel del">
                            <i class="fa fa-trash" aria-hidden="true"></i>
                        </a>
                    </div>
                @else
                    <div class="image">
                        <img id="workImg_{{$image['id']}}" src="{{ url($image['link']) }}" alt="">
                        <a href="{{ route('imageDeleteFromWork', ['workId' => $work['id'], 'imageId' => $image['id']]) }}" class="workImgDel del">
                            <i class="fa fa-trash" aria-hidden="true"></i>
                        </a>
                    </div>
                @endif
            @endforeach
        </div>
    @endif
</div>
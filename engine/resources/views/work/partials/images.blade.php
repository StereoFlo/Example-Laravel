<div class="inputGroup{{ $errors->has('images') ? ' has-error' : '' }}">
    <label for="images">@lang('work.photoOfNewWork') (16:9, jpeg):</label>
    <div class="filearea">
        <span>@lang('work.photoDescrOfNewWork')</span>
        <input type="file" name="images[]" value="{{ old('images') }}" multiple {{ !empty($errors->has('images')) ? 'required' : null }}>
    </div>
    <div class="fileareaPreview"></div>
    <span class="errorText">
                        @if ($errors->has('images'))
            <strong>{{ $errors->first('images') }}</strong>
        @endif
                    </span>
    @if(!empty($work['images']))
        <div class="imageGroup">
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
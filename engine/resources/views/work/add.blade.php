@extends('layouts.app')

@section('content')

<section class="workAdd">
    <div class="container">

        <div class="sectionTitle">
            <h2>@lang('work.new')</h2>
        </div>

        {{ session('addWorkResult') }}
        <form method="post" action="{{ route('workAddProcess') }}" enctype="multipart/form-data" class="form workAddForm">
            {{ csrf_field() }}

            <div class="inputGroup{{ $errors->has('workName') ? ' has-error' : '' }}">
                <label for="workName">@lang('work.nameOfNewWork'):</label>
                <input type="text" name="workName" value="" required autofocus>
                <span class="errorText">
                @if ($errors->has('workName'))
                        <strong>{{ $errors->first('workName') }}</strong>
                    @endif
            </span>
            </div>

            <div class="inputGroup{{ $errors->has('description') ? ' has-error' : '' }}">
                <label for="location">@lang('work.descriptionOfNewWork'):</label>
                <textarea id="summernote" name="description" cols="80" rows="8" required></textarea>
                <span class="errorText">
                @if ($errors->has('description'))
                        <strong>{{ $errors->first('description') }}</strong>
                    @endif
            </span>
            </div>

            <div class="inputGroup{{ $errors->has('images') ? ' has-error' : '' }}">
                <label for="images">@lang('work.photoOfNewWork'):</label>
                <div class="filearea">
                    <span>@lang('work.photoDescrOfNewWork')</span>
                    <input type="file" name="images[]" value="{{ old('images') }}" multiple required>
                </div>
                <div class="fileareaPreview"></div>
                <span class="errorText">
                @if ($errors->has('images'))
                        <strong>{{ $errors->first('images') }}</strong>
                    @endif
            </span>
            </div>

            <button type="submit" name="button" class="button">@lang('work.buttonOfNewWork')</button>
        </form>

    </div>
</section>
@endsection

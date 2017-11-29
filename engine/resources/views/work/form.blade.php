@extends('layouts.app')

@section('content')

    <section class="workAdd">
        <div class="container">

            @if(empty($work['id']))
                <div class="sectionTitle">
                    <h2>@lang('work.new')</h2>
                </div>
            @else
                <div class="sectionTitle">
                    <h2>Редактирование работы</h2>
                </div>
            @endif

            <form method="post" action="{{ route('workProcess') }}" enctype="multipart/form-data" class="form workAddForm">
                {{ csrf_field() }}

                <div class="inputGroup{{ $errors->has('workName') ? ' has-error' : '' }}">
                    <label for="workName">@lang('work.nameOfNewWork'):</label>
                    <input id="workName" type="text" name="workName" value="{{ !empty($work['workName']) ? $work['workName'] : null }}" required>
                    <span class="errorText">
                        @if ($errors->has('workName'))
                            <strong>{{ $errors->first('workName') }}</strong>
                        @endif
                    </span>
                </div>

                <div class="inputGroup{{ $errors->has('description') ? ' has-error' : '' }}">
                    <label for="desc">@lang('work.descriptionOfNewWork'):</label>
                    <textarea id="desc" name="description" cols="80" rows="8"
                              required>{{ !empty($work['description']) ? $work['description'] : null }}</textarea>
                    <span class="errorText">
                        @if ($errors->has('description'))
                            <strong>{{ $errors->first('description') }}</strong>
                        @endif
                    </span>
                </div>

                @include('work.includes.materials')

                @include('work.includes.category')

                @include('work.includes.images')

                @if(empty($work['id']))
                    <button type="submit" name="button" class="button btn_ok">@lang('work.buttonOfNewWork')</button>
                @else
                    <button type="submit" name="button" class="button btn_caution">Изменить</button>
                @endif
            </form>
        </div>
    </section>
@endsection




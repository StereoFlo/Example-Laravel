@extends('layouts.manager')

@section('content')
    <div class="container">
        <div class="row">
            @include('manager.shared.menu')
            <div class="col-md-8 col-md-offset-0">
                <div class="panel panel-default">
                    <div class="panel-heading">Настройки сайта</div>
                    <div class="panel-body">
                        <form class="form-horizontal" method="POST" action="{{ route('managerSettingsProcess') }}">
                            {{ csrf_field() }}
                            <p>{{ session('settingsFlash') }}</p>
                            @foreach($settings as $setting)
                                @if(isset($setting['setting_slug']) && $setting['setting_slug'] === 'limitWorksForGallery')
                                    <div class="form-group">
                                        <label for="limitWorksForGallery" class="col-md-4 control-label">Количество работ на странице галлереи</label>
                                        <div class="col-md-6">
                                            <input id="limitWorksForGallery" type="text" class="form-control" name="limitWorksForGallery" value="{{ $setting['setting_value'] }}" required autofocus>
                                        </div>
                                    </div>
                                @endif
                                @if(isset($setting['setting_slug']) && $setting['setting_slug'] === 'slogan')
                                    <div class="form-group">
                                        <label for="slogan" class="col-md-4 control-label">Слоган</label>
                                        <div class="col-md-6">
                                            <textarea id="slogan" name="slogan" class="form-control">{{ $setting['setting_value'] }}</textarea>
                                        </div>
                                    </div>
                                @endif
                                @if(isset($setting['setting_slug']) && $setting['setting_slug'] === 'generalPageBlock')
                                    <div class="form-group">
                                        <label for="generalPageBlock" class="col-md-4 control-label">Призыв к пользователю</label>
                                        <div class="col-md-6">
                                            <textarea id="generalPageBlock" name="generalPageBlock" class="form-control">{{ $setting['setting_value'] }}</textarea>
                                        </div>
                                    </div>
                                @endif
                            @endforeach
                            <div class="form-group">
                                <div class="col-md-8 col-md-offset-4">
                                    <button type="submit" class="btn btn-primary">
                                        OK
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

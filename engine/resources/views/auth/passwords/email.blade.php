@extends('layouts.app')

@section('content')
    <section class="resetLink">
        <div class="container">

            @if (session('status'))
                <div class="alert alert-success">
                    {{ session('status') }}
                </div>
            @endif

            <form class="form resetLinkForm" method="POST" action="{{ route('password.email') }}">
                {{ csrf_field() }}

                <div class="inputGroup{{ $errors->has('email') ? ' has-error' : '' }}">
                    <label for="email" class="col-md-4 control-label">E-Mail:</label>
                    <input id="email" type="email" name="email" value="{{ old('email') }}" required>
                    <span class="errorText">
                        @if ($errors->has('email'))
                                <strong>{{ $errors->first('email') }}</strong>
                        @endif
                    </span>
                </div>

                <button type="submit" name="button" class="button">отправить</button>
            </form>

        </div>
    </section>
@endsection

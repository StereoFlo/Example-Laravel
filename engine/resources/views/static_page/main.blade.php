@extends('layouts.app')
@section('content')
    <section class="staticPageContainer">
        <div class="container">

            <div class="sectionTitle">
                <h2>{{ $page['name'] }}</h2>
            </div>
            {!! $page['content'] !!}
        </div>
    </section>
@endsection
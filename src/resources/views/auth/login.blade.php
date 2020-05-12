@extends('layouts.app')

@section('content')
    <div id="app">
        <landing
            login="{{ Request::path(route('login')) }}"
            register="{{Request::path(route('register'))}}"
            forgot="{{route('password.request')}}"
        ></landing>
    </div>
@endsection

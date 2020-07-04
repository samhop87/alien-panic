@extends('layouts.app')

@section('content')
    <div id="app">
        <base-game
            username="{{ Auth::user()->name }}"
            logout="{{ route('logout') }}"
            details="{{ $savedGame }}"
            buildings="{{$buildings}}"
        ></base-game>
    </div>
@endsection

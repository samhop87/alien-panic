@extends('layouts.app')

@section('content')
    <div id="app">
        <game-screen
            username="{{ Auth::user()->name }}"
            logout="{{ route('logout') }}"

        ></game-screen>
    </div>
    @endsection

@extends('layouts.app')

@section('content')
    <div id="app">
        <game-screen username="{{ Auth::user()->name }}"></game-screen>
    </div>
    @endsection

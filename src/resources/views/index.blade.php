@extends('layouts.app')

@section('content')
    <div id="app">
        <transition mode="out-in" name="fade">
            <game-screen
                username="{{ Auth::user()->name }}"
                logout="{{ route('logout') }}"
            ></game-screen>

            <display-modal>
                :choice="choice"
            </display-modal>
        </transition>
    </div>
@endsection

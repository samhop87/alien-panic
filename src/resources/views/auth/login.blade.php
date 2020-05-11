@extends('layouts.app')

@section('content')
<div id="app">
    <new-landing login="{{ Request::path(route('login')) }}"></new-landing>
</div>

<div id="test" class="container mx-auto w-4/5 my-4">

                <div class="">{{ __('Login') }}</div>

                <div class="">

                    <form method="POST" action="{{ route('login') }}">
                        @csrf

                        <div class="form-group row mb-0">
                            <div class="col-md-8 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Login') }}
                                </button>

                                @if (Route::has('password.request'))
                                    <a class="btn btn-link" href="{{ route('password.request') }}">
                                        {{ __('Forgot Your Password?') }}
                                    </a>
                                @endif
                            </div>
                        </div>
                    </form>


                </div>
            </div>
@endsection

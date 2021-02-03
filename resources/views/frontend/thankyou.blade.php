@extends('frontend.layouts.app')

@section('content')
    <div class="jumbotron text-center">
        <h1 class="display-3">Thank You!</h1>
        @if (session()->has('success_message'))
            <p class="lead">
                <strong>{{ session()->get('success_message') }}</strong>
            </p>
        @endif
        <hr>
        <p>
         Having trouble? <a href="">Contact us</a>
        </p>
        <p class="lead">
            <a class="btn btn-primary btn-sm" href="{{ route('landingPage') }}" role="button">Continue to homepage</a>
        </p>
    </div>
@endsection
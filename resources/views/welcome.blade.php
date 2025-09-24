@extends('layouts.guest')

@section('content')
<div class="text-center">
    <h1 class="display-4 mb-4">Welcome to {{ config('app.name', 'Laravel') }}</h1>
    <p class="lead mb-4">A production-ready Laravel boilerplate with authentication, authorization, and more.</p>
    
    <div class="d-grid gap-2 d-sm-flex justify-content-sm-center">
        @auth
            <a href="{{ route('dashboard') }}" class="btn btn-primary btn-lg px-4 gap-3">Go to Dashboard</a>
        @else
            <a href="{{ route('login') }}" class="btn btn-primary btn-lg px-4 gap-3">Login</a>
            @if (Route::has('register'))
                <a href="{{ route('register') }}" class="btn btn-outline-secondary btn-lg px-4">Register</a>
            @endif
        @endauth
    </div>
</div>
@endsection
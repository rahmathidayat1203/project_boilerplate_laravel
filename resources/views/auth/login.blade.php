@extends('layouts.guest')

@section('content')
<div class="text-center mb-4">
    <h2>Login</h2>
</div>

<form method="POST" action="{{ route('login') }}">
    @csrf

    <!-- Email Address -->
    <div class="mb-3">
        <label for="email" class="form-label">Email</label>
        <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autofocus>
        @error('email')
            <div class="invalid-feedback">
                {{ $message }}
            </div>
        @enderror
    </div>

    <!-- Password -->
    <div class="mb-3">
        <label for="password" class="form-label">Password</label>
        <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">
        @error('password')
            <div class="invalid-feedback">
                {{ $message }}
            </div>
        @enderror
    </div>

    <!-- Remember Me -->
    <div class="mb-3 form-check">
        <input id="remember" type="checkbox" class="form-check-input" name="remember">
        <label for="remember" class="form-check-label">Remember me</label>
    </div>

    <div class="d-flex justify-content-between align-items-center">
        <a href="{{ route('password.request') }}" class="text-decoration-none">
            Forgot your password?
        </a>

        <button type="submit" class="btn btn-primary">
            Login
        </button>
    </div>
</form>
@endsection
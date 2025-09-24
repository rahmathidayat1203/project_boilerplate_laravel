@extends('layouts.guest')

@section('content')
<div class="text-center mb-4">
    <h2>Forgot Password</h2>
    <p class="text-muted">Enter your email address and we'll send you a link to reset your password.</p>
</div>

<form method="POST" action="{{ route('password.email') }}">
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

    <div class="d-flex justify-content-between align-items-center">
        <a href="{{ route('login') }}" class="text-decoration-none">
            Back to login
        </a>

        <button type="submit" class="btn btn-primary">
            Send Password Reset Link
        </button>
    </div>
</form>
@endsection
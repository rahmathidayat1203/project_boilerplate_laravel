@extends('layouts.guest')

@section('content')
<div class="text-center mb-4">
    <h2>Register</h2>
</div>

<form method="POST" action="{{ route('register') }}">
    @csrf

    <!-- Name -->
    <div class="mb-3">
        <label for="name" class="form-label">Name</label>
        <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autofocus>
        @error('name')
            <div class="invalid-feedback">
                {{ $message }}
            </div>
        @enderror
    </div>

    <!-- Email Address -->
    <div class="mb-3">
        <label for="email" class="form-label">Email</label>
        <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required>
        @error('email')
            <div class="invalid-feedback">
                {{ $message }}
            </div>
        @enderror
    </div>

    <!-- Password -->
    <div class="mb-3">
        <label for="password" class="form-label">Password</label>
        <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">
        @error('password')
            <div class="invalid-feedback">
                {{ $message }}
            </div>
        @enderror
    </div>

    <!-- Confirm Password -->
    <div class="mb-3">
        <label for="password_confirmation" class="form-label">Confirm Password</label>
        <input id="password_confirmation" type="password" class="form-control" name="password_confirmation" required>
    </div>

    <div class="d-flex justify-content-between align-items-center">
        <a href="{{ route('login') }}" class="text-decoration-none">
            Already registered?
        </a>

        <button type="submit" class="btn btn-primary">
            Register
        </button>
    </div>
</form>
@endsection
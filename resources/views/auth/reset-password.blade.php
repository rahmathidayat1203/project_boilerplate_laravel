@extends('layouts.guest')

@section('content')
<div class="text-center mb-4">
    <h2>Reset Password</h2>
</div>

<form method="POST" action="{{ route('password.update') }}">
    @csrf

    <!-- Token -->
    <input type="hidden" name="token" value="{{ $token }}">

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
        <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required>
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

    <div class="d-flex justify-content-end">
        <button type="submit" class="btn btn-primary">
            Reset Password
        </button>
    </div>
</form>
@endsection
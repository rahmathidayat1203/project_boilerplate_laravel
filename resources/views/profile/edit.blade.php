@extends('layouts.adminlte')

@section('content')
<div class="row">
    <div class="col-md-8">
        <div class="card">
            <div class="card-header pb-0">
                <div class="d-flex align-items-center">
                    <p class="mb-0">Edit Profile</p>
                </div>
            </div>
            <div class="card-body">
                <ul class="nav nav-tabs" id="profileTab" role="tablist">
                    <li class="nav-item" role="presentation">
                        <button class="nav-link active" id="profile-tab" data-bs-toggle="tab" data-bs-target="#profile" type="button" role="tab">Profile</button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" id="password-tab" data-bs-toggle="tab" data-bs-target="#password" type="button" role="tab">Password</button>
                    </li>
                </ul>
                <div class="tab-content" id="profileTabContent">
                    <div class="tab-pane fade show active" id="profile" role="tabpanel">
                        <form method="POST" action="{{ route('profile.update') }}">
                            @csrf
                            @method('PUT')
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="name" class="form-control-label">Name</label>
                                        <input class="form-control" type="text" name="name" value="{{ old('name', Auth::user()->name) }}" required>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="email" class="form-control-label">Email address</label>
                                        <input class="form-control" type="email" name="email" value="{{ old('email', Auth::user()->email) }}" required>
                                    </div>
                                </div>
                            </div>
                            <button type="submit" class="btn btn-primary">Update Profile</button>
                        </form>
                    </div>
                    <div class="tab-pane fade" id="password" role="tabpanel">
                        <form method="POST" action="{{ route('profile.password.update') }}">
                            @csrf
                            @method('PUT')
                            <div class="form-group">
                                <label for="current_password">Current Password</label>
                                <input type="password" name="current_password" class="form-control" required>
                            </div>
                            <div class="form-group">
                                <label for="password">New Password</label>
                                <input type="password" name="password" class="form-control" required>
                            </div>
                            <div class="form-group">
                                <label for="password_confirmation">Confirm New Password</label>
                                <input type="password" name="password_confirmation" class="form-control" required>
                            </div>
                            <button type="submit" class="btn btn-primary">Update Password</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
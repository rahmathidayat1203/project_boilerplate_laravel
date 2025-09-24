@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
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
                    <div class="card mt-3">
                        <div class="card-header">
                            <h4>Edit Profile</h4>
                        </div>
                        <div class="card-body">
                            @if(session('success') && !session('error'))
                                <div class="alert alert-success">{{ session('success') }}</div>
                            @endif
                            
                            <form method="POST" action="{{ route('profile.update') }}">
                                @csrf
                                @method('PUT')
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="name" class="form-label">Name</label>
                                            <input type="text" name="name" class="form-control" value="{{ old('name', Auth::user()->name) }}" required>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="email" class="form-label">Email</label>
                                            <input type="email" name="email" class="form-control" value="{{ old('email', Auth::user()->email) }}" required>
                                        </div>
                                    </div>
                                </div>
                                
                                <button type="submit" class="btn btn-primary">Update Profile</button>
                            </form>
                        </div>
                    </div>
                </div>
                
                <div class="tab-pane fade" id="password" role="tabpanel">
                    <div class="card mt-3">
                        <div class="card-header">
                            <h4>Change Password</h4>
                        </div>
                        <div class="card-body">
                            @if(session('error'))
                                <div class="alert alert-danger">{{ session('error') }}</div>
                            @endif
                            
                            <form method="POST" action="{{ route('profile.password.update') }}">
                                @csrf
                                @method('PUT')
                                <div class="mb-3">
                                    <label for="current_password" class="form-label">Current Password</label>
                                    <input type="password" name="current_password" class="form-control" required>
                                </div>
                                
                                <div class="mb-3">
                                    <label for="password" class="form-label">New Password</label>
                                    <input type="password" name="password" class="form-control" required>
                                </div>
                                
                                <div class="mb-3">
                                    <label for="password_confirmation" class="form-label">Confirm New Password</label>
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
</div>
@endsection
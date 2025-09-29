@extends('layouts.adminlte')

@section('content')
<div class="row">
    <div class="col-md-8">
        <div class="card">
            <div class="card-header pb-0">
                <div class="d-flex align-items-center">
                    <p class="mb-0">User Profile</p>
                    <a href="{{ route('profile.edit') }}" class="btn btn-primary btn-sm ms-auto">Edit Profile</a>
                </div>
            </div>
            <div class="card-body">
                <p class="text-uppercase text-sm">User Information</p>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="example-text-input" class="form-control-label">Name</label>
                            <input class="form-control" type="text" value="{{ Auth::user()->name }}" disabled>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="example-text-input" class="form-control-label">Email address</label>
                            <input class="form-control" type="email" value="{{ Auth::user()->email }}" disabled>
                        </div>
                    </div>
                </div>
                <hr class="horizontal dark">
                <p class="text-uppercase text-sm">Roles</p>
                <div class="row">
                    <div class="col-md-12">
                        @foreach(Auth::user()->roles as $role)
                            <span class="badge badge-sm bg-gradient-secondary">{{ $role->name }}</span>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
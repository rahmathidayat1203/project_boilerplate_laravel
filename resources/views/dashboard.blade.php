@extends('layouts.adminlte')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            <h1>Dashboard</h1>
            <p>Welcome, {{ Auth::user()->name }}!</p>
            
            <div class="row">
                <div class="col-md-4">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Users</h5>
                            <p class="card-text">Manage your application users.</p>
                            <a href="{{ route('users.index') }}" class="btn btn-primary">View Users</a>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Roles</h5>
                            <p class="card-text">Define roles for your application.</p>
                            <a href="{{ route('roles.index') }}" class="btn btn-primary">View Roles</a>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Permissions</h5>
                            <p class="card-text">Manage permissions for your application.</p>
                            <a href="{{ route('permissions.index') }}" class="btn btn-primary">View Permissions</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
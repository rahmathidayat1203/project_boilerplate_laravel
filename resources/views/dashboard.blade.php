@extends('layouts.argon')

@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <h5 class="card-title">Dashboard</h5>
            </div>
            <div class="card-body">
                <p>Welcome, {{ Auth::user()->name }}!</p>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-xl-4 col-sm-6 mb-xl-0 mb-4">
        <div class="card">
            <div class="card-body p-3">
                <div class="row">
                    <div class="col-8">
                        <div class="numbers">
                            <p class="text-sm mb-0 text-uppercase font-weight-bold">Users</p>
                            <h5 class="font-weight-bolder">
                                {{-- Add user count here --}}
                            </h5>
                            <a href="{{ route('users.index') }}" class="mb-0">
                                <span class="text-success text-sm font-weight-bolder">View Users</span>
                            </a>
                        </div>
                    </div>
                    <div class="col-4 text-end">
                        <div class="icon icon-shape bg-gradient-primary shadow-primary text-center rounded-circle">
                            <i class="ni ni-circle-08 text-lg opacity-10" aria-hidden="true"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-xl-4 col-sm-6 mb-xl-0 mb-4">
        <div class="card">
            <div class="card-body p-3">
                <div class="row">
                    <div class="col-8">
                        <div class="numbers">
                            <p class="text-sm mb-0 text-uppercase font-weight-bold">Roles</p>
                            <h5 class="font-weight-bolder">
                                {{-- Add role count here --}}
                            </h5>
                            <a href="{{ route('roles.index') }}" class="mb-0">
                                <span class="text-success text-sm font-weight-bolder">View Roles</span>
                            </a>
                        </div>
                    </div>
                    <div class="col-4 text-end">
                        <div class="icon icon-shape bg-gradient-danger shadow-danger text-center rounded-circle">
                            <i class="ni ni-badge text-lg opacity-10" aria-hidden="true"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-xl-4 col-sm-6">
        <div class="card">
            <div class="card-body p-3">
                <div class="row">
                    <div class="col-8">
                        <div class="numbers">
                            <p class="text-sm mb-0 text-uppercase font-weight-bold">Permissions</p>
                            <h5 class="font-weight-bolder">
                                {{-- Add permission count here --}}
                            </h5>
                            <a href="{{ route('permissions.index') }}" class="mb-0">
                                <span class="text-success text-sm font-weight-bolder">View Permissions</span>
                            </a>
                        </div>
                    </div>
                    <div class="col-4 text-end">
                        <div class="icon icon-shape bg-gradient-success shadow-success text-center rounded-circle">
                            <i class="ni ni-key-25 text-lg opacity-10" aria-hidden="true"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
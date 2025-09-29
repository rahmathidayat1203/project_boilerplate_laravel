@extends('layouts.adminlte')

@section('content')
<div class="row">
    <div class="col-12">
        <div class="card mb-4">
            <div class="card-header pb-0 d-flex justify-content-between align-items-center">
                <h6>Edit User</h6>
                <a class="btn btn-primary btn-sm ms-auto" href="{{ route('users.index') }}">Back</a>
            </div>
            <div class="card-body">
                @if(count($errors) > 0)
                    <div class="alert alert-danger">
                        <strong>Whoops!</strong> There were some problems with your input.<br><br>
                        <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                        </ul>
                    </div>
                @endif

                <form method="POST" action="{{ route('users.update', $user->id) }}">
                    @csrf
                    @method('PATCH')
                    <div class="form-group">
                        <label for="name">Name</label>
                        <input type="text" name="name" value="{{ $user->name }}" class="form-control" id="name" placeholder="Name" disabled>
                    </div>
                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="email" name="email" value="{{ $user->email }}" class="form-control" id="email" placeholder="Email" disabled>
                    </div>
                    <div class="form-group">
                        <label for="roles">Roles</label>
                        <div class="row">
                            @foreach($roles as $value)
                                <div class="col-md-3">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" name="roles[]" value="{{ $value->id }}" id="role_{{ $value->id }}" {{ in_array($value->id, $userRoles) ? 'checked' : '' }}>
                                        <label class="form-check-label" for="role_{{ $value->id }}">
                                            {{ $value->name }}
                                        </label>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary">Submit</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
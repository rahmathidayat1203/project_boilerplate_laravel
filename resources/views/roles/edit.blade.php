@extends('layouts.argon')

@section('content')
<div class="row">
    <div class="col-12">
        <div class="card mb-4">
            <div class="card-header pb-0 d-flex justify-content-between align-items-center">
                <h6>Edit Role</h6>
                <a class="btn btn-primary btn-sm ms-auto" href="{{ route('roles.index') }}">Back</a>
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

                <form method="POST" action="{{ route('roles.update', $role->id) }}">
                    @csrf
                    @method('PATCH')
                    <div class="form-group">
                        <label for="name">Name</label>
                        <input type="text" name="name" value="{{ $role->name }}" class="form-control" id="name" placeholder="Name">
                    </div>
                    <div class="form-group">
                        <label for="permission">Permission</label>
                        <div class="row">
                            @foreach($permissions as $value)
                                <div class="col-md-3">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" name="permissions[]" value="{{ $value->id }}" id="permission_{{ $value->id }}" {{ in_array($value->id, $rolePermissions) ? 'checked' : '' }}>
                                        <label class="form-check-label" for="permission_{{ $value->id }}">
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
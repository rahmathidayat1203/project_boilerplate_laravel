@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h4>Edit Role</h4>
                    <a class="btn btn-primary" href="{{ route('roles.index') }}">Back</a>
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
                        <div class="mb-3">
                            <label for="name" class="form-label">Name:</label>
                            <input type="text" name="name" value="{{ $role->name }}" placeholder="Name" class="form-control">
                        </div>
                        
                        <div class="mb-3">
                            <label for="permission" class="form-label">Permission:</label>
                            <div class="row">
                                @foreach($permissions as $value)
                                    <div class="col-md-3">
                                        <div class="form-check">
                                            <input type="checkbox" name="permissions[]" value="{{ $value->id }}" 
                                                {{ in_array($value->id, $rolePermissions) ? 'checked' : '' }} 
                                                class="form-check-input">
                                            <label class="form-check-label">{{ $value->name }}</label>
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
</div>
@endsection
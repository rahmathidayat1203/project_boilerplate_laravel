@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h4>Edit Permission</h4>
                    <a class="btn btn-primary" href="{{ route('permissions.index') }}">Back</a>
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

                    <form method="POST" action="{{ route('permissions.update', $permission->id) }}">
                        @csrf
                        @method('PATCH')
                        <div class="mb-3">
                            <label for="name" class="form-label">Name:</label>
                            <input type="text" name="name" value="{{ $permission->name }}" placeholder="Name" class="form-control">
                        </div>
                        
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h4>Permissions Management</h4>
                    @can('role-create')
                    <a href="{{ route('permissions.create') }}" class="btn btn-primary">Create New Permission</a>
                    @endcan
                </div>
                <div class="card-body">
                    @if(session('success'))
                        <div class="alert alert-success">{{ session('success') }}</div>
                    @endif
                    
                    <div class="table-responsive">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th width="50px">#</th>
                                    <th>Name</th>
                                    <th width="280px">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($permissions as $key => $permission)
                                <tr>
                                    <td>{{ ++$key }}</td>
                                    <td>{{ $permission->name }}</td>
                                    <td>
                                        <a class="btn btn-info btn-sm" href="{{ route('permissions.edit',$permission->id) }}">Edit</a>
                                        <form method="POST" action="{{ route('permissions.destroy', $permission->id) }}" style="display:inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                                        </form>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
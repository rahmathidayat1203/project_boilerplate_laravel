@extends('layouts.adminlte')

@section('content')
<div class="row">
    <div class="col-12">
        <div class="card mb-4">
            <div class="card-header pb-0 d-flex justify-content-between align-items-center">
                <h6>Roles</h6>
                @can('role-create')
                <a href="{{ route('roles.create') }}" class="btn btn-primary btn-sm ms-auto">Create New Role</a>
                @endcan
            </div>
            <div class="card-body px-0 pt-0 pb-2">
                <div class="table-responsive p-0">
                    <table class="table align-items-center mb-0">
                        <thead>
                            <tr>
                                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Name</th>
                                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Permissions</th>
                                <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($roles as $key => $role)
                            <tr>
                                <td>
                                    <div class="d-flex px-2 py-1">
                                        <div class="d-flex flex-column justify-content-center">
                                            <h6 class="mb-0 text-sm">{{ $role->name }}</h6>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    @if(!empty($role->permissions))
                                        @foreach($role->permissions as $permission)
                                            <span class="badge badge-sm bg-gradient-secondary">{{ $permission->name }}</span>
                                        @endforeach
                                    @endif
                                </td>
                                <td class="align-middle text-center">
                                    <a class="btn btn-info btn-sm" href="{{ route('roles.edit',$role->id) }}">Edit</a>
                                    <form method="POST" action="{{ route('roles.destroy', $role->id) }}" style="display:inline">
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
@endsection
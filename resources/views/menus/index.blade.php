@extends('layouts.adminlte')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Menu Management</h3>
                    <div class="card-tools">
                        <a href="{{ route('menus.create') }}" class="btn btn-primary">Add New Menu</a>
                    </div>
                </div>
                <div class="card-body">
                    <table class="table table-bordered table-hover">
                        <thead>
                            <tr>
                                <th>Order</th>
                                <th>Name</th>
                                <th>Route</th>
                                <th>Permission</th>
                                <th>Parent</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($menus as $menu)
                                <tr>
                                    <td>{{ $menu->order }}</td>
                                    <td>{{ $menu->name }}</td>
                                    <td>{{ $menu->route }}</td>
                                    <td><span class="badge badge-success">{{ $menu->permission_name }}</span></td>
                                    <td>{{ $menu->parent->name ?? '-' }}</td>
                                    <td>
                                        <a href="{{ route('menus.edit', $menu->id) }}" class="btn btn-sm btn-warning">Edit</a>
                                        <form action="{{ route('menus.destroy', $menu->id) }}" method="POST" style="display:inline-block;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure?')">Delete</button>
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

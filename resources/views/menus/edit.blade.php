@extends('layouts.adminlte')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Edit Menu Item</h3>
                </div>
                <form action="{{ route('menus.update', $menu->id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="card-body">
                        <div class="form-group">
                            <label for="name">Name</label>
                            <input type="text" name="name" class="form-control" id="name" placeholder="Enter menu name" value="{{ $menu->name }}" required>
                        </div>
                        <div class="form-group">
                            <label for="route">Route</label>
                            <input type="text" name="route" class="form-control" id="route" placeholder="Enter route name" value="{{ $menu->route }}" required>
                        </div>
                        <div class="form-group">
                            <label for="permission_name">Permission</label>
                            <select name="permission_name" class="form-control" id="permission_name" required>
                                <option value="">Select Permission</option>
                                @foreach($permissions as $permission)
                                    <option value="{{ $permission->name }}" {{ $menu->permission_name == $permission->name ? 'selected' : '' }}>
                                        {{ $permission->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="icon">Icon</label>
                            <input type="text" name="icon" class="form-control" id="icon" placeholder="Enter icon class (e.g., fa-users)" value="{{ $menu->icon }}">
                        </div>
                        <div class="form-group">
                            <label for="parent_id">Parent Menu</label>
                            <select name="parent_id" class="form-control" id="parent_id">
                                <option value="">No Parent</option>
                                @foreach($menus as $parentMenu)
                                    <option value="{{ $parentMenu->id }}" {{ $menu->parent_id == $parentMenu->id ? 'selected' : '' }}>
                                        {{ $parentMenu->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="order">Order</label>
                            <input type="number" name="order" class="form-control" id="order" value="{{ $menu->order }}" required>
                        </div>
                    </div>
                    <div class="card-footer">
                        <button type="submit" class="btn btn-primary">Update</button>
                        <a href="{{ route('menus.index') }}" class="btn btn-secondary">Cancel</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

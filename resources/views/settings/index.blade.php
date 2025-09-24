@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h4>Application Settings</h4>
                </div>
                <div class="card-body">
                    @if(session('success'))
                        <div class="alert alert-success">{{ session('success') }}</div>
                    @endif
                    
                    <div class="table-responsive">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>Key</th>
                                    <th>Value</th>
                                    <th>Type</th>
                                    <th width="280px">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($settings as $setting)
                                <tr>
                                    <td>{{ $setting->key }}</td>
                                    <td>{{ $setting->value }}</td>
                                    <td>{{ $setting->type }}</td>
                                    <td>
                                        <button type="button" class="btn btn-info btn-sm" data-bs-toggle="modal" data-bs-target="#editSettingModal{{ $setting->id }}">
                                            Edit
                                        </button>
                                        <form method="POST" action="{{ route('settings.destroy', $setting->id) }}" style="display:inline">
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

<!-- Edit Setting Modals -->
@foreach ($settings as $setting)
<div class="modal fade" id="editSettingModal{{ $setting->id }}" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Edit Setting</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <form method="POST" action="{{ route('settings.update', $setting->id) }}">
                @csrf
                @method('PUT')
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="key" class="form-label">Key</label>
                        <input type="text" class="form-control" value="{{ $setting->key }}" disabled>
                    </div>
                    <div class="mb-3">
                        <label for="value" class="form-label">Value</label>
                        <input type="text" name="value" class="form-control" value="{{ $setting->value }}">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Save changes</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endforeach
@endsection
@extends('layouts.adminlte')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h4>Edit Setting: {{ $setting->key }}</h4>
                </div>
                <div class="card-body">
                    <form method="POST" action="{{ route('settings.update', $setting->id) }}">
                        @csrf
                        @method('PUT')
                        
                        <div class="form-group">
                            <label for="key">Key</label>
                            <input type="text" class="form-control" id="key" value="{{ $setting->key }}" disabled>
                        </div>
                        
                        <div class="form-group">
                            <label for="value">Value</label>
                            <input type="text" name="value" class="form-control" id="value" value="{{ old('value', $setting->value) }}" required>
                        </div>
                        
                        <button type="submit" class="btn btn-primary">Update Setting</button>
                        <a href="{{ route('settings.index') }}" class="btn btn-secondary">Cancel</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
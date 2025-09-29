@extends('layouts.adminlte')

@section('content')
<div class="row">
    <div class="col-12">
        <div class="card mb-4">
            <div class="card-header pb-0">
                <h6>Users</h6>
            </div>
            <div class="card-body px-0 pt-0 pb-2">
                <div class="table-responsive p-0">
                    {!! $dataTable->table(['class' => 'table align-items-center mb-0']) !!}
                </div>
            </div>
        </div>
    </div>
</div>

@push('scripts')
    {!! $dataTable->scripts() !!}
@endpush
@endsection
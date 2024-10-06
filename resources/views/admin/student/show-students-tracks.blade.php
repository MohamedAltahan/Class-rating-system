@extends('admin.layouts.master')
@section('mainTitle', __('Students'))
@section('content')

    <div class="card-header">
        <h4>{{ __('Chose track') }}</h4>

    </div>
    <div class="card-body">
        {{ $dataTable->table() }}
    </div>

@endsection
@push('scripts')
    {{ $dataTable->scripts(attributes: ['type' => 'module']) }}
@endpush

@extends('admin.layouts.master')
@section('mainTitle', __('Students'))
@section('content')

    <div class="card-header">
        <h4>{{ __('Chose track') }}</h4>
        <div class="card-header-action">
            <a href="{{ route('admin.student.create') }}" class="btn btn-primary">{{ __('+ Create new') }}</a>
        </div>
    </div>
    <div class="card-body">
        {{ $dataTable->table() }}
    </div>

@endsection
@push('scripts')
    {{ $dataTable->scripts(attributes: ['type' => 'module']) }}
@endpush

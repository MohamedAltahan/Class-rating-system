@extends('admin.layouts.master')
@section('mainTitle', __('Ratings'))
@section('content')

    <div class="card-header">
        <h4>{{ __("All materials' ratings") }}</h4>

    </div>
    <div class="card-body">
        {{ $dataTable->table() }}
    </div>

    {{-- scripts ----------------------------------------------------------- --}}
    @push('scripts')
        {{ $dataTable->scripts(attributes: ['type' => 'module']) }}
    @endpush
@endsection

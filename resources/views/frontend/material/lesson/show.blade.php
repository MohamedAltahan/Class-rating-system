@extends('frontend.dashboard.layouts.master')
@section('mainTitle', __('Lessons'))
@section('content')

    <div class="card-header">
        <h4>{{ __('All lessons for') }}{{ ' : ' . $material->name }}</h4>
        <div class="card-header-action">
        </div>
    </div>

    <div class="card-body">
        {{ $dataTable->table() }}
    </div>

    {{-- scripts ----------------------------------------------------------- --}}
    @push('scripts')
        {{ $dataTable->scripts(attributes: ['type' => 'module']) }}
    @endpush
@endsection

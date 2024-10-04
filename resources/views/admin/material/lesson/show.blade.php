@extends('admin.layouts.master')
@section('mainTitle', __('Lessons'))
@section('content')

    <div class="card-header">
        <h4>{{ __('All lessons for') }}{{ ' : ' . $material->name }}</h4>
        <div class="card-header-action">
            <a href="{{ route('admin.lesson.create', ['materialId' => $material->id, 'trackId' => $material->track->id]) }}"
                class="btn btn-primary">{{ __('+ Create lesson') }}</a>
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

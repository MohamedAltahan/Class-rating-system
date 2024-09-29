@extends('admin.layouts.master')
@section('mainTitle', __('Student materials'))
@section('content')

    <div class="card-header">
        <h4>{{ $student->name }}</h4>
        <div class="card-header-action">
            <a href="{{ route('admin.student.materials.create', ['studentId' => $student->id]) }}"
                class="btn btn-primary">{{ __('+ Create new') }}</a>
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

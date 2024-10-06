@extends("frontend.dashboard.layouts.master")

@section('mainTitle', __('Lessons'))
@section('content')

    <div class="card-header">
        <h4>{{ __('All materials') }}</h4>
    </div>

    <div class="card-body">
        {{ $dataTable->table() }}
    </div>

    {{-- scripts ----------------------------------------------------------- --}}
    @push('scripts')
        {{ $dataTable->scripts(attributes: ['type' => 'module']) }}
    @endpush
@endsection

@extends("frontend.dashboard.layouts.master")
@section('mainTitle', __('Lessons'))
@section('content')

    <div class="card-header">
        <h4>{{ __('Create lesson') }}</h4>
        <div class="card-header-action">
        </div>
    </div>
    <div class="card-body">
        <form action="{{ route('admin.lesson.store') }}" method="POST">
            @csrf
            @include('admin.material.lesson._form')
        </form>
    </div>

@endsection

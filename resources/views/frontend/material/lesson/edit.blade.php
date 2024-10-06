@extends("frontend.dashboard.layouts.master")

@section('mainTitle', __('Lessons'))
@section('content')

    <div class="card-header">
        <h4>{{ __('Edit leson') }}</h4>
        <div class="card-header-action">
        </div>
    </div>
    <div class="card-body">
        <form action="{{ route('admin.lesson.update', $lesson->id) }}" method="POST">
            @csrf
            @method('PUT')
            @include('admin.material.lesson._form', ['buttonLabel' => 'Update'])
        </form>
    </div>

@endsection

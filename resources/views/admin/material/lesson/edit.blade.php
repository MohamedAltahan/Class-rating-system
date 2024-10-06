@extends('admin.layouts.master')
@section('mainTitle', __('Lessons'))
@section('content')

    <div class="card-header">
        <h4>{{ __('Edit leson') }}{{ ' : ' . $material->name }}</h4>
    </div>
    <div class="card-body">
        <form action="{{ route('admin.lesson.update', $lesson->id) }}" method="POST">
            @csrf
            @method('PUT')
            @include('admin.material.lesson._form', ['buttonLabel' => 'Update'])
        </form>
    </div>

@endsection

@extends('admin.layouts.master')
@section('mainTitle', __('Lessons'))
@section('content')

    <div class="card-header">
        <h4>{{ __('Create lesson') }}{{ ' : ' . $material->name }}</h4>
    </div>
    <div class="card-body">
        <form action="{{ route('admin.lesson.store') }}" method="POST">
            @csrf
            @include('admin.material.lesson._form')
        </form>
    </div>

@endsection

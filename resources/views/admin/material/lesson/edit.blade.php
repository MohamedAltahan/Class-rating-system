@extends('admin.layouts.master')
@section('mainTitle', __('Teachers'))
@section('content')

    <div class="card-header">
        <h4>{{ __('Edit teacher') }}</h4>
        <div class="card-header-action">
        </div>
    </div>
    <div class="card-body">
        <form action="{{ route('admin.teacher.materials.update', $material->id) }}" method="POST">
            @csrf
            @method('PUT')
            @include('admin.teacher._form', ['buttonLabel' => 'Update'])
        </form>
    </div>

@endsection

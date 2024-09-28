@extends('admin.layouts.master')
@section('mainTitle', __('Students'))
@section('content')
    <!-- Main Content -->
    <div class="card-header">
        <h4>{{ __('Edit student') }}</h4>
        <div class="card-header-action">
        </div>
    </div>
    <div class="card-body">
        <form action="{{ route('admin.student.update', $student->id) }}" method="POST">
            @csrf
            @method('PUT')

            @include('admin.student._form')

            <button type="submit" class="btn btn-primary">{{ __('Update') }}</button>

        </form>
    </div>
@endsection

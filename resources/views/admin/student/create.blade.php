@extends('admin.layouts.master')
@section('mainTitle', __('Students'))
@section('content')

    <div class="card-header">
        <h4>{{ __('Create student') }}</h4>
        <div class="card-header-action">
        </div>
    </div>

    <div class="card-body">
        <form action="{{ route('admin.student.store') }}" method="POST">
            @csrf
            @include('admin.student._form')

            <button type="submit" class="btn btn-primary">{{__('Create')}}</button>

        </form>
    </div>

@endsection

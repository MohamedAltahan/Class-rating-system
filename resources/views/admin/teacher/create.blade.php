@extends('admin.layouts.master')
@section('mainTitle', __('Teachers'))
@section('content')

    <div class="card-header">
        <h4>{{ __('Create teacher') }}</h4>
        <div class="card-header-action">
        </div>
    </div>
    <div class="card-body">
        <form action="{{ route('admin.teacher.store') }}" method="POST">
            @csrf
            @include('admin.teacher._form')
        </form>
    </div>

@endsection

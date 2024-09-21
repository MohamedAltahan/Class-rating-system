@extends('admin.layouts.master')
@section('mainTitle', __('Education tracks'))
@section('content')

    <div class="card-header">
        <h4>{{ __('Create teacher') }}</h4>
        <div class="card-header-action">
        </div>
    </div>
    <div class="card-body">
        <form action="{{ route('admin.track.store') }}" method="POST">
            @csrf
            @include('admin.track._form')
        </form>
    </div>

@endsection

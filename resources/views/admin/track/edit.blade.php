@extends('admin.layouts.master')
@section('mainTitle', __('Education tracks'))
@section('content')

    <div class="card-header">
        <h4>{{ __('Edit track') }}</h4>
        <div class="card-header-action">
        </div>
    </div>

    <div class="card-body">
        <form action="{{ route('admin.track.update', $track->id) }}" method="POST">
            @csrf
            @method('PUT')
            @include('admin.track._form', ['buttonLabel' => 'Update'])
        </form>
    </div>

@endsection

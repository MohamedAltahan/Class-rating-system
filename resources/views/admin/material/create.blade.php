@extends('admin.layouts.master')
@section('mainTitle', __('Materials'))
@section('content')

    <div class="card-header">
        <h4>{{ __('Create material') }}</h4>
        <div class="card-header-action">
            
        </div>
    </div>

    <div class="card-body">
        <form action="{{ route('admin.material.store') }}" method="POST">
            @csrf

            <div class="form-group">
                <x-form.input name="name" label="Material name" class="form-control" />
            </div>

            <div class="form-group">
                <label for="">{{ __('Track') }}</label>
                <select name="track_id" class="form-control">
                    @if (isset($tracks))
                        @foreach ($tracks as $track)
                            <option value="{{ $track->id }}">{{ __($track->name) }}</option>
                        @endforeach
                    @else
                        <option value="">{{ __('No value') }}</option>
                    @endif
                </select>
            </div>

            <div class="form-group">
                <label for="">{{ __('Status') }}</label>
                <select name="status" id="inputStatus" class="form-control">
                    <option value="active">{{ __('Active') }}</option>
                    <option value="inactive">{{ __('Inactive') }}</option>
                </select>
            </div>

            <button type="submit" class="btn btn-primary">{{ __('Create') }}</button>

        </form>
    </div>

@endsection

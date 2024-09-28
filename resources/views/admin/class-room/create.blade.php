@extends('admin.layouts.master')
@section('mainTitle', __('Class rooms'))
@section('content')

    <div class="card-header">
        <h4>{{ __('Create class room') }}</h4>
        <div class="card-header-action">
        </div>
    </div>

    <div class="card-body">
        <form action="{{ route('admin.class-room.store') }}" method="POST">
            @csrf

            <div class="form-group">
                <x-form.input name="name" label="Class room name" class="form-control" />
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

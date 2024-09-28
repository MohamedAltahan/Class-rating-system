@extends('admin.layouts.master')
@section('mainTitle', __('Classes'))
@section('content')

    <div class="card-header">
        <h4>{{ __('Update class') }}</h4>
        <div class="card-header-action">
        </div>
    </div>

    <div class="card-body">

        <form action="{{ route('admin.class.update', $class->id) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="form-group">
                <x-form.input name="name" label="Class name" class="form-control" value="{{ $class->name }}" />
            </div>


            <div class="form-group">
                <label for="">{{ __('Status') }}</label>
                <select name="status" class="form-control">
                    <option value="active" @selected(@$class->status == 'active')>{{ __('Active') }}</option>
                    <option value="inactive" @selected(@$class->status == 'inactive')>{{ __('Inactive') }}</option>
                </select>
            </div>

            <button type="submit" class="btn btn-primary">{{ __('Update') }}</button>

        </form>
    </div>

@endsection

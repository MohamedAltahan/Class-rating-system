@extends('admin.layouts.master')
@section('mainTitle', __('Study year'))
@section('content')

    <div class="card-header">
        <h4>{{ __('Update study year') }}</h4>
        <div class="card-header-action">
        </div>
    </div>

    <div class="card-body">

        <form action="{{ route('admin.material.update', $material->id) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="form-group">
                <x-form.input name="name" label="Material name" class="form-control" value="{{ $material->name }}" />
            </div>


            <div class="form-group">
                <label for="">{{ __('Status') }}</label>
                <select name="status" class="form-control">
                    <option value="active" @selected(@$material->status == 'active')>{{ __('Active') }}</option>
                    <option value="inactive" @selected(@$material->status == 'inactive')>{{ __('Inactive') }}</option>
                </select>
            </div>

            <button type="submit" class="btn btn-primary">{{ __('Update') }}</button>

        </form>
    </div>

@endsection

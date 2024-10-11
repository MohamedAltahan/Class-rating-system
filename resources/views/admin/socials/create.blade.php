@extends('admin.layouts.master')
@section('mainTitle', __('Socials'))
@section('content')

    <div class="card-header">
        <h4>{{ __('Create social button') }}</h4>
        <div class="card-header-action">
        </div>
    </div>

    <div class="card-body">
        <form action="{{ route('admin.socials.store') }}" method="POST">
            @csrf

            <div class="form-group">
                <label for="">{{ __('Select icon') }}</label>
                <div>
                    <button name="icon" data-selected-class="btn-danger" data-unselected-class="btn-info"
                        class="btn btn-primary" role="iconpicker"></button>
                    @error('icon')
                        <div class="text-danger">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
            </div>

            <div class="form-group">
                <x-form.input name="name" label="Name" class="form-control" />
            </div>

            <div class="form-group">
                <x-form.input name="link" label="Button Link" class="form-control" />
            </div>

            <div class="form-group">
                <label for="">{{ __('Status') }}</label>
                <select name="status" id="inputStatus" class="form-control">
                    <option value="active">{{ __('Active') }}</option>
                    <option value="inactive">{{ __('Inactive') }}</option>
                </select>
            </div>

            <button type="submit" class="btn btn-primary">{{__('Create')}}</button>

        </form>
    </div>

@endsection

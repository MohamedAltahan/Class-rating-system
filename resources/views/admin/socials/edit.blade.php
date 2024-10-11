@extends('admin.layouts.master')
@section('mainTitle', __('Socials'))
@section('content')

    <div class="card-header">
        <h4>{{ __('Update social button') }}</h4>
        <div class="card-header-action">
        </div>
    </div>

    <div class="card-body">
        <form action="{{ route('admin.socials.update', $footerButtonInfo->id) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="form-group">
                <label for="">{{ __('Select icon') }}</label>
                <div>
                    <button name="icon" data-selected-class="btn-danger" data-unselected-class="btn-info"
                        class="btn btn-primary" role="iconpicker" data-icon="{{ $footerButtonInfo->icon }}"></button>
                    @error('icon')
                        <div class="text-danger">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
            </div>

            <div class="form-group">
                <x-form.input name="name" label="Name" value="{{ $footerButtonInfo->name }}" class="form-control" />
            </div>

            <div class="form-group">
                <x-form.input name="link" label="Button Link" value="{{ $footerButtonInfo->link }}"
                    class="form-control" />
            </div>

            <div class="form-group">
                <label for="">{{ __('Status') }}</label>
                <select name="status" id="inputStatus" class="form-control">
                    <option @selected($footerButtonInfo->status == 'active') value="active">{{ __('Active') }}</option>
                    <option @selected($footerButtonInfo->status == 'inactive') value="inactive">{{ __('Inactive') }}</option>
                </select>
            </div>

            <button type="submit" class="btn btn-primary">{{ __('Update') }}</button>

        </form>
    </div>

@endsection

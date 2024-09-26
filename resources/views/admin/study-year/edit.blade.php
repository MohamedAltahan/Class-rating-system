@extends('admin.layouts.master')
@section('mainTitle', __('Study year'))
@section('content')

    <div class="card-header">
        <h4>{{ __('Update study year') }}</h4>
        <div class="card-header-action">
        </div>
    </div>

    <div class="card-body">

        <form action="{{ route('admin.study-year.update', $studyYear->id) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="form-group">
                <x-form.input name="name" label="Name" class="form-control" value="{{ $studyYear->name }}" />
            </div>


            <div class="form-group">
                <label for="">{{ __('Status') }}</label>
                <select name="status" id="inputStatus" class="form-control">
                    <option value="active">{{ __('Active') }}</option>
                    <option value="inactive">{{ __('Inactive') }}</option>
                </select>
            </div>

            <button type="submit" class="btn btn-primary">{{ __('Update') }}</button>

        </form>
    </div>

@endsection

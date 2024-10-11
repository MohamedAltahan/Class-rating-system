@extends('admin.layouts.master')
@section('mainTitle', __('Student materials'))
@section('content')

    <div class="card-header">
        <h4>{{ __('Create material') }}</h4>
        <div class="card-header-action">
        </div>
    </div>
    <div class="card-body">
        <form action="{{ route('admin.student.materials.store', ['student_id' => $studentId]) }}" method="POST">
            @csrf

            <div class="form-group">
                <label for="">{{ __('Materials') }}</label>
                <select name="material_id" class="form-control">
                    @foreach ($materials as $material)
                        <option value="{{ $material->id }}">{{ __($material->name) }} ({{ $material->track->name }})
                        </option>
                    @endforeach
                </select>
            </div>

            <button type="submit" class="btn btn-primary">{{ __('Create') }}</button>

        </form>
    </div>

@endsection

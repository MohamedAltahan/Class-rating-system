@extends('admin.layouts.master')
@section('mainTitle', __('Ratings'))
@section('content')

    <div class="card-header">
        <h4>{{ __('Lesson details') }}{{ ' : ' . $lesson->name }}</h4>
    </div>

    <div class="card-body">
        <table class="table">
            <thead>
                <tr>
                    <th scope="col">{{ __('Rating count') }}</th>
                    <th scope="col">{{ __('Minimum Rating') }}</th>
                    <th scope="col">{{ __('Average Rating') }}</th>
                    <th scope="col">{{ __('Maximum Rating') }}</th>
                    <th scope="col">{{ __('Count comments') }}</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>{{ $lesson->ratings_count ?? 0 }}</td>
                    <td>{{ $lesson->ratings_min_rating ?? 0 }}</td>
                    <td>{{ round($lesson->ratings_avg_rating, 1) ?? 0 }}</td>
                    <td>{{ $lesson->ratings_max_rating ?? 0 }}</td>
                    <td>{{ $lesson->comments_count ?? 0 }}</td>
                </tr>
            </tbody>
        </table>
    </div>

    @include('admin.comment.comment-modal')

    @push('scripts')
    @endpush
@endsection

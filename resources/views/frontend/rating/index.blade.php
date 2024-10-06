@extends('frontend.dashboard.layouts.master')
@section('mainTitle', __('Ratings'))
@section('content')

    <div class="card-header">
        <h4>{{ __('Rate lesson') }}{{ ' : ' . $lesson->name }}</h4>

    </div>
    <div class="card-body">

        <form id="myForm" action="{{ route('lesson.submit-rating') }}" method="POST">
            @csrf
            <input type="hidden" name="lesson_id" value="{{ $lesson->id }}">
            <input type="hidden" name="material_id" value="{{ $materialId }}">
            <div class="form-group w-">
                <label class="form-label">{{ __('Select rating from 1 to 5') }}</label>
                <div class="selectgroup w-100">
                    <label class="selectgroup-item">
                        <input type="radio" name="rating" value="1" @checked(@$rating->rating == 1)
                            class="selectgroup-input">
                        <span class="selectgroup-button">1<i class="fas fa-star"></i></span>
                    </label>
                    <label class="selectgroup-item">
                        <input type="radio" name="rating" value="2" @checked(@$rating->rating == 2)
                            class="selectgroup-input">
                        <span class="selectgroup-button">2<i class="fas fa-star"></i></span>
                    </label>
                    <label class="selectgroup-item">
                        <input type="radio" name="rating" value="3" @checked(@$rating->rating == 3)
                            class="selectgroup-input">
                        <span class="selectgroup-button">3<i class="fas fa-star"></i></span>
                    </label>
                    <label class="selectgroup-item">
                        <input type="radio" name="rating" value="4" @checked(@$rating->rating == 4)
                            class="selectgroup-input">
                        <span class="selectgroup-button">4<i class="fas fa-star"></i></span>
                    </label>
                    <label class="selectgroup-item">
                        <input type="radio" name="rating" value="5" @checked(@$rating->rating == 5)
                            class="selectgroup-input">
                        <span class="selectgroup-button">5<i class="fas fa-star"></i></span>
                    </label>
                </div>
            </div>
        </form>
    </div>

    @include('frontend.material.lesson.comment.comment-modal')

@endsection
@push('scripts')
    <script>
        $(document).ready(function() {

            $('input[name="rating"]').on('change', function(e) {
                e.preventDefault();
                var formData = $('#myForm').serialize();
                $.ajax({
                    url: $('#myForm').attr('action'),
                    method: 'POST',
                    data: formData,
                    success: function(data) {
                        toastr.success(data.message)
                    },
                    error: function(error) {
                        toastr.error('Not updated')
                    }
                });
            });
        });
    </script>
@endpush

<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <!-- Display Comments -->
            <div class="mt-4">
                <p class=" text-primary  fs-2 d-inline">{{ __('(admin can only delete any comment)') }}</p>
                <h5 class="text-primary d-inline">{{ __('Comments') }} </h5>
                @forelse($lesson->comments as $comment)
                    <div class="card mt-2">
                        <div class="card-body">
                            <p class="text-muted">{{ @$comment->user->name }} :
                                {{ Alkoumi\LaravelHijriDate\Hijri::Date('Y-m-d g:i A', @$comment->created_at) }}</p>
                            <h5 class="mb-1">{{ @$comment->comment }}</h5>
                            <a class="text-danger delete-item"
                                href="{{ route('admin.comment.destroy', $comment->id) }}">{{ __('Delete') }}</a>
                        </div>
                    </div>
                @empty
                    <p class="text-danger">{{ __('No comments yet.') }}</p>
                @endforelse
            </div>
            <!-- Comment Form -->
            <div class="card">
                <div class="card-body">
                    <form action="{{ route('admin.comment.store') }}" method="POST">
                        @csrf
                        <x-form.input name='lesson_id' type='hidden' value="{{ $lesson->id }}" />

                        <div class="mb-3">
                            <label for="comment" class="form-label">{{ __('Write comment') }}</label>
                            <textarea class="form-control @error('comment') is-invalid @enderror" id="comment" name="comment" rows="4"
                                placeholder="{{ __('Write your comment here...') }}" required></textarea>
                            @error('comment')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <button type="submit" class="btn btn-primary">{{ __('Add comment') }}</button>
                    </form>
                </div>
            </div>

        </div>
    </div>
</div>

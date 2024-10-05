<div class="form-group">
    <x-form.input name="name" label="Lesson name" class="form-control" value="{{ @$lesson->name }}" />
</div>

<div class="form-group">
    <x-form.input name="material_id" type="hidden" value="{{ $materialId ?? $lesson->material_id }}" />
</div>

<div class="form-group">
    <x-form.input name="track_id" type="hidden" value="{{ $trackId ?? $lesson->track_id }}" />
</div>

<div class="form-group">
    <x-form.input label='Lesson time' name="date_time" type="text" id="hijri-date-input"
        value="{{ @$lesson->date_time }}" />
</div>

<div class="form-group">
    <label for="">{{ __('Teacher') }}</label>
    <select name="teacher_id" class="form-control">
        @forelse ($teachers as $teacher)
            <option value="{{ @$teacher->id }}" @selected(@$teacher->id == @$lesson->teacher_id)>{{ __(@$teacher->name) }}</option>
        @empty
            <option value="">{{ __('No teachers please add') }}</option>
        @endforelse
    </select>
</div>

<div class="form-group">
    <label for="">{{ __('Status') }}</label>
    <select name="status" class="form-control">
        <option value="active" @selected(@$lesson->status == 'active')>{{ __('Active') }}</option>
        <option value="inactive" @selected(@$lesson->status == 'inactive')>{{ __('Inactive') }}</option>
    </select>
</div>

<button type="submit" class="btn btn-primary">{{ $buttonLabel ?? __('Create') }}</button>

@push('scripts')
    <script>
        $("#hijri-date-input").hijriDatePicker({
            icons: {
                time: 'fa fa-clock text-primary',
                date: 'glyphicon glyphicon-calendar',
                up: 'fa fa-chevron-up text-primary',
                down: 'fa fa-chevron-down text-primary',
                previous: '<<',
                next: '>>',
                today: 'اليوم',
                clear: 'مسح',
                close: 'اغلاق'
            },
            defaultDate: moment(),
            showTodayButton: true,
            showClear: true,
            showClose: true,
            sideBySide: true,
            allowInputToggle: true,
            showSwitcher: true,
            focusOnShow: true,
            locale: 'ar-SA',
            format: 'DD-MM-YYYY HH:mm',
            hijriFormat: 'iYYYY-iMM-iDD HH:mm',
            hijri: true,

        });
    </script>
@endpush

<div class="row">

    <div class="form-group col-md-6">
        <x-form.input name="name" label="Student name" class="form-control" value="{{ @$student->name }}" />
    </div>

    <div class="form-group col-md-6">
        <x-form.input name="parent_name" label="Parent name" class="form-control" value="{{ @$student->parent_name }}" />
    </div>

    <div class="form-group col-md-6">
        <label for="">{{ __('Studing status') }}</label>
        <select name="studing_status" id="inputStatus" class="form-control">
            <option value="continuous" @selected(@$teacher->studing_status == 'continuous')>{{ __('Continuous') }}</option>
            <option value="pending" @selected(@$teacher->studing_status == 'pending')>{{ __('Pending') }}</option>
        </select>
    </div>

    <div class="form-group col-md-6">
        <x-form.input name="birth_place" label="Birth place" class="form-control"
            value="{{ @$student->birth_place }}" />
    </div>

    <div class="form-group col-md-6">
        <x-form.input label='Birth date' name="birth_date" type="text" class="form-control hijri-date-input"
            value="{{ @$student->birth_date }}" />
    </div>

    <div class="form-group col-md-6">
        <x-form.input name="nationality" label="Nationality" class="form-control"
            value="{{ @$student->nationality }}" />
    </div>

    <div class="form-group col-md-6">
        <x-form.input name="residence_number" label="Residence number" class="form-control"
            value="{{ @$student->residence_number }}" />
    </div>

    <div class="form-group col-md-6">
        <x-form.input label='Residence date' name="residence_date" type="text" class="form-control hijri-date-input"
            value="{{ @$student->residence_date }}" />
    </div>

    <div class="form-group col-md-6">
        <label for="">{{ __('Track') }}</label>
        <select name="track_id" class="form-control">
            @forelse ($tracks as $track)
                <option value="{{ old('track_id', $track->id) }}" @selected(@$track->id == @$student->track_id)>{{ __($track->name) }}
                </option>
            @empty
                <option value="">{{ __('No value') }}</option>
            @endforelse
        </select>
    </div>

    <div class="form-group col-md-6">
        <label for="">{{ __('Class') }}</label>
        <select name="class_id" class="form-control">
            @forelse ($classes as $class)
                <option value="{{ old('class_id', $class->id) }}" @selected(@$class->id == @$student->class_id)>{{ __($class->name) }}
                </option>
            @empty
                <option value="">{{ __('No value') }}</option>
            @endforelse
        </select>
    </div>

    <div class="form-group col-md-6">
        <label for="">{{ __('Class room') }}</label>
        <select name="class_room_id" class="form-control">
            @forelse ($rooms as $room)
                <option value="{{ old('class_room_id', $room->id) }}" @selected(@$room->id == @$student->class_room_id)>
                    {{ __($room->name) }}
                </option>
            @empty
                <option value="">{{ __('No value') }}</option>
            @endforelse
        </select>
    </div>

    <div class="form-group col-md-6">
        <x-form.input name="landline_number" label="Landline number" class="form-control"
            value="{{ @$student->landline_number }}" />
    </div>

    <div class="form-group col-md-6">
        <x-form.input name="phone" label="Phone" class="form-control" value="{{ @$student->phone }}" />
    </div>

    @if (@$operation == 'update')
        <div class="form-group col-md-6">
            <x-form.input name="password" label="Password(let it empty to save with old password)"
                class="form-control" />
        </div>
    @else
        <div class="form-group col-md-6">
            <x-form.input name="password" label="Password min is 6 character" class="form-control" />
        </div>
    @endif

    <div class="form-group col-md-6">
        <label for="">{{ __('Status') }}</label>
        <select name="status" class="form-control">
            <option value="active" @selected(@$student->status == 'active')>{{ __('Active') }}</option>
            <option value="inactive" @selected(@$student->status == 'inactive')>{{ __('Inactive') }}</option>
        </select>
    </div>
</div>

@push('scripts')
    <script>
        $(".hijri-date-input").hijriDatePicker({

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

            showTodayButton: true,
            showClear: true,
            showClose: true,

            allowInputToggle: true,
            showSwitcher: true,
            focusOnShow: true,
            locale: 'ar-SA',
            format: 'DD-MM-YYYY',
            hijriFormat: 'iDD/iMM/iYYYY',
            hijri: true,

        });
    </script>
@endpush

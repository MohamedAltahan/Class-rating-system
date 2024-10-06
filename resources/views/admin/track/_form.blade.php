<div class="form-group">
    <x-form.input name="name" label="Name" class="form-control" value="{{ @$track->name }}" />
</div>

<div class="form-group">
    <label for="">{{ __('status') }}</label>
    <select name="status" class="form-control">
        <option value="active" @selected(@$track->status == 'active')>{{ __('Active') }}</option>
        <option value="inactive" @selected(@$track->status == 'inactive')>{{ __('Inactive') }}</option>
    </select>
</div>

<button type="submit" class="btn btn-primary">{{ __(@$buttonLabel) ?? __('Create') }}</button>

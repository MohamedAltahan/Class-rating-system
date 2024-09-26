<div class="form-group">
    <x-form.input name="name" label="Name" class="form-control" value="{{ @$teacher->name }}" />
</div>

<label>{{ __('Teacher information') }}</label>
<div class="form-group">
    <textarea class="form-control" name='description'
        placeholder="Enter here teacher's information(like classes, studying years,..)">{{ @$teacher->description }}</textarea>
</div>

<div class="form-group">
    <x-form.input name="phone" label="Phone" class="form-control" value="{{ @$teacher->phone }}" />
</div>

<div class="form-group">
    <label for="">{{ __('Status') }}</label>
    <select name="status" class="form-control">
        <option value="active" @selected(@$teacher->status == 'active')>{{ __('Active') }}</option>
        <option value="inactive" @selected(@$teacher->status == 'inactive')>{{ __('Inactive') }}</option>
    </select>
</div>

<button type="submit" class="btn btn-primary">{{ $buttonLabel ?? __('Create') }}</button>

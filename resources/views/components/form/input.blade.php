@props([
    'type' => 'text',
    'name' => '',
    'value' => '',
    'class' => '',
    'label' => '',
    'placeholder' => '',
    'checked' => false,
    'disabled' => false,
])
@if ($label)
    <label for="">{{ __($label) }}</label>
@endif

<input type="{{ $type }}" name="{{ $name }}" value='{{ old($name, $value) }}'
    class="form-control {{ $class }}" placeholder="{{ __($placeholder) }}"
    @if ($checked) checked @endif @if ($disabled) disabled @endif
    {{ $attributes }}>

@error($name)
    <div class="text-danger">
        {{ $message }}
    </div>
@enderror

{{-- $attributes --> will be replaced by any attributes which isn't denfined in propes --}}

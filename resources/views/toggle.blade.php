@php
    /** @var $name */
    /** @var $value */
    /** @var $checked */
    /** @var \Illuminate\Support\ViewErrorBag $errors */
    /** @var \Illuminate\Support\Collection $attributes */
    $attributes = collect($attributes);

    $title = $attributes->get('title');
    $alternative = $attributes->get('alternative', false);
    $id = $attributes->get('id', $name);
@endphp

<label for="{{ $id }}" class="custom-toggle mx-auto">
    {!! Form::checkbox($name, $value, $checked, $attributes->all()) !!}
    <span class="custom-toggle-slider rounded-circle"></span>
</label>

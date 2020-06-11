@php
    /** @var $name */
    /** @var $type */
    /** @var $value */
    /** @var \Illuminate\Support\ViewErrorBag $errors */
    /** @var \Illuminate\Support\Collection $attributes */
    $attributes = collect($attributes);
@endphp

@component('microboard::layout.partials.base-input', compact('name', 'attributes'))
    {!! Form::input($type, $name, $value, $attributes->merge([
        'class' => 'form-control' . ($errors->has($name) ? ' is-invalid' : ''),
        'placeholder' => $attributes->get('title')
    ])
    ->except(['title', 'hideLabel', 'alternative', 'icon'])
    ->all()) !!}
@endcomponent

@php
    /** @var $name */
    /** @var $value */
    /** @var \Illuminate\Support\ViewErrorBag $errors */
    /** @var \Illuminate\Support\Collection $attributes */
    $attributes = collect($attributes);

    $id = $attributes->get('id');

    if ($bag = $attributes->get('errorBag', false)) {
        $errors = $errors->{$bag};
    }
    $errorName = $attributes->get('errorName', $id ?? $name);

    $class = 'form-control' . ($errors->has($errorName) ? ' is-invalid' : '') . ($attributes->get('alternative', false) ? ' form-control-alternative' : '');
@endphp

@component('microboard::layout.partials.base-input', compact('name', 'attributes'))
    {!! Form::textarea($name, $value, $attributes->merge([
        'class' => $class,
        'placeholder' => $attributes->get('title'),
        'rows' => 3
    ])
    ->except(['title', 'hideLabel', 'alternative', 'icon', 'errorBag', 'errorName', 'hideHelpIcon', 'formClass'])
    ->all()) !!}
@endcomponent

@php
    /** @var $name */
    /** @var $type */
    /** @var $value */
    /** @var \Illuminate\Support\ViewErrorBag $errors */
    /** @var \Illuminate\Support\Collection $attributes */
    $attributes = collect($attributes);

    $id = $attributes->get('id', $name);

    if ($bag = $attributes->get('errorBag', false)) {
        $errors = $errors->{$bag};
    }
    $errorName = $attributes->get('errorName', $id);

    $class = 'form-control' . ($errors->has($errorName) ? ' is-invalid' : '') . ($attributes->get('alternative', false) ? ' form-control-alternative' : '');
@endphp

@component('microboard::layouts.partials.base-input', compact('name', 'attributes'))
    {!! Form::input($type, $name, $value, $attributes->merge([
        'class' => $class,
        'placeholder' => $attributes->get('title'),
        'id' => $id
    ])
    ->except(['title', 'hideLabel', 'alternative', 'icon', 'errorBag', 'errorName', 'hideHelpIcon', 'formClass'])
    ->all()) !!}
@endcomponent

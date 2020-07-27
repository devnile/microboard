@php
    use Illuminate\Support\Collection;
    use Illuminate\Support\ViewErrorBag;

    /** @var $name */
    /** @var $value */
    /** @var ViewErrorBag $errors */
    /** @var Collection $attributes */
    $attributes = collect($attributes);

    $id = $attributes->get('id', $name);

    if ($bag = $attributes->get('errorBag', false)) {
        $errors = $errors->{$bag};
    }
    $errorName = $attributes->get('errorName', $id);

    $class = 'form-control' . ($errors->has($errorName) ? ' is-invalid' : '') . ($attributes->get('alternative', false) ? ' form-control-alternative' : '')
@endphp

@component('microboard::layouts.partials.base-input', compact('name', 'attributes'))
    {!! Form::textarea($name, $value, $attributes->merge([
        'class' => $class,
        'placeholder' => $attributes->get('title'),
        'rows' => 3,
        'id' => $id
    ])
    ->except(['title', 'hideLabel', 'alternative', 'icon', 'errorBag', 'errorName', 'hideHelpIcon', 'formClass'])
    ->all()) !!}
@endcomponent

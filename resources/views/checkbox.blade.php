@php
    /** @var $name */
    /** @var $value */
    /** @var \Illuminate\Support\ViewErrorBag $errors */
    /** @var \Illuminate\Support\Collection $attributes */
    $attributes = collect($attributes);

    $title = $attributes->get('title', 'None');
    $alternative = $attributes->get('alternative', false);

    $attributes = $attributes->merge([
        'class' => 'custom-control-input'
    ])
    ->except(['title', 'alternative'])
    ->all();
@endphp
<div class="custom-control custom-checkbox{{ $alternative ? ' custom-control-alternative' : '' }}">
    {!! Form::checkbox($name, true, $value, $attributes) !!}

    @isset($title)
        {!! Form::label($name, $title, ['class' => 'custom-control-label'], true) !!}
    @endisset
</div>

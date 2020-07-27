@php
    use Illuminate\Support\Collection;
    use Illuminate\Support\ViewErrorBag;

    /** @var $name */
    /** @var $value */
    /** @var $checked */
    /** @var ViewErrorBag $errors */
    /** @var Collection $attributes */
    $attributes = collect($attributes);

    $title = $attributes->get('title');
    $alternative = $attributes->get('alternative', false);
    $id = $attributes->get('id', $name);

    $attributes = $attributes->merge([
        'class' => 'custom-control-input',
    ])
    ->except(['title', 'alternative'])
    ->all()
@endphp
<div class="custom-control custom-checkbox{{ $alternative ? ' custom-control-alternative' : '' }}">
    {!! Form::checkbox($name, $value, $checked, $attributes) !!}
    {!! Form::label($id, $title, ['class' => 'custom-control-label'], true) !!}
</div>

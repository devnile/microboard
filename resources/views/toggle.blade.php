@php
    use Illuminate\Support\Collection;
    use Illuminate\Support\ViewErrorBag;

    /** @var $name */
    /** @var $value */
    /** @var $checked */
    /** @var Collection $attributes */
    $attributes = collect($attributes);
    $id = $attributes->get('id', $name);
@endphp

@component('microboard::layouts.partials.base-input', compact('name', 'attributes'))
    <label for="{{ $id }}" class="custom-toggle mx-auto">
        {!! Form::checkbox(
            $name,
            $value,
            $checked,
            $attributes
                ->except(['title', 'hideLabel', 'errorBag', 'errorName', 'formClass'])
                ->merge(['id' => $id])
                ->all()
        ) !!}
        <span class="custom-toggle-slider rounded-circle"></span>
    </label>
@endcomponent

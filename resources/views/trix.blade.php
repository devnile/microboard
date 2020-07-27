@php
    use Illuminate\Support\Collection;
    use Illuminate\Support\ViewErrorBag;

    /** @var $name */
    /** @var $value */
    /** @var ViewErrorBag $errors */
    /** @var Collection $attributes */
    $attributes = collect($attributes);

    $id = $attributes->get('id', $name);
    $collection = $attributes->get('collection');

    if ($bag = $attributes->get('errorBag', false)) {
        $errors = $errors->{$bag};
    }
    $errorName = $attributes->get('errorName', $id);

    $class = $errors->has($errorName) ? ' is-invalid' : ''
@endphp

@component('microboard::layouts.partials.base-input', compact('name', 'attributes'))
    <input type="hidden" name="{{ $name }}" id="{{ $id }}" value="{{ $value }}"/>
    <trix-editor {!! Html::attributes($attributes->merge([
        'class' => $class,
        'placeholder' => $attributes->get('title'),
        'input' => $id,
        'data-store-url' => route('microboard.media.save'),
        'data-delete-url' => route('microboard.media.destroy'),
    ])
    ->except(['title', 'hideLabel', 'alternative', 'icon', 'errorBag', 'errorName', 'hideHelpIcon', 'formClass'])
    ->all()) !!}></trix-editor>
@endcomponent

@push('styles')
    <link rel="stylesheet" href="{{ asset('vendor/microboard/vendor/trix/trix.css') }}">
@endpush

@push('scripts')
    <script src="{{ asset('vendor/microboard/vendor/trix/trix.js') }}"></script>
@endpush

@php
    /** @var $name */
    /** @var $list */
    /** @var $value */
    /** @var \Illuminate\Support\ViewErrorBag $errors */
    /** @var \Illuminate\Support\Collection $attributes */
    $attributes = collect($attributes);
@endphp
@component('microboard::layout.partials.base-input', compact('name', 'attributes'))
    {!! Form::select($name, $list, $value, $attributes->merge([
        'class' => 'form-control' . ($errors->has($name) ? ' is-invalid' : ''),
        'data-toggle' => 'select',
        'title' => 'Simple select',
        'data-live-search' => 'true',
        'data-live-search-placeholder' => 'Search ...'
    ])
    ->except(['title', 'hideLabel', 'alternative', 'icon'])
    ->all()) !!}
@endcomponent
@push('styles')
    <link rel="stylesheet" href="{{ asset('vendor/microboard/vendor/select2/css/select2.min.css') }}">
@endpush
@push('scripts')
    <script src="{{ asset('vendor/microboard/vendor/select2/js/select2.min.js') }}"></script>
@endpush

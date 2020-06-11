@php
    /** @var $name */
    /** @var $list */
    /** @var $value */
    /** @var \Illuminate\Support\ViewErrorBag $errors */
    /** @var \Illuminate\Support\Collection $attributes */
    $attributes = collect($attributes);
    if ($bag = $attributes->get('errorBag', false)) {
        $errors = $errors->{$bag};
    }
    $errorName = $attributes->get('errorName', $name);
    $class = 'form-control' . ($errors->has($errorName) ? ' is-invalid' : '') . ($attributes->get('alternative', false) ? ' form-control-alternative' : '');
@endphp
@component('microboard::layout.partials.base-input', compact('name', 'attributes'))
    {!! Form::select($name, $list, $value, $attributes->merge([
        'class' => $class,
        'data-toggle' => 'select',
        'data-live-search' => true
    ])
    ->except(['title', 'hideLabel', 'alternative', 'icon', 'errorBag', 'errorName', 'hideHelpIcon', 'formClass'])
    ->all()) !!}
@endcomponent
@push('styles')
    <link rel="stylesheet" href="{{ asset('vendor/microboard/vendor/select2/css/select2.min.css') }}">
@endpush
@push('scripts')
    <script src="{{ asset('vendor/microboard/vendor/select2/js/select2.min.js') }}"></script>
@endpush

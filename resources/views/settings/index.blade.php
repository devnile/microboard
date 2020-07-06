@extends('microboard::layouts.app', [
    'breadcrumbs' => [
        ['name' => trans('microboard::settings.resource')]
    ]
])

@section('title', trans('microboard::settings.resource'))

@section('content')
    @component('microboard::settings.table', [
        'groups' => $groups
    ])@endcomponent

    <div class="mt-6"></div>

    @can('create', new \Microboard\Models\Setting)
        @component('microboard::settings.form')@endcomponent
    @endcan
@endsection

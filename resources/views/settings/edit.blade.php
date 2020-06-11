@extends ('microboard::layout.app', [
    'breadcrumbs' => [
        ['name' => trans('microboard::settings.resource'), 'url' => route('microboard.settings.index')],
        ['name' => trans('microboard::settings.view.title', ['name' => $setting->name]), 'url' => route('microboard.settings.show', $setting)],
        ['name' => trans('microboard::settings.edit.title')]
    ]
])

@section('title', trans('microboard::settings.edit.title'))

@section('actions')
    <a href="{{ route('microboard.settings.index') }}" class="btn btn-neutral px-3">
        @lang('microboard::settings.edit.cancel')
    </a>

    <button class="btn px-5 btn-default action-submit" data-form="#edit-setting-form">
        @lang('microboard::settings.edit.save')
    </button>
@endsection

@section('content')
    {!! Form::open([
        'route' => ['microboard.settings.update', $setting],
        'method' => 'PATCH',
        'files' => true,
        'id' => 'edit-setting-form'
    ]) !!}
    @component('microboard::settings.form', [
        'setting' => $setting
    ])@endcomponent
    {!! Form::close() !!}
@endsection

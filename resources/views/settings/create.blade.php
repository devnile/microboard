@extends ('microboard::layout.app', [
    'breadcrumbs' => [
        ['name' => trans('microboard::settings.resource'), 'url' => route('microboard.settings.index')],
        ['name' => trans('microboard::settings.create.title')]
    ]
])

@section('title', trans('microboard::settings.create.title'))

@section('actions')
    <a href="{{ route('microboard.settings.index') }}" class="btn btn-neutral px-3">
        @lang('microboard::settings.create.cancel')
    </a>

    <button class="btn px-5 btn-default action-submit" data-form="#create-setting-form">
        @lang('microboard::settings.create.save')
    </button>
@endsection

@section('content')
    {!! Form::open([
        'route' => ['microboard.settings.store'],
        'method' => 'POST',
        'files' => true,
        'id' => 'create-setting-form'
    ]) !!}
    @component('microboard::settings.form', [
        'setting' => new Microboard\Models\Setting
    ])@endcomponent
    {!! Form::close() !!}
@endsection

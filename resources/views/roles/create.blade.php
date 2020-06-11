@extends ('microboard::layout.app', [
    'breadcrumbs' => [
        ['name' => trans('microboard::roles.resource'), 'url' => route('microboard.roles.index')],
        ['name' => trans('microboard::roles.create.title')]
    ]
])

@section('title', trans('microboard::roles.create.title'))

@section('actions')
    <a href="{{ route('microboard.roles.index') }}" class="btn btn-sm btn-neutral px-3">
        @lang('microboard::roles.create.cancel')
    </a>

    <button class="btn btn-sm px-5 btn-default action-submit" data-form="#create-role-form">
        @lang('microboard::roles.create.save')
    </button>
@endsection

@section('content')
    {!! Form::open([
        'route' => ['microboard.roles.store'],
        'method' => 'POST',
        'files' => true,
        'id' => 'create-role-form'
    ]) !!}
    @component('microboard::roles.form', [
        'role' => new Microboard\Models\Role
    ])@endcomponent
    {!! Form::close() !!}
@endsection

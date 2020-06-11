@extends ('microboard::layout.app', [
    'breadcrumbs' => [
        ['name' => trans('microboard::roles.resource'), 'url' => route('microboard.roles.index')],
        ['name' => trans('microboard::roles.view.title', ['name' => $role->name]), 'url' => route('microboard.roles.show', $role)],
        ['name' => trans('microboard::roles.edit.title')]
    ]
])

@section('title', trans('microboard::roles.edit.title'))

@section('actions')
    <a href="{{ route('microboard.roles.index') }}" class="btn  btn-neutral px-3">
        @lang('microboard::roles.edit.cancel')
    </a>

    <button class="btn  px-5 btn-default action-submit" data-form="#edit-role-form">
        @lang('microboard::roles.edit.save')
    </button>
@endsection

@section('content')
    {!! Form::open([
        'route' => ['microboard.roles.update', $role],
        'method' => 'PATCH',
        'files' => true,
        'id' => 'edit-role-form'
    ]) !!}
    @component('microboard::roles.form', [
        'role' => $role
    ])@endcomponent
    {!! Form::close() !!}
@endsection

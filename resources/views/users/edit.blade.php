@extends ('microboard::layout.app', [
    'breadcrumbs' => [
        ['name' => trans('microboard::users.resource'), 'url' => route('microboard.users.index')],
        ['name' => trans('microboard::users.view.title', ['name' => $user->name]), 'url' => route('microboard.users.show', $user)],
        ['name' => trans('microboard::users.edit.title')]
    ]
])

@section('title', trans('microboard::users.edit.title'))

@section('actions')
    <a href="{{ route('microboard.users.index') }}" class="btn  btn-neutral px-3">
        @lang('microboard::users.edit.cancel')
    </a>

    <button class="btn  px-5 btn-default action-submit" data-form="#edit-user-form">
        @lang('microboard::users.edit.save')
    </button>
@endsection

@section('content')
    {!! Form::open([
        'route' => ['microboard.users.update', $user],
        'method' => 'PATCH',
        'files' => true,
        'id' => 'edit-user-form'
    ]) !!}
    @component('microboard::users.form', [
        'user' => $user
    ])@endcomponent
    {!! Form::close() !!}
@endsection

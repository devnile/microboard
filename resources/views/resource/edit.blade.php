@extends ('microboard::layout.app', [
    'breadcrumbs' => [
        ['name' => trans('microboard::users.resource'), 'url' => route('microboard.users.index')],
        ['name' => trans('microboard::users.view.title', ['name' => $user->name]), 'url' => route('microboard.users.show', $user)],
        ['name' => trans('microboard::users.edit.title')]
    ]
])

@section('title', trans('microboard::users.edit.title'))

@section('actions')
    <a href="{{ route('microboard.users.index') }}" class="btn btn-sm btn-neutral px-3">
        @lang('microboard::users.edit.cancel')
    </a>

    <button class="btn btn-sm px-5 btn-default action-submit" data-form="#edit-user-form">
        @lang('microboard::users.edit.save')
    </button>
@endsection

@section('content')
    <div class="row">
        <div class="col">
            <div class="card">
                <div class="card-body mb--4">
                    {!! Form::open([
                        'route' => ['microboard.users.update', $user],
                        'method' => 'PATCH',
                        'files' => true,
                        'id' => 'edit-user-form'
                    ]) !!}
                    @component('microboard::resource.form', [
                        'user' => $user
                    ])@endcomponent
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
@endsection

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
            <form
                    id="edit-user-form"
                    action="{{ route('microboard.users.update', $user) }}"
                    method="POST"
                    enctype="multipart/form-data"
            >
                @csrf
                @method('PATCH')
            </form>
        </div>
    </div>
@endsection

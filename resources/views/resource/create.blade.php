@extends ('microboard::layout.app', [
    'breadcrumbs' => [
        ['name' => trans('microboard::users.resource'), 'url' => route('microboard.users.index')],
        ['name' => trans('microboard::users.create.title')]
    ]
])

@section('title', trans('microboard::users.create.title'))

@section('actions')
    <a href="{{ route('microboard.users.index') }}" class="btn btn-sm btn-neutral px-3">
        @lang('microboard::users.create.cancel')
    </a>

    <button class="btn btn-sm px-5 btn-default action-submit" data-form="#create-user-form">
        @lang('microboard::users.create.save')
    </button>
@endsection

@section('content')
    <div class="row">
        <div class="col">
            <div class="card">
                <div class="card-body mb--4">
                    {!! Form::open([
                        'route' => ['microboard.users.store'],
                        'method' => 'POST',
                        'files' => true,
                        'id' => 'create-user-form'
                    ]) !!}
                    @component('microboard::resource.form', [
                        'user' => new \App\User
                    ])@endcomponent
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
@endsection

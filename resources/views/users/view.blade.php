@extends ('microboard::layout.app', [
    'breadcrumbs' => [
        ['name' => trans('microboard::users.resource'), 'url' => route('microboard.users.index')],
        ['name' => trans('microboard::users.view.title', ['name' => $user->name])]
    ]
])

@section('title', trans('microboard::users.view.title', ['name' => $user->name]))

@section('actions')
    @can('update', $user)
        <a href="{{ route('microboard.users.edit', $user) }}" class="btn btn-sm btn-neutral px-4">
            @lang('microboard::users.edit.action-button')
        </a>
    @endcan

    @can('delete', $user)
        <form action="{{ route('microboard.users.destroy', $user) }}" method="POST" class="d-inline-block">
            @csrf
            @method('DELETE')

            <button type="submit" class="btn btn-sm btn-danger action-delete"
                    data-toggle="tooltip"
                    data-placement="right"
                    data-original-title="{{ trans('microboard::users.delete.action-button') }}"
                    data-modal-title="{{ trans('microboard::users.delete.title') }}"
                    data-modal-text="{{ trans('microboard::users.delete.text') }}"
                    data-confirm="{{ trans('microboard::users.delete.confirm') }}"
                    data-cancel="{{ trans('microboard::users.delete.cancel') }}"
            >
                <i class="fas fa-trash"></i>
            </button>
        </form>
    @endcan
@endsection

@section('content')
    <div class="row">
        <div class="col-sm-8">
            <div class="card">
                <div class="table-responsive">
                    <table class="table table-flush">
                        <tbody>
                        <tr>
                            <th style="width: 25%;">@lang('microboard::users.fields.name')</th>
                            <td>{{ $user->name }}</td>
                        </tr>
                        <tr>
                            <th style="width: 25%;">@lang('microboard::users.fields.email')</th>
                            <td>{{ $user->email }}</td>
                        </tr>
                        <tr>
                            <th style="width: 25%;">@lang('microboard::users.fields.role_id')</th>
                            @can('view', $user->role)
                                <td>
                                    <a href="{{ route('microboard.roles.show', $user->role) }}">
                                        {{ $user->role->display_name }}
                                    </a>
                                </td>
                            @else
                                <td>{{ $user->role->display_name }}</td>
                            @endcan
                        </tr>
                        <tr>
                            <th style="width: 25%;">@lang('microboard::users.fields.created_at')</th>
                            <td>
                                <time datetime="{{ $user->created_at }}">{{ $user->created_at->format('d/m/Y') }}</time>
                            </td>
                        </tr>
                        <tr>
                            <th style="width: 25%;">@lang('microboard::users.fields.updated_at')</th>
                            <td>
                                <time datetime="{{ $user->updated_at }}">{{ $user->updated_at->diffForHumans() }}</time>
                            </td>
                        </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <div class="col-sm-4">
            @php
                $files = [
                    ['name' => 'test', 'size' => '1024', 'type' => 'image/jpg', 'url' => asset('storage/user-placeholder.png')]
                ];
            @endphp
            <div class="card">
                @can('update', $user)
                    {!! Form::avatar($files, [
                        'title' => trans('microboard::users.fields.select_avatar'),
                        'default' => asset('storage/user-placeholder.png')
                    ]) !!}
                @else
                    <div class="dropzone dropzone-single dz-clickable dz-max-files-reached">
                        <div class="dz-preview dz-preview-single">
                            <div class="dz-preview-cover dz-complete dz-image-preview">
                                <img class="dz-preview-img" src="{{ $files[0]['url'] }}">
                            </div>
                        </div>
                        <div style="padding: 7rem 1rem;"></div>
                    </div>
                @endcan
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="mb-0">@lang('microboard::users.fields.role_id')</h3>
                </div>

                @include('microboard::roles.permissions_table', ['role' => $user->role])
            </div>
        </div>
    </div>
@endsection


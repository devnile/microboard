@extends ('microboard::layout.app', [
    'breadcrumbs' => [
        ['name' => trans('microboard::roles.resource'), 'url' => route('microboard.roles.index')],
        ['name' => trans('microboard::roles.view.title', ['name' => $role->name])]
    ]
])

@section('title', trans('microboard::roles.view.title', ['name' => $role->name]))

@section('actions')
    @can('update', $role)
        <a href="{{ route('microboard.roles.edit', $role) }}" class="btn  btn-neutral px-4">
            @lang('microboard::roles.edit.action-button')
        </a>
    @endcan

    @can('delete', $role)
        <form action="{{ route('microboard.roles.destroy', $role) }}" method="POST" class="d-inline-block">
            @csrf
            @method('DELETE')

            <button type="submit" class="btn  btn-danger action-delete"
                    data-toggle="tooltip"
                    data-placement="right"
                    data-original-title="{{ trans('microboard::roles.delete.action-button') }}"
                    data-modal-title="{{ trans('microboard::roles.delete.title') }}"
                    data-modal-text="{{ trans('microboard::roles.delete.text') }}"
                    data-confirm="{{ trans('microboard::roles.delete.confirm') }}"
                    data-cancel="{{ trans('microboard::roles.delete.cancel') }}"
            >
                <i class="fas fa-trash"></i>
            </button>
        </form>
    @endcan
@endsection

@section('content')
    <div class="row">
        <div class="col">
            <div class="card">
                <div class="table-responsive">
                    <table class="table table-flush">
                        <tbody>
                        <tr>
                            <th style="width: 25%">@lang('microboard::roles.fields.display_name')</th>
                            <td>{{ $role->display_name }}</td>
                        </tr>
                        <tr>
                            <th style="width: 25%">@lang('microboard::roles.fields.name')</th>
                            <td>{{ $role->name }}</td>
                        </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col">
            <div class="card">
                @include('microboard::roles.permissions_table', ['role' => $role])
            </div>
        </div>
    </div>
@endsection

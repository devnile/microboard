@extends ('microboard::layout.app', [
    'breadcrumbs' => [
        ['name' => trans('microboard::users.resource'), 'url' => route('microboard.users.index')],
        ['name' => trans('microboard::users.view.title', ['name' => $user->name])]
    ]
])

@section('title', trans('microboard::users.view.title', ['name' => $user->name]))

@section('actions')
    @if(true)
        <a href="{{ route('microboard.users.edit', $user) }}" class="btn btn-sm btn-neutral px-4">
            @lang('microboard::users.edit.action-button')
        </a>
    @endif

    @if(true)
        <form action="#" method="POST" class="d-inline-block">
            @csrf
            @method('DELETE')

            <button type="submit" class="btn btn-sm btn-danger"
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
    @endif
@endsection

@section('content')
    <div class="row">
        <div class="col">
            <div class="card">
                <table class="table table-flush">
                    <tbody>
                    <tr>
                        <th width="25%">@lang('microboard::users.fields.name')</th>
                        <td>{{ $user->name }}</td>
                    </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection

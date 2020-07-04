@extends ('microboard::layouts.app', [
    'breadcrumbs' => [
        ['name' => trans("{$translationsPrefix}.resource"), 'url' => route("{$routePrefix}.index")],
        ['name' => trans("{$translationsPrefix}.view.title", ['name' => $model->name])]
    ]
])

@section('title', trans("{$translationsPrefix}.view.title", ['name' => $model->name]))

@section('actions')
    @can('update', $model)
        <a href="{{ route("{$routePrefix}.edit", $model) }}" class="btn btn-neutral px-4">
            @lang("{$translationsPrefix}.edit.action-button")
        </a>
    @endcan

    @can('delete', $model)
        <form action="{{ route("{$routePrefix}.destroy", $model) }}" method="POST" class="d-inline-block">
            @csrf
            @method('DELETE')

            <button type="submit" class="btn btn-danger action-delete"
                    data-toggle="tooltip"
                    data-placement="right"
                    data-original-title="{{ trans("{$translationsPrefix}.delete.action-button") }}"
                    data-modal-title="{{ trans("{$translationsPrefix}.delete.title") }}"
                    data-modal-text="{{ trans("{$translationsPrefix}.delete.text") }}"
                    data-confirm="{{ trans("{$translationsPrefix}.delete.confirm") }}"
                    data-cancel="{{ trans("{$translationsPrefix}.delete.cancel") }}"
            >
                <i class="fas fa-trash"></i>
            </button>
        </form>
    @endcan
@endsection

@section('content')
    @component(
        "{$viewsPrefix}.table",
        ["${resourceVariable}" => $model]
    )@endcomponent
@endsection

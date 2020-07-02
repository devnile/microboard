@extends ('microboard::layouts.app', [
    'breadcrumbs' => [
        ['name' => trans("{$translationsPrefix}{$resourceName}.resource"), 'url' => route("{$routePrefix}{$resourceName}.index")],
        ['name' => trans("{$translationsPrefix}{$resourceName}.view.title", ['name' => $model->name])]
    ]
])

@section('title', trans("{$translationsPrefix}{$resourceName}.view.title", ['name' => $model->name]))

@section('actions')
    @can('update', $model)
        <a href="{{ route("{$routePrefix}{$resourceName}.edit", $model) }}" class="btn btn-neutral px-4">
            @lang("{$translationsPrefix}{$resourceName}.edit.action-button")
        </a>
    @endcan

    @can('delete', $model)
        <form action="{{ route("{$routePrefix}{$resourceName}.destroy", $model) }}" method="POST" class="d-inline-block">
            @csrf
            @method('DELETE')

            <button type="submit" class="btn btn-danger action-delete"
                    data-toggle="tooltip"
                    data-placement="right"
                    data-original-title="{{ trans("{$translationsPrefix}{$resourceName}.delete.action-button") }}"
                    data-modal-title="{{ trans("{$translationsPrefix}{$resourceName}.delete.title") }}"
                    data-modal-text="{{ trans("{$translationsPrefix}{$resourceName}.delete.text") }}"
                    data-confirm="{{ trans("{$translationsPrefix}{$resourceName}.delete.confirm") }}"
                    data-cancel="{{ trans("{$translationsPrefix}{$resourceName}.delete.cancel") }}"
            >
                <i class="fas fa-trash"></i>
            </button>
        </form>
    @endcan
@endsection

@section('content')
    @component(
        "{$translationsPrefix}{$resourceName}.table",
        ["${resourceVariable}" => $model]
    )@endcomponent
@endsection

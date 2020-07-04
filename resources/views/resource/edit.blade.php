@extends ('microboard::layouts.app', [
    'breadcrumbs' => [
        ['name' => trans("{$translationsPrefix}.resource"), 'url' => route("{$routePrefix}.index")],
        ['name' => trans("{$translationsPrefix}.view.title", ['name' => $model->name]), 'url' => route("{$routePrefix}.show", $model)],
        ['name' => trans("{$translationsPrefix}.edit.title")]
    ]
])

@section('title', trans("{$translationsPrefix}.edit.title"))

@section('actions')
    <a href="{{ route("{$routePrefix}.index") }}" class="btn btn-neutral px-3">
        @lang("{$translationsPrefix}.edit.cancel")
    </a>

    <button class="btn px-5 btn-default action-submit" data-form="#{{ $resourceName }}-form">
        @lang("{$translationsPrefix}.edit.save")
    </button>
@endsection

@section('content')
    {!! Form::open([
        'route' => ["{$routePrefix}.update", $model],
        'method' => 'PATCH',
        'files' => true,
        'id' => "{$resourceName}-form"
    ]) !!}
    @component("{$viewsPrefix}.form", [
        "${resourceVariable}" => $model
    ])@endcomponent
    {!! Form::close() !!}
@endsection

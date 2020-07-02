@extends ('microboard::layouts.app', [
    'breadcrumbs' => [
        ['name' => trans("{$translationsPrefix}{$resourceName}.resource"), 'url' => route("{$routePrefix}{$resourceName}.index")],
        ['name' => trans("{$translationsPrefix}{$resourceName}.view.title", ['name' => $model->name]), 'url' => route("{$routePrefix}{$resourceName}.show", $model)],
        ['name' => trans("{$translationsPrefix}{$resourceName}.edit.title")]
    ]
])

@section('title', trans("{$translationsPrefix}{$resourceName}.edit.title"))

@section('actions')
    <a href="{{ route("{$routePrefix}{$resourceName}.index") }}" class="btn btn-neutral px-3">
        @lang("{$translationsPrefix}{$resourceName}.edit.cancel")
    </a>

    <button class="btn px-5 btn-default action-submit" data-form="#{{ $resourceName }}-form">
        @lang("{$translationsPrefix}{$resourceName}.edit.save")
    </button>
@endsection

@section('content')
    {!! Form::open([
        'route' => ["{$routePrefix}{$resourceName}.update", $model],
        'method' => 'PATCH',
        'files' => true,
        'id' => "{$resourceName}-form"
    ]) !!}
    @component("{$translationsPrefix}{$resourceName}.form", [
        "${resourceVariable}" => $model
    ])@endcomponent
    {!! Form::close() !!}
@endsection

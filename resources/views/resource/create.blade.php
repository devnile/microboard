@extends ('microboard::layouts.app', [
    'breadcrumbs' => [
        ['name' => trans("{$translationsPrefix}{$resourceName}.resource"), 'url' => route("{$routePrefix}{$resourceName}.index")],
        ['name' => trans("{$translationsPrefix}{$resourceName}.create.title")]
    ]
])

@section('title', trans("{$translationsPrefix}{$resourceName}.create.title"))

@section('actions')
    <a href="{{ route("{$routePrefix}{$resourceName}.index") }}" class="btn btn-neutral px-3">
        @lang("{$translationsPrefix}{$resourceName}.create.cancel")
    </a>

    <button class="btn px-5 btn-default action-submit" data-form="#{{ $resourceName }}-form">
        @lang("{$translationsPrefix}{$resourceName}.create.save")
    </button>
@endsection

@section('content')
    {!! Form::open([
        'route' => ["{$routePrefix}{$resourceName}.store"],
        'method' => 'POST',
        'files' => true,
        'id' => "{$resourceName}-form"
    ]) !!}
    @component("{$translationsPrefix}{$resourceName}.form", [
        "${resourceVariable}" => new $resource
    ])@endcomponent
    {!! Form::close() !!}
@endsection

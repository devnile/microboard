@extends ('microboard::layouts.app', [
    'breadcrumbs' => [
        ['name' => trans("{$translationsPrefix}.resource"), 'url' => route("{$routePrefix}.index")],
        ['name' => trans("{$translationsPrefix}.create.title")]
    ]
])

@section('title', trans("{$translationsPrefix}.create.title"))

@section('actions')
    <a href="{{ route("{$routePrefix}.index") }}" class="btn btn-neutral px-3">
        @lang("{$translationsPrefix}.create.cancel")
    </a>

    <button class="btn px-5 btn-default action-submit" data-form="#{{ $resourceName }}-form">
        @lang("{$translationsPrefix}.create.save")
    </button>
@endsection

@section('content')
    {!! Form::open([
        'route' => ["{$routePrefix}.store"],
        'method' => 'POST',
        'files' => true,
        'id' => "{$resourceName}-form"
    ]) !!}
    @component("{$viewsPrefix}.form", [
        "${resourceVariable}" => new $resource
    ])@endcomponent
    {!! Form::close() !!}
@endsection

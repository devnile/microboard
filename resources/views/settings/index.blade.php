@extends('microboard::layout.app', [
    'breadcrumbs' => [
        ['name' => trans('microboard::settings.resource')]
    ]
])

@section('title', trans('microboard::settings.resource'))

@section('content')
    <div class="row">
        <div class="col">
            <div class="card bg-secondary">
                {!! Form::open([
                       'route' => 'microboard.settings.update',
                       'id' => 'update-settings',
                       'method' => 'PATCH'
                   ]) !!}
                <div class="card-body mb--4">
                    @foreach(\Microboard\Models\Setting::all() as $field)
                        {!! Form::argonInput("value[{$field->id}]", $field->cast, $field->value, [
                            'title' => $field->name,
                            'errorBag' => 'update',
                            'errorName' => "value.{$field->id}"
                        ]) !!}
                    @endforeach
                </div>

                <div class="card-footer d-flex justify-content-end bg-white">
                    <button type="reset" class="btn btn-neutral">
                        @lang('microboard::settings.edit.cancel')
                    </button>
                    <button class="btn btn-default action-submit" data-form="#update-settings">
                        @lang('microboard::settings.edit.save')
                    </button>
                </div>
                {!! Form::close() !!}
            </div>
        </div>
    </div>

    @can('create', new \Microboard\Models\Setting)
        <div class="card">
            <div class="card-header">
                <h3 class="mb-0">@lang('microboard::settings.create.title')</h3>
            </div>
            <div class="card-body mb-md--4">
                {!! Form::open([
                    'route' => 'microboard.settings.store',
                    'id' => 'add-new'
                ]) !!}
                <div class="row">
                    <div class="col-12 col-md-4">
                        {!! Form::argonInput('name', 'text', null, [
                            'title' => trans('microboard::settings.fields.name'),
                            'hideLabel' => true
                        ]) !!}
                    </div>
                    <div class="col-12 col-md-3">
                        {!! Form::argonInput('key', 'text', null, [
                            'title' => trans('microboard::settings.fields.key'),
                            'hideLabel' => true,
                            'help' => trans('microboard::settings.fields.key_help')
                        ]) !!}
                    </div>
                    <div class="col-12 col-md-3">
                        {!! Form::argonSelect('cast', trans('microboard::settings.fields.cast'), null, [
                            'hideLabel' => true
                        ]) !!}
                    </div>
                    <div class="col">
                        <button class="btn btn-block btn-outline-default action-submit" data-form="#add-new">
                            @lang('microboard::settings.create.save')
                        </button>
                    </div>
                </div>
                {!! Form::close() !!}
            </div>
        </div>
    @endcan
@endsection

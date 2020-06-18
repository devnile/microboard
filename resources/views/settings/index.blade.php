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
                        @php
                            $parsedType = explode('|', $field->type);
                            $component = $parsedType[0];
                            if (isset($parsedType[1])) {
                                $type = $parsedType[1];
                            }
                        @endphp
                        @if ($component === 'argonInput' && isset($type))
                            {!! Form::argonInput("value[{$field->id}]", $type, $field->value, array_merge([
                                'title' => $field->name,
                                'errorBag' => 'update',
                                'errorName' => "value.{$field->id}"
                            ], $field->extra)) !!}
                        @endif
                        @if ($component === 'argonTextarea')
                            {!! Form::argonTextarea("value[{$field->id}]", $field->value, array_merge([
                                'title' => $field->name,
                                'errorBag' => 'update',
                                'errorName' => "value.{$field->id}"
                            ], $field->extra)) !!}
                        @endif
                        @if ($component === 'argonSelect' && isset($field->extra['list']))
                            {!! Form::argonSelect("value[{$field->id}]", $field->extra['list'], array_merge([
                                'title' => $field->name,
                                'errorBag' => 'update',
                                'errorName' => "value.{$field->id}"
                            ], $field->extra)) !!}
                        @endif
                        @if (in_array($component, ['avatar', 'files']))
                            <div class="form-group form-row">
                                {!! Form::label($field->id, $field->name, ['class' => 'control-label col-sm-3'], true) !!}

                                <div class="col-sm-9">
                                    <div class="bg-white">
                                        {!! Form::$component($field->getMedia(), array_merge([
                                            'title' => $field->name,
                                            'data-name' => "value[{$field->id}]"
                                        ], $field->extra)) !!}
                                    </div>
                                </div>
                            </div>
                        @endif
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
            {!! Form::open([
                    'route' => 'microboard.settings.store',
                    'id' => 'add-new'
                ]) !!}

            <div class="card-body mb-md--4">
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
                        {!! Form::argonSelect('cast[type]', trans('microboard::settings.fields.types'), null, [
                            'hideLabel' => true,
                            'id' => 'type',
                            'errorName' => 'cast.type'
                        ]) !!}
                    </div>
                    <div class="col">
                        <button class="btn btn-block btn-outline-default action-submit" data-form="#add-new">
                            @lang('microboard::settings.create.save')
                        </button>
                    </div>
                </div>
            </div>

            <div class="card-footer py-2">
                <a
                        class="btn btn-sm btn-block btn-link shadow-none"
                        aria-controls="castTheField"
                        href="#castTheField"
                        data-toggle="collapse"
                        aria-expanded="false"
                        role="button"
                >
                    المزيد من الخيارات
                    <i class="fa fa-fw fa-arrow-down"></i>
                </a>

                <div class="collapse" id="castTheField">
                    <div class="pt-3 position-relative" style="height: 250px;">
                        <div id="editor"></div>
                        {!! Form::argonTextarea('cast[extra]', "{}", [
                            'title' => trans('microboard::settings.fields.extra'),
                            'hideLabel' => true,
                            'id' => 'editor-json',
                            'errorName' => 'cast.extra'
                        ]) !!}
                    </div>
                </div>
            </div>
            {!! Form::close() !!}
        </div>
    @endcan
@endsection

@push('styles')
    <style>
        #editor {
            margin: 0;
            position: absolute;
            top: 0;
            bottom: 0;
            left: 0;
            right: 0;
        }
    </style>
@endpush

@push('scripts')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/ace/1.4.11/ace.min.js"
            integrity="sha256-qCCcAHv/Z0u7K344shsZKUF2NR+59ooA3XWRj0LPGIQ=" crossorigin="anonymous"
    ></script>
    <script>
        ace.config.set('basePath', 'https://cdnjs.cloudflare.com/ajax/libs/ace/1.4.11/');

        const editor = ace.edit('editor'),
            json = $('#editor-json').hide();

        editor.getSession().setMode('ace/mode/json');

        editor.getSession().setValue(json.val());
        editor.getSession().on('change', function () {
            json.val(editor.getSession().getValue());
        });
    </script>
@endpush

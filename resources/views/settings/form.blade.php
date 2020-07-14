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
            <div class="col-12 col-lg-4">
                {!! Form::argonInput('title', 'text', null, [
                    'title' => trans('microboard::settings.fields.title'),
                    'hideLabel' => true
                ]) !!}
            </div>
            <div class="col-12 col-lg-4">
                <div class="row">
                    <div class="col-sm-6">
                        {!! Form::argonInput('group', 'text', null, [
                            'title' => trans('microboard::settings.fields.group'),
                            'hideLabel' => true,
                        ]) !!}
                    </div>
                    <div class="col-sm-6">
                        {!! Form::argonInput('key', 'text', null, [
                            'title' => trans('microboard::settings.fields.key'),
                            'hideLabel' => true,
                        ]) !!}
                    </div>
                </div>
            </div>
            <div class="col-12 col-lg-2">
                {!! Form::argonSelect('type', trans('microboard::settings.fields.types'), null, [
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
            @lang('microboard::settings.fields.more')
            <i class="fa fa-fw fa-arrow-down"></i>
        </a>

        <div class="collapse" id="castTheField">
            <div class="pt-3 position-relative" style="height: 250px;">
                <div id="editor"></div>
                {!! Form::argonTextarea('options', "{}", [
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

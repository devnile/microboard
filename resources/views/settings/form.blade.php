<div class="row">
    <div class="col">
        <div class="card">
            <div class="card-body mb--4">
                {!! Form::argonInput('key', 'text', $setting->key, [
                    'title' => trans('microboard::settings.fields.key')
                ]) !!}
                {!! Form::argonInput('value', 'text', $setting->value, [
                    'title' => trans('microboard::settings.fields.value')
                ]) !!}
                {!! Form::argonInput('cast', 'text', $setting->cast, [
                    'title' => trans('microboard::settings.fields.cast')
                ]) !!}
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col">
        <div class="card bg-secondary">
            {!! Form::open([
                'route' => 'microboard.settings.update',
                'id' => 'update-settings',
                'method' => 'PATCH'
            ]) !!}
            <div class="card-body mb--4">
                @foreach($settings as $field)
                    @php
                        /** @var \Microboard\Models\Setting $field */
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
                    @if ($component === 'argonSelect')
                        @php
                            $name = "value[{$field->id}]";
                            $value = $field->value;

                            if (isset($field->extra['multiple'])) {
                                $name .= '[]';
                                $value = json_decode($value, true);
                            }
                        @endphp
                        {!! Form::argonSelect($name, $field->extra['list'] ?? [], $value, array_merge([
                            'title' => $field->name,
                            'errorBag' => 'update',
                            'errorName' => "value.{$field->id}",
                        ], array_filter($field->extra, function($option) {
                            return !is_array($option);
                        }))) !!}
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

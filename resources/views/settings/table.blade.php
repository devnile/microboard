<div class="row">
    <div class="col">
        {!! Form::open([
            'route' => 'microboard.settings.update',
            'id' => 'update-settings',
            'method' => 'PATCH'
        ]) !!}
        @foreach($groups as $settings)
            <div class="card bg-secondary mb-3">
                <div class="card-body mb--4">
                    @foreach($settings as $field)
                        @php
                            /** @var \Microboard\Models\Setting $field */
                            $parsedType = explode('|', $field->type);
                            $component = $parsedType[0];
                            $type = 'text';
                            if (isset($parsedType[1])) {
                                $type = $parsedType[1];
                            }
                            $options = [
                                'title' => $field->title,
                                'errorBag' => 'update',
                                'errorName' => "value.{$field->id}"
                            ];

                            $options = array_merge($options, json_decode($field->options, true));
                        @endphp
                        @if ($component === 'argonInput')
                            {!! Form::argonInput("value[{$field->id}]", $type, $field->value, $options) !!}
                        @endif
                        @if (in_array($component, ['argonTextarea', 'trix']))
                            {!! Form::$component("value[{$field->id}]", $field->value, $options) !!}
                        @endif
                        @if ($component === 'argonSelect')
                            @php
                                $name = "value[{$field->id}]";
                                $value = $field->value;

                                if (isset($options['multiple']) && $options['multiple']) {
                                    $name .= '[]';
                                    $value = json_decode($value, true);
                                }
                            @endphp
                            {!! Form::argonSelect(
                                $name,
                                $options['list'] ?? [],
                                $value,
                                array_filter($options, function($option) {
                                    return !is_array($option);
                                })
                            ) !!}
                        @endif
                        @if (in_array($component, ['avatar', 'files']))
                            @php
                                $options['data-name'] = "value[{$field->id}]"
                            @endphp
                            <div class="form-group form-row">
                                {!! Form::label($field->id, $field->title, ['class' => 'control-label col-sm-3'], true) !!}

                                <div class="col-sm-9">
                                    <div class="bg-white">
                                        {!! Form::$component($field->getMedia(), $options) !!}
                                    </div>
                                </div>
                            </div>
                        @endif
                    @endforeach
                </div>
            </div>
        @endforeach

        <div class="card">
            <div class="card-body d-sm-flex justify-content-end">
                <button type="reset" class="btn btn-neutral">
                    @lang('microboard::settings.edit.cancel')
                </button>
                <button class="btn btn-default action-submit" data-form="#update-settings">
                    @lang('microboard::settings.edit.save')
                </button>
            </div>
        </div>
        {!! Form::close() !!}
    </div>
</div>

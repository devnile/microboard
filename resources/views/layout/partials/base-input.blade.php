@php
    /** @var $name */
    /** @var \Illuminate\Support\ViewErrorBag $errors */
    /** @var \Illuminate\Support\Collection $attributes */
    $attributes = collect($attributes);

    $title = $attributes->get('title', 'None');
    $alternative = $attributes->get('alternative', false);
    $icon = $attributes->get('icon', null);
    $hideLabel = $attributes->get('hideLabel', false);
    $help = $attributes->get('help', null);
@endphp
<div class="form-group{{ $hideLabel ? '' : ' form-row align-items-center' }}{{ $errors->has($name) ? ' has-danger' : '' }}">
    @unless ($hideLabel)
        {!! Form::label($name, $title, ['class' => 'control-label col-sm-3'], true) !!}
    @endunless

    <div class="{{ $hideLabel ? '' : ' col-sm-9' }}">
        @if($icon !== null)
            <div class="input-group{{ $alternative ? ' input-group-alternative' : '' }}">
                <div class="input-group-prepend">
                    <span class="input-group-text"><i class="{{ $icon }}"></i></span>
                </div>
                @endif
                {!! $slot !!}
                @if ($icon !== null)
            </div>
        @endif
        <div class="align-items-center d-lg-flex justify-content-between">
            @if ($help)
                <small class="text-muted"><i class="fa fa-question-circle"></i> {!! $help !!}</small>
            @endif
            @error($name)
            <span role="alert" class="d-block invalid-feedback mt-0 w-auto">{{ $message }}</span>
            @enderror
        </div>
    </div>
</div>

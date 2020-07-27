@php
    use Illuminate\Support\Collection;
    use Illuminate\Support\ViewErrorBag;

    /** @var $name */
    /** @var ViewErrorBag $errors */
    /** @var Collection $attributes */
    $attributes = collect($attributes);

    if ($bag = $attributes->get('errorBag', false)) {
        $errors = $errors->{$bag};
    }
    $errorName = $attributes->get('errorName', $name);

    $title = $attributes->get('title', 'None');
    $id = $attributes->get('id', $name);
    $alternative = $attributes->get('alternative', false);
    $icon = $attributes->get('icon', null);
    $hideLabel = $attributes->get('hideLabel', false);
    $help = $attributes->get('help', null);
    $hideHelpIcon = $attributes->get('hideHelpIcon', false);
    $formClass = 'form-group ' . ($hideLabel ? '' : 'form-row align-items-center ') . ($errors->has($errorName) ? 'has-danger ' : '') . ($attributes->get('formClass'))
@endphp
<div class="{{ $formClass }}">
    @unless ($hideLabel)
        {!! Form::label($id, $title, ['class' => 'control-label col-sm-3'], true) !!}
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
                <small class="text-muted">
                    @unless($hideHelpIcon)
                        <i class="fa fa-question-circle"></i>
                    @endunless
                    {!! $help !!}
                </small>
            @endif
            @if($errors->has($errorName))
                <span role="alert" class="d-block invalid-feedback mt-0 w-auto">{{ $errors->first($errorName) }}</span>
            @endif
        </div>
    </div>
</div>

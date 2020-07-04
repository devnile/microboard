@php
    /** @var array $config */
    /** @var string $title */
    /** @var string $info */
    /** @var string $icon */
    $config = collect($config);

    $cardBG = $config->get('background', false) ?
        'bg-gradient-' . $config->get('background') :
        'bg-gradient-red';
    $textColor = $config->get('text', false) ?
        'text-' . $config->get('text') :
        'text-white';
    $iconColor = $config->get('icon-background', false) ?
        'text-white bg-gradient-' . $config->get('icon-background') :
        'bg-white text-dark';
@endphp

<div class="card card-stats {{ $cardBG }} {{ $textColor }}">
    <!-- Card body -->
    <div class="card-body">
        <div class="row">
            <div class="col">
                <h5 class="card-title text-uppercase mb-0 {{ $textColor }}">{{ $title }}</h5>
                @isset($count)
                    <span class="h2 font-weight-bold mb-0">{{ $count }}</span>
                @endisset
            </div>
            @isset($icon)
                <div class="col-auto">
                    <div class="icon icon-shape {{ $iconColor }} rounded-circle shadow">
                        <i class="{{ $icon }}"></i>
                    </div>
                </div>
            @endisset
        </div>


        <p class="mt-3 mb-0 text-sm">
            @isset($extra)
                <span class="text-success mr-2">
                    {{ $extra }}
                </span>
            @endisset
            <span class="text-nowrap">{{ $info }}</span>
        </p>
    </div>
</div>

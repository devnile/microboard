@php
    /** @var \Spatie\MediaLibrary\MediaCollections\Models\Collections\MediaCollection $value */
    /** @var array $attributes */
    $attributes = array_merge([
        'data-accept' => 'image/*'
    ], $attributes);
@endphp

@component('microboard::layout.partials.base-dropzone', [
    'value' => $value,
    'attributes' => $attributes,
    'multiple' => false
])
    <div class="dz-preview dz-preview-single">
        <div class="dz-preview-cover">
            <img class="dz-preview-img" src="" alt="" data-dz-thumbnail>
        </div>
    </div>
@endcomponent

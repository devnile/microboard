@php
    /** @var \Spatie\MediaLibrary\MediaCollections\Models\Collections\MediaCollection $value */
    /** @var array $attributes */
@endphp

@component('microboard::layout.partials.base-dropzone', [
    'value' => $value,
    'attributes' => $attributes,
    'multiple' => true
])
    <ul class="dz-preview dz-preview-multiple list-group list-group-lg list-group-flush">
        <li class="list-group-item px-0">
            <div class="row align-items-center">
                <div class="col-auto">
                    <div class="avatar">
                        <img class="avatar-img rounded" src="" alt="" data-dz-thumbnail>
                    </div>
                </div>
                <div class="col ml--3">
                    <h4 class="mb-1" data-dz-name></h4>
                    <p class="small text-muted mb-0" data-dz-size></p>
                </div>
                <div class="col-auto">
                    <a href="#" class="btn btn-sm btn-danger" data-dz-remove>
                        <i class="fa fa-fw fa-trash"></i>
                    </a>
                </div>
            </div>
        </li>
    </ul>
@endcomponent

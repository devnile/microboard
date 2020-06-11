@php
    /** @var string $title */
    /** @var array $value array of files */
    /** @var \Illuminate\Support\Collection $attributes */
    $attributes = collect($attributes);

    $accept = $attributes->get('accept', 'image/*');

    $attributes->map(function($value, $attribute) {
        return "{$attribute}=\"{$value}\"";
    })
@endphp

<div class="dropzone dropzone-single"
     data-toggle="dropzone"
     data-dropzone-url="{{ url('/') }}"
     data-accept="{{ $accept }}"
     data-files="{{ json_encode($value) }}"
     data-label="{{ $attributes->get('title') }}"
     {!! $attributes->except(['accept', 'title'])->implode(' ') !!}
>
    <div class="fallback">
        <div class="custom-file">
            <input type="file" class="custom-file-input" id="dropzoneBasicUpload">
            <label class="custom-file-label" for="dropzoneBasicUpload">Choose file</label>
        </div>
    </div>

    <div class="dz-preview dz-preview-single">
        <div class="dz-preview-cover">
            <img class="dz-preview-img" src="" alt="" data-dz-thumbnail>
        </div>
    </div>
</div>

@push('scripts')
    <script src="{{ asset('vendor/microboard/vendor/dropzone/dropzone.min.js') }}"></script>
@endpush

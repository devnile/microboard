@php
    use Spatie\MediaLibrary\MediaCollections\Models\Collections\MediaCollection;
    use Spatie\MediaLibrary\MediaCollections\Models\Media;
    use Illuminate\Support\Collection;

    /** @var MediaCollection $value */
    /** @var Collection $attributes */
    /** @var boolean $multiple */
    $attributes = collect($attributes);

    if ($value instanceof MediaCollection) {
        $value = $value->map(function(Media $file) {
            return [
                'url' => $file->getUrl(),
                'name' => $file->file_name,
                'type' => $file->mime_type,
                'size' => $file->size
            ];
        });
    }

    if ($multiple) {
        $attributes = $attributes->merge([
            'data-dropzone-multiple' => true
        ]);
    }

    $extra = $attributes->except(['title'])->map(function($value, $attribute) {
        return "{$attribute}=\"{$value}\"";
    })->implode(' ');
@endphp

<div class="dropzone dropzone-{{ $multiple ? 'multiple' : 'single' }}"
     data-toggle="dropzone"
     data-dropzone-url="{{ route('microboard.media.store') }}"
     data-delete="{{ route('microboard.media.destroy') }}"
     data-files="{{ json_encode($value) }}"
     data-label="{{ $attributes->get('title') }}"
     {!! $extra !!}
>
    <div class="fallback">
        <div class="custom-file">
            <input type="file" class="custom-file-input" name="file{{ $multiple ? '[]' : '' }}" id="file"{{ $multiple ? ' multiple' : '' }}>
            <label class="custom-file-label" for="file">Choose file</label>
        </div>
    </div>

    {!! $slot !!}
</div>

@push('scripts')
    <script src="{{ asset('vendor/microboard/vendor/dropzone/dropzone.min.js') }}"></script>
@endpush

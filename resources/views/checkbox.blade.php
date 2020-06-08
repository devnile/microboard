<div class="custom-control custom-checkbox{{ isset($alternative) && $alternative ? ' custom-control-alternative' : '' }}">
    <input
            class="custom-control-input"
            name="{{ $name }}"
            id="{{ $id ?? $name }}"
            type="checkbox"
            {{ old('remember', $value ?? false) ? 'checked' : '' }}
    />

    @isset($title)
        <label class="custom-control-label" for="{{ $id ?? $name }}">
            <span class="text-muted">{{ $title }}</span>
        </label>
    @endisset
</div>

<div class="form-group{{ $errors->has($name) ? ' has-danger' : '' }}">
    @isset ($icon)
        <div class="input-group{{ isset($alternative) && $alternative ? ' input-group-alternative' : '' }}">
            <div class="input-group-prepend">
                <span class="input-group-text"><i class="{{ $icon }}"></i></span>
            </div>
    @endisset
            <input
                    type="{{ $type }}"
                    class="form-control{{ $errors->has($name) ? ' is-invalid' : '' }}"
                    placeholder="{{ $title }}"
                    name="{{ $name }}"
                    id="{{ $id ?? $name }}"
                    value="{{ old($name, $value) }}"
                    @if (isset($required) && $required) required @endif
                    @if (isset($autoFocus) && $autoFocus) autofocus @endif
                    @isset($autoCompelete) autocomplete="{{ $autoComplete }}" @endisset
            />
    @isset ($icon)
        </div>
    @endisset

    @error($name)
        <span role="alert" class="invalid-feedback d-block">{{ $message }}</span>
    @enderror
</div>

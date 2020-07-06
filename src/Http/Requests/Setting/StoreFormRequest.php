<?php

namespace Microboard\Http\Requests\Setting;

use Illuminate\Foundation\Http\FormRequest;

class StoreFormRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'group' => ['required', 'string'],
            'key' => ['required', 'string', 'unique:settings'],
            'title' => ['required', 'string'],
            'type' => ['required', 'string'],
            'options' => ['nullable', 'json']
        ];
    }

    /**
     * Get custom attributes for validator errors.
     *
     * @return array
     */
    public function attributes()
    {
        return trans('microboard::settings.fields');
    }
}

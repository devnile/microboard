<?php

namespace Microboard\Http\Requests\Setting;

use Microboard\Models\Setting;
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
        return auth()->user()->can('create', new Setting);
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
			'key' => ['required', 'string', 'unique:settings'],
			'name' => ['required', 'string'],
			'value' => ['nullable', 'string'],
			'cast' => ['required', 'string']
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

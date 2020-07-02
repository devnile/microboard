<?php

namespace Microboard\Http\Requests\Setting;

use Illuminate\Foundation\Http\FormRequest;
use Microboard\Models\Setting;

class UpdateFormRequest extends FormRequest
{
    /**
     * The key to be used for the view error bag.
     *
     * @var string
     */
    protected $errorBag = 'update';

    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return auth()->user()->can('update', new Setting);
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'value' => ['array', 'required'],
            'value.*' => ['nullable']
        ];
    }

    /**
     * Get custom attributes for validator errors.
     *
     * @return array
     */
    public function attributes()
    {
        return array_merge(
            trans('microboard::settings.fields'),
            ['value.*' => trans('microboard::settings.fields.value')]
        );
    }
}

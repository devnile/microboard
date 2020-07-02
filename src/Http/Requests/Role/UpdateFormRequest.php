<?php

namespace Microboard\Http\Requests\Role;

use Illuminate\Foundation\Http\FormRequest;
use Microboard\Models\Role;

class UpdateFormRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        $role = Role::find($this->route('role'));
        return $role && auth()->user()->can('update', $role);
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => ['required', 'string', 'min:3', 'unique:roles,name,' . $this->route('role')],
            'display_name' => ['required', 'string', 'min:3'],
        ];
    }

    /**
     * Get custom attributes for validator errors.
     *
     * @return array
     */
    public function attributes()
    {
        return trans('microboard::roles.fields');
    }
}

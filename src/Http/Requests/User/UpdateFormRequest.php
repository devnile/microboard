<?php

namespace Microboard\Http\Requests\User;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Hash;

class UpdateFormRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        $model = resolve('App\\User');
        $user = $model::find($this->route('user'));
        return $user && auth()->user()->can('update', $user);
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => ['required', 'string'],
            'email' => ['required', 'string', 'unique:users,email,' . $this->route('user')],
            'auth_password' => ['nullable', 'required_with:password', 'string', function ($attribute, $value, $fail) {
                if (!Hash::check($value, auth()->user()->password)) {
                    $fail(trans('auth.failed'));
                }
            }],
            'password' => ['nullable', 'required_with:auth_password', 'string', 'min:8', 'confirmed'],
            'role_id' => ['required', 'string', 'exists:roles,id'],
        ];
    }

    /**
     * Get custom messages for validator errors.
     *
     * @return array
     */
    public function messages()
    {
        return trans('microboard::users.fields');
    }
}

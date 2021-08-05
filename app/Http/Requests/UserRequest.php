<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UserRequest extends FormRequest
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

    public function validationData()
    {
        return $this->get('user') ?: [];
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $user = $this->user();
        $ignoreValidation = Rule::unique('users')->ignore($user->id);

        return [
            'email' => ['sometimes', 'email', $ignoreValidation,],
            'username' => ['sometimes', $ignoreValidation,],
            'password' => ['sometimes', 'min:8'],
            'avatar' => ['sometimes', 'nullable', 'image'],
            'bio' => ['sometimes', 'nullable', 'max:255'],
        ];
    }
}

<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class AuthenticateRegisteredUserRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'email' => 'required|email',
            'password' => 'required|min:2',
        ];
    }

    public function messages(): array
    {
        return [
            'email.required' => 'Please fill in your email.',
            'email.email' => 'Please fill in a valid email',
            'password.required' => 'Please fill in your password',
            'password.min' => 'your password is too short',
        ];
    }
}

<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class StoreRegisteredUserRequest extends FormRequest
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
            'name' => 'required|string|max:255|min:5|unique:users',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:2',
        ];
    }

    public function messages(): array
    {
        return [
            'name.required' => 'Please fill in a name.',
            'name.string' => 'Name must be a string.',
            'name.max' => 'Maximum name length is 255 characters.',
            'name.min' => 'Minimum name length is 5 characters.',
            'name.unique' => 'Name already taken.',
            'email.required' => 'Please fill in your email.',
            'email.email' => 'Please fill in a valid email',
            'email.unique' => 'Email already registered. Try loging in insted.',
            'password.required' => 'Please fill in your password',
            'password.min' => 'your password is too short',
        ];
    }
}

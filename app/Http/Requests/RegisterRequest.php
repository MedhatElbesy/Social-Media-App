<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RegisterRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'email'    => 'required|email|unique:users',
            'username' => 'required|regex:/^\S*$/u',
            'password' => [
                'required',
                'string',
                'min:8',
                'regex:/[a-z]/',
                'regex:/[A-Z]/',
                'regex:/[0-9]/',
                'regex:/[@$!%*#?&]/',
            ],
            'image' => 'nullable|image|mimes:png,jpg|max:1024',
        ];
    }

    public function messages()
    {
        return [
            'email.required'     => 'Email is required',
            'email.email'        => 'Please enter a valid email address',
            'email.unique'       => 'Email already exists',
            'username.required'  => 'Username is required',
            'username.regex'     => 'Username cannot contain spaces',
            'password.required'  => 'Password is required',
            'password.min'       => 'Password must be at least 8 characters',
            'password.regex'     => 'Password must include upper and lowercase letters, a number, and a special character',
            'image.image'        => 'The file must be an image',
            'image.mimes'        => 'Only png and jpg images are allowed',
            'image.max'          => 'Image size must not exceed 1MB',
        ];
    }
}

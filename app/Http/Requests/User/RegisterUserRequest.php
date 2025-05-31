<?php

namespace App\Http\Requests\User;

use Illuminate\Foundation\Http\FormRequest;

class RegisterUserRequest extends FormRequest
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
            'email' => 'required|string',
            'password'=> 'required|string|min:6',
            'first_name'=> 'required|string',
            'last_name'=> 'required|string',
            'phone'=> 'required|string',
            'birth_date'=> 'nullable|date',
            'avatar_url'=> 'nullable|string',
            'role'=> 'nullable|string|in:student,teacher,admin',
        ];
    }
}

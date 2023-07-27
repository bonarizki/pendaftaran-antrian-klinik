<?php

namespace App\Http\Requests\Auth;

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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            "name" => "required|string|min:3",
            "email" => "required|unique:users,email",
            "phone_number" => "required|numeric|digits_between:11,14",
            "password" => "required|string|min:8|max:20",
            "verify_password" => "required|string|min:8|max:20|same:password"
        ];
    }
}

<?php

namespace App\Http\Requests\Api\V1;

use Illuminate\Foundation\Http\FormRequest;

class RegisterRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'telefono' => 'required|string|unique:users,telefono',
            'email' => 'nullable|email|unique:users,email',
            'nombre' => 'required|string|max:255',
            'password' => 'required|string|min:8|confirmed',
        ];
    }
}
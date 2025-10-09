<?php

namespace App\Http\Requests\Api\V1;

use Illuminate\Foundation\Http\FormRequest;

class UpdateEscuchaRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'nombre_asignado' => 'sometimes|required|string|max:255',
            'telefono' => 'sometimes|required|string|max:20',
        ];
    }
}
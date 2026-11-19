<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class PessoaRequest extends FormRequest
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
            'nome' => ['required', 'string', 'max:255'],
            'foto' => ['nullable', 'image', 'max:2048'],
        ];
    }
    public function messages(): array
    {
        return [
            'nome.required' => 'Informe o nome.',
            'nome.max' => 'O nome pode ter no máximo 255 caracteres.',
            'foto.image' => 'O arquivo precisa ser uma imagem (jpg, png, webp...).',
            'foto.max' => 'A foto pode ter no máximo 2 MB.',
        ];
    }
}

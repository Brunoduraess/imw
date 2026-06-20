<?php

namespace App\Http\Requests\Auth;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules;

class ResetPasswordRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'email' => ['required', 'email'],
            'senha' => ['required', 'same:confirmaSenha', Rules\Password::min(8)->mixedCase()->numbers()->symbols()],
            'confirmaSenha' => ['required'],
        ];
    }

    public function messages(): array
    {
        return [
            'email.required' => 'O email é obrigatório',
            'email.email' => 'O email deve ser válido',
            'senha.required' => 'A senha é obrigatória',
            'senha.same' => 'As senhas não coincidem',
            'confirmaSenha.required' => 'A confirmação da senha é obrigatória',
        ];
    }
}

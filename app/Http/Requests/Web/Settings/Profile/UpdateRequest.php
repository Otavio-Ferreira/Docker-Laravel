<?php

namespace App\Http\Requests\Web\Settings\Profile;

use Illuminate\Foundation\Http\FormRequest;

class UpdateRequest extends FormRequest
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
    public function rules()
    {
        return [
            'name' => 'nullable|string|max:255',

            // Senhas
            'actual_password' => 'nullable|string|max:255|required_with:password,password_confirm',
            'password' => 'nullable|string|max:255|required_with:actual_password,password_confirm|same:password_confirm',
            'password_confirm' => 'nullable|string|max:255|required_with:actual_password,password|same:password',

            // Novos campos
            'cpf' => 'nullable|string|size:14|regex:/^\d{3}\.\d{3}\.\d{3}-\d{2}$/',
            'birth' => 'nullable|date|before:today',
            'phone' => 'nullable|string|max:20|regex:/^\(?\d{2}\)?[\s-]?\d{4,5}-?\d{4}$/',
        ];
    }

    public function messages()
    {
        return [
            // Nome
            'name.string' => 'O nome deve ser um texto.',
            'name.max' => 'O nome não pode ter mais de 255 caracteres.',

            // Senha atual
            'actual_password.required_with' => 'A senha atual é obrigatória para alterar a senha.',
            'actual_password.string' => 'A senha atual deve ser um texto.',
            'actual_password.max' => 'A senha atual não pode ter mais de 255 caracteres.',

            // Nova senha
            'password.required_with' => 'A nova senha é obrigatória se for alterar a senha.',
            'password.same' => 'A confirmação da nova senha não corresponde.',
            'password.string' => 'A nova senha deve ser um texto.',
            'password.max' => 'A nova senha não pode ter mais de 255 caracteres.',

            // Confirmação da nova senha
            'password_confirm.required_with' => 'A confirmação da nova senha é obrigatória.',
            'password_confirm.same' => 'A confirmação da nova senha não corresponde.',
            'password_confirm.string' => 'A confirmação da nova senha deve ser um texto.',
            'password_confirm.max' => 'A confirmação da nova senha não pode ter mais de 255 caracteres.',

            // CPF
            'cpf.string' => 'O CPF deve ser um texto.',
            'cpf.size' => 'O CPF deve conter exatamente 14 caracteres (formato 000.000.000-00).',
            'cpf.regex' => 'O formato do CPF é inválido.',

            // Data de nascimento
            'birth.date' => 'A data de nascimento deve ser uma data válida.',
            'birth.before' => 'A data de nascimento deve ser anterior à data atual.',

            // Telefone
            'phone.string' => 'O telefone deve ser um texto.',
            'phone.max' => 'O telefone não pode ter mais de 20 caracteres.',
            'phone.regex' => 'O formato do telefone é inválido. Use o formato (99) 99999-9999.',
        ];
    }
}

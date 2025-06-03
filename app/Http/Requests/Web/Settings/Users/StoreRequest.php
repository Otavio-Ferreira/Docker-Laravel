<?php

namespace App\Http\Requests\Web\Settings\Users;

use Illuminate\Foundation\Http\FormRequest;

class StoreRequest extends FormRequest
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
            'method' => 'required|integer|in:1,0',
            'email' => 'required|string|email|max:255|unique:users',
            'name' => 'required|string|max:255',
            'role' => 'required|string|exists:roles,name',
        ];
    }

    public function messages()
    {
        return [
            "method.required" => "É necessário inserir um método.",
            "method.integer" => "É necessário inserir um valor válido no campo do método.",
            "method.in" => "É necessário inserir um valor válido no campo do método.",

            "email.required" => "É necessário inserir um email.",
            "email.email" => "É necessário inserir um email válido.",
            "email.string" => "É necessário inserir um email válido.",
            "email.max" => "O email deve ter no máximo 255 caracteres.",
            "email.unique" => "O e-mail informado já está cadastrado.",
            
            "name.required" => "É necessário inserir uma nome.",
            "name.string" => "É necessário inserir um nome em texto.",
            "name.max" => "O nome deve ter no máximo 255 caracteres.",

            "role.required" => "É necessário inserir um grupo de permissão.",
            "role.string" => "É necessário inserir um grupo de permissão válido.",
            'role.exists' => 'O grupo selecionada não é válido.',
        ];
    }
}

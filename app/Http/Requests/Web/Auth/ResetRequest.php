<?php

namespace App\Http\Requests\Web\Auth;

use Illuminate\Foundation\Http\FormRequest;

class ResetRequest extends FormRequest
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
            "password" => "required|string|same:password_confirm",
            "password_confirm" => "required|string|same:password"
        ];
    }

    public function messages()
    {
        return [
            "password.required" => "É necessário inserir uma senha.",
            "password.string" => "É necessário inserir uma senha em texto.",
            "password.same" => "As duas senhas precisam ser iguais.",
            "password_confirm.required" => "É necessário inserir uma senha.",
            "password_confirm.string" => "É necessário inserir uma senha em texto.",
            "password_confirm.same" => "As duas senhas precisam ser iguais.",
        ];
    }
}

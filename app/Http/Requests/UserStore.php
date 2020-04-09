<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserStore extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'role_id' => 'required',
            'name' => 'required',
            'email' => 'email'
        ];
    }

    public function messages()
    {
        return [
            'role_id.required' => 'Selecione o Grupo',
            'name.required' => 'Nome Obrigatório',
            'email.required' => 'E-mail Obrigatório'
        ];
    }
}

<?php

namespace App\Http\Requests;

use App\Rules\DataFuturaRule;
use App\Rules\UsuarioExisteRule;
use App\Rules\ValorPositivoRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\DB;

class StoreDespesaRequest extends FormRequest
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
            'descricao' => ['required', 'max:191'],
            'data' => [
                    'required',
                    new DataFuturaRule
                ],
            'valor' => [
                    'required', 
                    new ValorPositivoRule
                ],
            'user_id' => [
                    'required',
                    new UsuarioExisteRule,
                ]
        ];
    }

    /**
     * Get the error messages for the defined validation rules.
     *
     * @return array
     */
    public function messages()
    {
        return [
            'data.required' => 'Data é obrigatório',
            'descricao.required' => 'Descrição é obrigatório',
            'valor.required' => 'Valor é obrigatório',
            'descricao.max' => 'Descrição máxima é de 191 caracteres',
        ];
    }
}

<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreProdutoRequest extends FormRequest
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
    public function rules(): array
    {
        return [
            'nome_produto'   => 'required|string|max:255|unique:produtos,nome_produto',
            'valor_produto'  => 'required|numeric|min:0',
            'marca_produto'  => 'required|exists:marcas,cod_marca',
            'estoque'        => 'required|numeric|min:0',
            'cidade'         => 'required|exists:cidades,cod_cidade',
        ];
    }
}

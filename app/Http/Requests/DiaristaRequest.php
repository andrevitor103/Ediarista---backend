<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Services\ViaCep;
use App\Rules\ValidaCep;

class DiaristaRequest extends FormRequest
{

    public ViaCep $viaCep;

    public function __construct(ViaCep $viaCep)
    {
        $this->viaCep = $viaCep;
    }
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
        
        /**
         * Regras de validações
         * @return void
         */

        $regras = [
            'nome_completo' => ['required', 'max:100'],
            'cpf' => ['required', 'size: 14'],
            'email' => ['required', 'email', 'max:100'],
            'telefone' => ['required', 'size:15'],
            'logradouro' => ['required', 'max:255'],
            'numero' => ['required', 'max:20'],
            'bairro' => ['required', 'max:50'],
            'cidade' => ['required', 'max:50'],
            'estado' => ['required', 'size:2'],
            'cep' => ['required', new ValidaCep($this->viaCep)],
            'foto_usuario' => ['image']
        ];
         
        /**
         * Caso seja um insert deve ser obrigatório a imagem 
         */

        if($this->isMethod('post')){
            $regras['foto_usuario'] = array_merge($regras['foto_usuario'], ['required']);
        }
        return $regras;

    }
}


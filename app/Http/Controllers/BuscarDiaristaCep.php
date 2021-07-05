<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\ViaCep;
use App\Models\Diarista;

class BuscarDiaristaCep extends Controller
{
    public function __invoke(Request $request, ViaCep $viaCep)
    {
        $infoCep = $viaCep->buscar($request->cep);

        if($infoCep === false){
            return response()->json(['erro'=>'Cep inválido'], 400);
        }
        
        return [
            'diaristas' => Diarista::buscaPorCodigoIbge($infoCep['ibge']),
            'quantidade_diaristas' => Diarista::quantidadePorCodigoIbge($infoCep['ibge'])
        ];
        
    }
}


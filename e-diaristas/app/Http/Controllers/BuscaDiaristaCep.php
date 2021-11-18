<?php

namespace App\Http\Controllers;

use App\Models\Diarista;
use App\services\ViaCep;
use Illuminate\Http\Request;

class BuscaDiaristaCep extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request, ViaCep $viaCep)
    {
        $address = $viaCep->buscar($request->cep);

        if(!$address){
            return response()->json(['erro'=>'Cep Inválido'], 400);
        }

       return [ 
          'diaristas'=> Diarista::buscaPorCodigoIbge($address['ibge']),
          'quantidade_diaristas'=> Diarista::quantidadePorCodigoIbge($address['ibge'])
        
        ];
        
    }
}

<?php

namespace App\services;

use Illuminate\Support\Facades\Http;

class ViaCep
{
    public function buscar(string $cep)
    {
        $url = sprintf('https://viacep.com.br/ws/%s/json/', $cep);

        $response = Http::get($url); 
        $dados = $response->json();

        if($response->failed()){
            return false;
        }

        elseif(isset($dados['erro']) && $dados['erro'] === true){
            return false;
        }

       
        return $dados;
    }
}
<?php

namespace App\Http\Controllers;

use App\Http\Requests\DiaristaRequest;
use App\Models\Diarista;
use App\services\ViaCep;
use Illuminate\Http\Request;

class DiaristaController extends Controller
{
    public function __construct(
        protected ViaCep $viaCep
    )
    {
        $this->viaCep = $viaCep;
    }

    public function index()
    {
        $diarista = Diarista::get();
        return view('index',[
            'diaristas' => $diarista
        ]);
    }
    public function create()
    {
        return view('create');
    }

    public function store(DiaristaRequest $request)
    {
        $dados = $request->except('_token');
        $dados['foto_usuario'] = $request->foto_usuario->store('public');

        $dados['cpf'] = str_replace(['.','-'],'', $dados['cpf']);
        $dados['cep'] = str_replace(['.'],'', $dados['cep']);
        $dados['codigo_ibge'] = $this->viaCep->buscar($dados['cep'])['ibge'];

        Diarista::create($dados);

        return redirect()->route('diaristas.index');
    }

    public function edit(int $id)
    {
        $diarista = Diarista::findOrFail($id);

        return view('edit', [
            'diarista' => $diarista
        ]);
    }

    public function update(int $id, DiaristaRequest $request)
    {
        $diarista = Diarista::findOrFail($id);
        $dados = $request->except(['_token', '_method']);

        $dados['cpf'] = str_replace(['.','-'],'', $dados['cpf']);
        $dados['cep'] = str_replace(['.'],'', $dados['cep']);
        $dados['codigo_ibge'] = $this->viaCep->buscar($dados['cep'])['ibge'];
        if($request->hasFile('foto_usuario')){
            $request['foto_usuario'] = $request->foto_usuario->store('public');
        }

        $diarista->update($dados);



        return redirect()->route('diaristas.index');
        
    }

    public function destroy(int $id)
    {
        $diarista = Diarista::findOrFail($id);

        $diarista->delete();

        return redirect()->route('diaristas.index');
    }
}

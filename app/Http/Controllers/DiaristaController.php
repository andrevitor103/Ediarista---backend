<?php

namespace App\Http\Controllers;

use App\Models\Diarista;
use App\Services\ViaCep;
use App\Http\Requests\DiaristaRequest;
use Illuminate\Http\Request;

class DiaristaController extends Controller
{

    protected ViaCep $viaCep;

    public function __construct(
        ViaCep $viaCep
        ){
            $this->viaCep = $viaCep;
    }

    /**
     * Lista as diaristas
     */
    public function index(){
        $diaristas = Diarista::get();
        return view('index', [
            'diaristas' => $diaristas
        ]);
    }

    /*
     * Mostra formulário de cadastro
    */
    public function create(){
         if(View()->exists('create')){
            return view('create');
        }
    }

    /*
        * Salva a diárista no banco
     */

    public function store(DiaristaRequest $request){
        $dados = $request->except('_token');
        $dados['foto_usuario'] = $request->foto_usuario->store('public');

        $dados['cpf'] = str_replace(['.', '-', ], '', $dados['cpf']);
        $dados['cep'] = str_replace(['.', '-', ], '', $dados['cep']);
        $dados['telefone'] = str_replace(['(', ')', ' ', '-' ], '', $dados['telefone']);

        $dados['codigo_ibge'] = $this->viaCep->buscar($dados['cep'])['ibge'];

        Diarista::create($dados);

        return redirect()->route('diarista.index');
    }


    /*
        * Mostra formulário de edição  
    */
    public function edit(int $id){
        $diarista = Diarista::findOrFail($id);
        return view('edit', [
            'diarista' => $diarista
        ]);
    }

    /**
        * Atualiza diarista 
     */

    public function update(int $id, DiaristaRequest $request){
        $diarista = Diarista::findOrFail($id);

        $dados = $request->except(['_token', '_method']);

        $dados['cpf'] = str_replace(['.', '-', ], '', $dados['cpf']);
        $dados['cep'] = str_replace(['.', '-', ], '', $dados['cep']);
        $dados['telefone'] = str_replace(['(', ')', ' ', '-' ], '', $dados['telefone']);

        $dados['codigo_ibge'] = $this->viaCep->buscar($dados['cep'])['ibge'];

        if($request->hasFile('foto_usuario')){
        
            $dados['foto_usuario'] = $request->foto_usuario->store('public');

        }

        $diarista->update($dados);

        return redirect()->route('diarista.index');
    }

    /**
        * Apaga diarista 
     */
    public function destroy(int $id){
        $diarista = Diarista::findOrFail($id);

        $diarista->delete();

        return redirect()->route('diarista.index');
    }

}


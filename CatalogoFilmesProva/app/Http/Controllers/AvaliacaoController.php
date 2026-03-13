<?php

namespace App\Http\Controllers;

use App\Models\Avaliacao;
use App\Models\Filme;

use Illuminate\Http\Request;

class AvaliacaoController extends Controller
{

    function index()
    {
        $dados = Avaliacao::all(); //select * from aluno

        // dd($dados);
        //var_dump($dados);
        //  exit;

        return view('avaliacoes.list', ['dados' => $dados]);
    }

        function create()
{
    $filmes = Filme::all();
    return view('avaliacoes.form', ['filmes' => $filmes]);
}


    function store(Request $request)
    {
        $request->validate([
            'usuario' => 'required',
            'filmes_id' => 'required',
            'comentario' => 'required',
            'nota' => 'required'
        ], [
            'usuario' => "O :attribute é obrigatório",
            'filmes_id' => "O :attribute é obrigatório",
            'comentario' => "O :attribute é obrigatório",
            'nota' => "O :attribute é obrigatório",
        ]);
        Avaliacao::create($request->all());

        return redirect('avaliacoes');
    }

    function edit($id)
{
    $dado = Avaliacao::find($id);
    $filmes = Filme::all();

    return view('avaliacoes.form', [
        'dado' => $dado,
        'filmes' => $filmes
    ]);
}
    function update(Request $request, $id)
    {
        $request->validate([
            'usuario' => 'required',
            'filmes_id' => 'required',
            'comentario' => 'required',
            'nota' => 'required'
        ], [
            'usuario' => "O :attribute é obrigatório",
            'filmes_id' => "O :attribute é obrigatório",
            'comentario' => "O :attribute é obrigatório",
            'nota' => "O :attribute é obrigatório",
        ]);

        Avaliacao::find($id)->update($request->all());

    return redirect('avaliacoes');
    }

    function destroy($id)
    {
        Avaliacao::destroy($id);
        return redirect('avaliacoes');
    }

    function search(Request $request)
    {
        if (!empty($request->valor)) {
            $dados = Avaliacao::where(
                $request->tipo,
                'like',
                '%' . $request->valor . '%'
            )->get();
        } else {
            $dados = Avaliacao::all();
        }

        return view('avaliacoes.list', ['dados' => $dados]);
    }
}

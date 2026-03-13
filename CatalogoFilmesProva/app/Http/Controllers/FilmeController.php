<?php

namespace App\Http\Controllers;
use App\Models\Filme;
use App\Models\Diretor;

use Illuminate\Http\Request;

class FilmeController extends Controller
{

    function index()
    {
        $dados = Filme::all(); //select * from aluno

        // dd($dados);
        //var_dump($dados);
        //  exit;

        return view('filmes.list', ['dados' => $dados]);
    }

        function create()
{
    $diretores = Diretor::all();
    return view('filmes.form', ['diretores' => $diretores]);
}
    }

    function store(Request $request)
    {
        $request->validate([
            'nome' => 'required',
            'ano' => 'required',
            'duracao' => 'required',
            'nota' => 'required',
            'genero' => 'required',
            'diretores_id' => 'required'
        ], [
            'nome' => "O :attribute é obrigatório",
            'ano' => "O :attribute é obrigatório",
            'duracao' => "O :attribute é obrigatório",
            'nota' => "O :attribute é obrigatório",
            'genero' => "O :attribute é obrigatório",
            'diretores_id' => "O :attribute é obrigatório"
        ]);
        Filme::create($request->all());

        return redirect('filmes');
    }

    function edit($id)
{
    $dado = Filme::find($id);
    $diretores = Diretor::all();

    return view('filmes.form', [
        'dado' => $dado,
        'diretores' => $diretores
    ]);
}
    function update(Request $request, $id)
    {
        $request->validate([
        'nome' => 'required',
        'ano' => 'required',
        'duracao' => 'required',
        'nota' => 'required',
        'genero' => 'required',
        'diretores_id' => 'required'
        ], [
            'nome' => "O :attribute é obrigatório",
            'ano' => "O :attribute é obrigatório",
            'duracao' => "O :attribute é obrigatório",
            'nota' => "O :attribute é obrigatório",
            'genero' => "O :attribute é obrigatório",
            'diretores_id' => "O :attribute é obrigatório"
        ]);

        Filme::find($id)->update($request->all());

    return redirect('filmes');
    }

    function destroy($id)
    {
        Filme::destroy($id);
        return redirect('filmes');
    }

    function search(Request $request)
    {
        if (!empty($request->valor)) {
            $dados = Filme::where(
                $request->tipo,
                'like',
                '%' . $request->valor . '%'
            )->get();
        } else {
            $dados = Filme::all();
        }

        return view('filmes.list', ['dados' => $dados]);
    }


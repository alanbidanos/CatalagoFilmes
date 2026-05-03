<?php

namespace App\Http\Controllers;

use App\Models\Filme;
use App\Models\Premiacao;
use Illuminate\Http\Request;

class PremiacaoController extends Controller
{
    function index()
    {
        $dados = Premiacao::all();

        return view('premiacoes.list', ['dados' => $dados]);
    }

     function create()
    {
        $filmes = Filme::all();
        return view('premiacoes.form', ['filmes' => $filmes]);
    }

    function store(Request $request)
    {
        $request->validate([
            'nome' => 'required',
            'filmes_id' => 'required',
            'ano' => 'required',
        ], [
            'nome' => "O :attribute é obrigatório",
            'filmes_id' => "O :attribute é obrigatório",
            'ano' => "O :attribute é obrigatório",
        ]);
        Premiacao::create($request->all());

        return redirect('premiacoes');
    }

    function edit($id)
{
    $dado = Premiacao::find($id);
    $filmes = Filme::all();

    return view('premiacoes.form', [
        'dado' => $dado,
        'filmes' => $filmes
    ]);
}

function update(Request $request, $id)
    {
        $request->validate([
            'nome' => 'required',
            'filmes_id' => 'required',
            'ano' => 'required',
        ], [
            'nome' => "O :attribute é obrigatório",
            'filmes_id' => "O :attribute é obrigatório",
            'ano' => "O :attribute é obrigatório",
        ]);

        Premiacao::find($id)->update($request->all());

    return redirect('premiacoes');
    }

    function destroy($id)
    {
        Premiacao::destroy($id);
        return redirect('premiacoes');
    }

    function search(Request $request)
{
    if (!empty($request->valor)) {

        if ($request->tipo == 'filmes_id') {
            $dados = Premiacao::whereHas('filme', function ($query) use ($request) {
                $query->where('nome', 'like', '%' . $request->valor . '%');
            })->get();

        } else {
            $dados = Premiacao::where(
                $request->tipo,
                'like',
                '%' . $request->valor . '%'
            )->get();
        }

    } else {
        $dados = Premiacao::all();
    }

    return view('premiacoes.list', ['dados' => $dados]);
}
}

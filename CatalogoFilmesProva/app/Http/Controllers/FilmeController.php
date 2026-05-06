<?php

namespace App\Http\Controllers;

use App\Charts\FilmesPorDiretor;
use App\Charts\DistribuNotas;
use App\Models\Filme;
use App\Models\Diretor;
use Barryvdh\DomPDF\Facade\Pdf;


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


    function store(Request $request)
    {

        $request->validate([
            'nome' => 'required',
            'capa' => 'nullable|image',
            'ano' => 'required',
            'duracao' => 'required',
            'nota' => 'required',
            'genero' => 'required',
            'diretores_id' => 'required'
        ], [
            'nome' => "O :attribute é obrigatório",
            'capa' => "O :attribute é obrigatório",
            'ano' => "O :attribute é obrigatório",
            'duracao' => "O :attribute é obrigatório",
            'nota' => "O :attribute é obrigatório",
            'genero' => "O :attribute é obrigatório",
            'diretores_id' => "O :attribute é obrigatório"
        ]);

        $data = $request->all();
        $capa = $request->file('capa');

        if ($capa) {
            $nome_capa = date('YmdiHs') . "." . $capa->getClientOriginalExtension();
            $diretorio = "imagem/filmes/";
            $capa->storeAs($diretorio, $nome_capa, 'public');

            $data['capa'] = $diretorio . $nome_capa;
        }

        Filme::create($data);

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
            'foto' => 'nullable|image',
            'ano' => 'required',
            'duracao' => 'required',
            'nota' => 'required',
            'genero' => 'required',
            'diretores_id' => 'required'
        ], [
            'nome' => "O :attribute é obrigatório",
            'capa' => "O :attribute não é obrigatório",
            'ano' => "O :attribute é obrigatório",
            'duracao' => "O :attribute é obrigatório",
            'nota' => "O :attribute é obrigatório",
            'genero' => "O :attribute é obrigatório",
            'diretores_id' => "O :attribute é obrigatório"
        ]);

        $data = $request->all();

        if ($request->hasFile('capa')) {
            $capa = $request->file('capa');
            $nome_capa = date('YmdHis') . "." . $capa->getClientOriginalExtension();
            $diretorio = "imagem/filmes/";

            $capa->storeAs($diretorio, $nome_capa, 'public');

            $data['capa'] = $diretorio . $nome_capa;
        }

        Filme::find($id)->update($data);

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

        if ($request->tipo == 'diretores_id') {
            $dados = Filme::whereHas('diretor', function ($query) use ($request) {
                $query->where('nome', 'like', '%' . $request->valor . '%');
            })->get();

        } else {
            $dados = Filme::where(
                $request->tipo,
                'like',
                '%' . $request->valor . '%'
            )->get();
        }

    } else {
        $dados = Filme::all();
    }

    return view('filmes.list', ['dados' => $dados]);
}

    function chartdiretor(FilmesPorDiretor $chart)
    {
        return view('filmes.chartdiretor', ['chart' => $chart->build()]);
    }

    function chartnotas(DistribuNotas $chart)
    {
        return view('filmes.chartnotas', ['chart' => $chart->build()]);
    }

    function reportranking(){
        $filmes = Filme::orderByDesc('nota')->get();

        $data = [
            'titulo' => 'Relatório Ranking das notas dos Filmes',
            'filmes' => $filmes,
        ];

        $pdf = Pdf::loadView('filmes.reportranking', $data);

        return $pdf->download('relatorio_ranking_filmes.pdf');

    }
}

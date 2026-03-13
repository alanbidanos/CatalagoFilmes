<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Diretor;

class DiretorController extends Controller
{

    function index()
    {
        $dados = Diretor::all(); //select * from aluno

        // dd($dados);
        //var_dump($dados);
        //  exit;

        return view('diretores.list', ['dados' => $dados]);
    }

    function create()
    {
        return view('diretores.form');
    }

    function store(Request $request)
    {
        $request->validate([
            'nome' => 'required',
            'nascimento' => 'required',
            'idade' => 'required',
            'pais' => 'required',
        ], [
            'nome' => "O :attribute é obrigatório",
            'nascimento' => "O :attribute é obrigatório",
            'idade' => "O :attribute é obrigatório",
            'pais' => "O :attribute é obrigatório",
        ]);

        Diretor::create($request->all());

        return redirect('diretores');
    }

    function edit($id)
    {
        $dado = Diretor::find($id);
        return view('diretores.form', ['dado' => $dado]);
    }

    function update(Request $request, $id)
    {
        $request->validate([
            'nome' => 'required',
            'nascimento' => 'required',
            'idade' => 'required',
            'pais_origem' => 'required',
        ], [
            'nome' => "O :attribute é obrigatório",
            'nascimento' => "O :attribute é obrigatório",
            'idade' => "O :attribute é obrigatório",
            'pais_origem' => "O :attribute é obrigatório",
        ]);

        Diretor::find($id)->update($request->all());

        return redirect('diretores');
    }

    function destroy($id)
    {
        Diretor::destroy($id);
        return redirect('diretores');
    }

    function search(Request $request)
    {
        if (!empty($request->valor)) {
            $dados = Diretor::where(
                $request->tipo,
                'like',
                '%' . $request->valor . '%'
            )->get();
        } else {
            $dados = Diretor::all();
        }

        return view('diretores.list', ['dados' => $dados]);
    }
}

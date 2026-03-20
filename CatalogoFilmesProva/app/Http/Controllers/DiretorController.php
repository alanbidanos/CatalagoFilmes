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
            'foto' => 'nullable|image',
            'nascimento' => 'required',
            'idade' => 'required',
            'pais' => 'required',
        ], [
            'nome' => "O :attribute é obrigatório",
            'foto' => "O :attribute é obrigatório",
            'nascimento' => "O :attribute é obrigatório",
            'idade' => "O :attribute é obrigatório",
            'pais' => "O :attribute é obrigatório",
        ]);

         $data = $request->all();
        $foto = $request->file('foto');

        if ($foto) {
            $nome_foto = date('YmdiHs') . "." . $foto->getClientOriginalExtension();
            $diretorio = "imagem/diretores/";
            $foto->storeAs($diretorio, $nome_foto, 'public');

            $data['foto'] = $diretorio . $nome_foto;
        }

        Diretor::create($data);

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
            'foto' => 'nullable|image',
            'nascimento' => 'required',
            'idade' => 'required',
            'pais' => 'required',
        ], [
            'nome' => "O :attribute é obrigatório",
            'foto' => "O :attribute não é obrigatório",
            'nascimento' => "O :attribute é obrigatório",
            'idade' => "O :attribute é obrigatório",
            'pais' => "O :attribute é obrigatório",
        ]);

        $data = $request->all();
        $foto = $request->file('foto');

        if ($foto) {
            $nome_foto = date('YmdiHs') . "." . $foto->getClientOriginalExtension();
            $diretorio = "imagem/diretores/";
            $foto->storeAs($diretorio, $nome_foto, 'public');

            $data['foto'] = $diretorio . $nome_foto;
        }

        Diretor::find($id)->update($data);
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

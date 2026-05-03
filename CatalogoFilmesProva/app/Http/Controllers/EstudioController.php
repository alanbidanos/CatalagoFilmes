<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Estudio;

class EstudioController extends Controller
{
    function index()
    {
        $dados = Estudio::all();

        return view('estudios.list', ['dados' => $dados]);
    }

    function create()
    {
        return view('estudios.form');
    }

    function store(Request $request)
    {
        $request->validate([
            'nome' => 'required',
            'logo' => 'nullable|image',
            'ano_fundacao' => 'required',
            'pais_fundacao' => 'required',
        ], [
            'nome' => "O :attribute é obrigatório",
            'logo' => "O :attribute é obrigatório",
            'ano_fundacao' => "O :attribute é obrigatório",
            'pais_fundacao' => "O :attribute é obrigatório",
        ]);

        $data = $request->all();
        $logo = $request->file('logo');

        if ($logo) {
            $nome_logo = date('YmdiHs') . "." . $logo->getClientOriginalExtension();
            $diretorio = "imagem/estudios/";
            $logo->storeAs($diretorio, $nome_logo, 'public');

            $data['logo'] = $diretorio . $nome_logo;
        }

        Estudio::create($data);

        return redirect('estudios');
    }
    function edit($id)
    {
        $dado = Estudio::find($id);
        return view('estudios.form', ['dado' => $dado]);
    }

    function update(Request $request, $id)
    {
        $request->validate([
            'nome' => 'required',
            'logo' => 'nullable|image',
            'ano_fundacao' => 'required',
            'pais_fundacao' => 'required',
        ], [
            'nome' => "O :attribute é obrigatório",
            'logo' => "O :attribute é obrigatório",
            'ano_fundacao' => "O :attribute é obrigatório",
            'pais_fundacao' => "O :attribute é obrigatório",
        ]);

        $data = $request->all();


        $logo = $request->file('logo');
        if ($logo) {
            $nome_logo = date('YmdiHs') . "." . $logo->getClientOriginalExtension();
            $diretorio = "imagem/estudios/";
            $logo->storeAs($diretorio, $nome_logo, 'public');

            $data['logo'] = $diretorio . $nome_logo;
        }



        Estudio::find($id)->update($data);
        return redirect('estudios');
    }

    function destroy($id)
    {
        Estudio::destroy($id);
        return redirect('estudios');
    }

    function search(Request $request)
    {
        if (!empty($request->valor)) {
            $dados = Estudio::where(
                $request->tipo,
                'like',
                '%' . $request->valor . '%'
            )->get();
        } else {
            $dados = Estudio::all();
        }

        return view('estudios.list', ['dados' => $dados]);
    }
}

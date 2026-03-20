@extends('main')
@section('titulo', 'Formulário Diretor')
@section('conteudo')

    <h4>Formulário Diretor</h4>

    @php
        if (!empty($dado->id)) {
            $action = route('diretores.update', $dado->id);
        } else {
            $action = route('diretores.store');
        }
    @endphp

    <form action="{{ $action }}" method="POST" enctype="multipart/form-data">
        @csrf
        @if (!empty($dado->id))
            @method('PUT')
        @endif
        <div class="row">
            <input type="hidden" name="id" value="{{ $dado->id ?? '' }}">
            <div class="col">
                <label for="nome" class="form-label">Nome</label>
                <input type="text" class="form-control" name="nome" value="{{ old('nome', $dado->nome ?? '') }}">
            </div>
            <div class="row">
                <div class="col">
                <label class="form-label" for="imagem">Foto</label>
                @php
                    $nome_foto = !empty($dado->foto) ? $dado->foto : 'imagem/diretores/sem-imagem.jpeg';
                @endphp
                <img src="/storage/{{ $nome_foto }}" class="rounded-circle" width="200px" height="200px" alt="foto">
                <input type="file" name="foto" class="form-control" value="{{ old('foto', $dado->foto ?? '') }}">
            </div>
            <div class="col">
                <label for="nascimento" class="form-label">Nascimento</label>
                <input type="text" class="form-control" name="nascimento"
                    value="{{ old('nascimento', $dado->nascimento ?? '') }}">
            </div>
            <div class="col">
                <label class="form-label" for="idade">Idade</label>
                <input type="text" class="form-control" name="idade" value="{{ old('idade', $dado->idade ?? '') }}">
            </div>
            <div class="col">
                <label class="form-label" for="pais">País de origem</label>
                <input type="text" class="form-control" name="pais" value="{{ old('pais', $dado->pais ?? '') }}">
            </div>
        </div>
        <div class="row">
            <div class="col">
                <button type="submit" class="btn btn-success">Salvar</button>
                <a href="{{ url('diretores') }}" class="btn btn-primary">Voltar</a>
            </div>
        </div>
    </form>

@stop

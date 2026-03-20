@extends('main')
@section('titulo', 'Formulário Filmes')
@section('conteudo')

    <h4>Formulário Filmes</h4>

    @php
        if (!empty($dado->id)) {
            $action = route('filmes.update', $dado->id);
        } else {
            $action = route('filmes.store');
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
                <label class="form-label" for="imagem">Capa</label>
                @php
                    $nome_capa = !empty($dado->capa) ? $dado->capa : 'imagem/filmes/sem-imagem.jpeg';
                @endphp
                <img src="/storage/{{ $nome_capa }}" class="rounded-circle" width="200px" height="200px" alt="capa">
                <input type="file" name="capa" class="form-control" value="{{ old('capa', $dado->capa ?? '') }}">
            </div>

            </div>

            <div class="col">
                <label for="ano" class="form-label">Ano</label>
                <input type="text" class="form-control" name="ano" value="{{ old('ano', $dado->ano ?? '') }}">
            </div>
            <div class="col">
                <label class="form-label" for="duracao">Duração</label>
                <input type="text" class="form-control" name="duracao"
                    value="{{ old('duracao', $dado->duracao ?? '') }}">
            </div>
            <div class="col">
                <label class="form-label" for="nota">Nota</label>
                <input type="text" class="form-control" name="nota" value="{{ old('nota', $dado->nota ?? '') }}">
            </div>
            <div class="col">
                <label class="form-label" for="genero">Gênero</label>
                <input type="text" class="form-control" name="genero" value="{{ old('genero', $dado->genero ?? '') }}">
            </div>
            <div class="col">
                <label for="diretores_id" class="form-label">Diretor</label>
                <select class="form-control" name="diretores_id">
                    <option value="">Selecione um diretor</option>
                    @foreach ($diretores as $diretor)
                        <option value="{{ $diretor->id }}"
                            {{ old('diretores_id', $dado->diretores_id ?? '') == $diretor->id ? 'selected' : '' }}>
                            {{ $diretor->nome }}
                        </option>
                    @endforeach
                </select>
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

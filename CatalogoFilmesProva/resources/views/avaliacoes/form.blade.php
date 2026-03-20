@extends('main')
@section('titulo', 'Formulário Avaliação')
@section('conteudo')

    <h4>Formulário Avaliação</h4>

    @php
        if (!empty($dado->id)) {
            $action = route('avaliacoes.update', $dado->id);
        } else {
            $action = route('avaliacoes.store');
        }
    @endphp

    <form action="{{ $action }}" method="POST">
        @csrf
        @if (!empty($dado->id))
            @method('PUT')
        @endif
        <div class="row">
            <input type="hidden" name="id" value="{{ $dado->id ?? '' }}">
            <div class="col">
                <label for="usuario" class="form-label">Usuário</label>
                <input type="text" autocomplete="off" class="form-control" name="usuario" value="{{ old('usuario', $dado->usuario ?? '') }}">
            </div>
            <div class="col">
                <label for="filmes_id" class="form-label">Filme</label>
                <select class="form-control" name="filmes_id">
                    <option value="">Selecione um filme</option>
                    @foreach ($filmes as $filme)
                        <option value="{{ $filme->id }}" {{ old('filmes_id', $dado->filmes_id ?? '') == $filme->id ? 'selected' : '' }}>
                            {{ $filme->nome }}
                        </option>
                    @endforeach
                </select>
            </div>
            <div class="col">
                <label class="form-label" for="comentario">Comentário</label>
                <input type="text" autocomplete="off"  class="form-control" name="comentario" value="{{ old('comentario', $dado->comentario ?? '') }}">
            </div>
            <div class="col">
                <label class="form-label" for="nota">Nota</label>
                <input type="text" autocomplete="off" class="form-control" name="nota" value="{{ old('nota', $dado->nota ?? '') }}">
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

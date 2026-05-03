@extends('main')
@section('titulo', 'Formulário Premiação')
@section('conteudo')

<div class="d-flex align-items-center gap-2 mb-4">
    <a href="{{ url('premiacoes') }}" class="btn btn-sm btn-light border">Voltar</a>
    <h4 class="mb-0 titulopagina">{{ !empty($dado->id) ? 'Editar Premiação' : 'Nova Premiação' }}</h4>
</div>

@php
    if (!empty($dado->id)) {
        $action = route('premiacoes.update', $dado->id);
    } else {
        $action = route('premiacoes.store');
    }
@endphp

<form action="{{ $action }}" method="POST">
    @csrf
    @if (!empty($dado->id))
        @method('PUT')
    @endif
    <input type="hidden" name="id" value="{{ $dado->id ?? '' }}">

    <div class="formcard">

        <p class="titulosection">Dados</p>
        <div class="row g-3 mb-4">
            <div class="col-md-6">
                <label for="nome" class="form-label fw-semibold">Nome</label>
                <input type="text" autocomplete="off" class="form-control campoinput" name="nome"
                    id="nome" placeholder="Ex: João Silva"
                    value="{{ old('nome', $dado->nome ?? '') }}">
            </div>
            <div class="col-md-6">
                <label for="filmes_id" class="form-label fw-semibold">Filme Premiado</label>
                <select class="form-select campoinput" name="filmes_id" id="filmes_id">
                    <option value="">Selecione um filme...</option>
                    @foreach ($filmes as $filme)
                        <option value="{{ $filme->id }}"
                            {{ old('filmes_id', $dado->filmes_id ?? '') == $filme->id ? 'selected' : '' }}>
                            {{ $filme->nome }}
                        </option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-6">
                <label for="ano" class="form-label fw-semibold">Ano da premiação</label>
                <input type="text" autocomplete="off" class="form-control campoinput" name="ano"
                    id="ano" placeholder="Ex: 2020"
                    value="{{ old('ano', $dado->ano ?? '') }}">
            </div>
        </div>


        <div class="d-flex gap-2 pt-2 border-top bordadivider">
            <button type="submit" class="btn btnbuscar px-4">Salvar</button>
            <a href="{{ url('premiacoes') }}" class="btn btncancelar px-4">Cancelar</a>
        </div>

    </div>
</form>


<style>
    .titulopagina {
        color: #e2b96f;
        letter-spacing: 0.05em;
    }

    .btn-light.border {
        background: #1e1e35;
        border-color: #2a2a45 !important;
        color: #9090aa;
    }
    .btn-light.border:hover {
        background: #2a2a45;
        color: #e0e0e0;
    }

    .formcard {
        background: #1a1a2e;
        border: 1px solid #2a2a45;
        border-radius: 14px;
        box-shadow: 0 2px 16px rgba(0,0,0,0.4);
        padding: 2rem;
    }
    .titulosection {
        font-size: 0.7rem;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: 0.1em;
        color: #e2b96f;
        margin-bottom: 1rem;
        padding-bottom: 0.4rem;
        border-bottom: 1px solid #2a2a45;
    }


    .campoinput {
        background-color: #16162a !important;
        border-color: #2a2a45 !important;
        color: #e0e0e0 !important;
    }
    .campoinput::placeholder { color: #6060aa; }
    .campoinput:focus {
        border-color: #e2b96f !important;
        box-shadow: 0 0 0 0.2rem rgba(226,185,111,0.15) !important;
    }
    .form-label { color: #9090aa; }
    textarea.campoinput { resize: vertical; }


    .notatexto { color: #9090aa; font-size: 0.82rem; }


    .bordadivider { border-color: #2a2a45 !important; }
    .btnbuscar {
        background: #e2b96f; border-color: #e2b96f;
        color: #1a1a2e; font-weight: 600;
    }
    .btnbuscar:hover { background: #f0d090; border-color: #f0d090; color: #1a1a2e; }
    .btncancelar {
        background: transparent; border: 1px solid #2a2a45;
        color: #9090aa; font-weight: 600;
    }
    .btncancelar:hover { background: #2a2a45; color: #e0e0e0; }
</style>

@stop

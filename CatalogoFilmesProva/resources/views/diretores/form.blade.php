@extends('main')
@section('titulo', 'Diretores')
@section('conteudo')

<div class="d-flex align-items-center gap-2 mb-4">
    <a href="{{ url('diretores') }}" class="btn btn-sm btn-light border">Voltar</a>
    <h4 class="mb-0">{{ !empty($dado->id) ? 'Editar Diretor' : 'Novo Diretor' }}</h4>
</div>

@php
    if (!empty($dado->id)) {
        $action = route('diretores.update', $dado->id);
    } else {
        $action = route('diretores.store');
    }
    $nomefoto = !empty($dado->foto) ? $dado->foto : 'imagem/diretores/sem-imagem.jpeg';
@endphp

<form action="{{ $action }}" method="POST" enctype="multipart/form-data">
    @csrf
    @if (!empty($dado->id))
        @method('PUT')
    @endif
    <input type="hidden" name="id" value="{{ $dado->id ?? '' }}">

    <div class="formcard">

        <p class="titulosection">Diretor</p>
        <div class="d-flex gap-4 align-items-start mb-4">

            <div>
                <label style="display:block; margin-bottom:0.4rem; font-size:0.82rem; font-weight:600; color:#555;">Foto</label>
                <div class="fotinha" onclick="document.getElementById('foto').click()">
                    <img id="fotoimg" src="/storage/{{ $nomefoto }}" alt="foto">
                    <div class="sobrefoto">
                        <span>Alterar</span>
                    </div>
                </div>
                <input type="file" id="foto" name="foto" accept="image/*" class="d-none"
                    onchange="imagem(this)">
            </div>

            <div class="flex-fill">
                <label for="nome" class="form-label fw-semibold">Nome do Diretor</label>
                <input type="text" autocomplete="off" class="form-control form-control-lg" name="nome"
                    id="nome" placeholder="Ex: Christopher Nolan"
                    value="{{ old('nome', $dado->nome ?? '') }}">
            </div>
        </div>

        <p class="titulosection">Detalhes</p>
        <div class="row g-3 mb-4">
            <div class="col-md-4">
                <label for="nascimento" class="form-label fw-semibold">Nascimento</label>
                <input type="date" autocomplete="off" class="form-control" name="nascimento" id="nascimento"
                    value="{{ old('nascimento', $dado->nascimento ?? '') }}">
            </div>
            <div class="col-md-4">
                <label for="idade" class="form-label fw-semibold">Idade</label>
                <input type="number" autocomplete="off" class="form-control" name="idade" id="idade"
                    placeholder="Ex: 54"
                    value="{{ old('idade', $dado->idade ?? '') }}">
            </div>
            <div class="col-md-4">
                <label for="pais" class="form-label fw-semibold">País de Origem</label>
                <input type="text" autocomplete="off" class="form-control" name="pais" id="pais"
                    placeholder="Ex: Reino Unido"
                    value="{{ old('pais', $dado->pais ?? '') }}">
            </div>
        </div>

        <div class="d-flex gap-2 pt-2 border-top">
            <button type="submit" class="btn btn-success px-4">Salvar</button>
            <a href="{{ url('diretores') }}" class="btn btn-light border px-4">Cancelar</a>
        </div>

    </div>
</form>

<style>
    /* ── Botão voltar ── */
    .btn-light.border {
        background: #2a1f1f;
        border-color: #3d2a2a !important;
        color: #b89a85;
    }
    .btn-light.border:hover {
        background: #3d2a2a;
        color: #e8d5c4;
    }

    /* ── Título da página ── */
    h4 { color: #f0c080; }

    /* ── Formcard ── */
    .formcard {
        background: #2a1f1f;
        border: 1px solid #3d2a2a;
        border-radius: 14px;
        box-shadow: 0 2px 16px rgba(0,0,0,0.4);
        padding: 2rem;
    }
    .titulosection {
        font-size: 0.7rem;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: 0.1em;
        color: #f0c080;
        margin-bottom: 1rem;
        padding-bottom: 0.4rem;
        border-bottom: 1px solid #3d2a2a;
    }

    /* ── Inputs ── */
    .form-control, .form-select {
        background-color: #1e1515 !important;
        border-color: #3d2a2a !important;
        color: #e8d5c4 !important;
    }
    .form-control::placeholder { color: #7a5a4a; }
    .form-control:focus, .form-select:focus {
        border-color: #f0c080 !important;
        box-shadow: 0 0 0 0.2rem rgba(240,192,128,0.15) !important;
    }
    .form-label { color: #b89a85; }

    /* ── Foto circular ── */
    .fotinha {
        position: relative;
        width: 200px;
        height: 200px;
        border-radius: 50%;
        overflow: hidden;
        box-shadow: 0 2px 10px rgba(0,0,0,0.4);
        border: 3px solid #3d2a2a;
        cursor: pointer;
        flex-shrink: 0;
        transition: border-color 0.2s;
    }
    .fotinha:hover { border-color: #f0c080; }
    .fotinha img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        object-position: top;
        transition: filter 0.2s;
    }
    .sobrefoto {
        position: absolute;
        inset: 0;
        background: rgba(0,0,0,0.55);
        display: flex;
        align-items: center;
        justify-content: center;
        opacity: 0;
        transition: opacity 0.2s;
        color: #f0c080;
        font-size: 0.82rem;
        font-weight: 700;
        letter-spacing: 0.05em;
    }
    .fotinha:hover .sobrefoto { opacity: 1; }
    .fotinha:hover img { filter: brightness(0.6); }

    /* ── Botões ── */
    .border-top { border-color: #3d2a2a !important; }
    .btn-success {
        background: #f0c080 !important;
        border-color: #f0c080 !important;
        color: #2a1f1f !important;
        font-weight: 600;
    }
    .btn-success:hover {
        background: #f8d49a !important;
        border-color: #f8d49a !important;
    }
    .btn-light {
        background: transparent !important;
        border-color: #3d2a2a !important;
        color: #b89a85 !important;
    }
    .btn-light:hover {
        background: #3d2a2a !important;
        color: #e8d5c4 !important;
    }
</style>

@stop

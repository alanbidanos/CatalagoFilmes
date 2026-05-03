@extends('main')
@section('titulo', 'Estudios')
@section('conteudo')

<div class="d-flex align-items-center gap-2 mb-4">
    <a href="{{ url('estudios') }}" class="btn btn-sm btn-light border">Voltar</a>
    <h4 class="mb-0">{{ !empty($dado->id) ? 'Editar Estudio' : 'Novo Estudio' }}</h4>
</div>

@php
    if (!empty($dado->id)) {
        $action = route('estudios.update', $dado->id);
    } else {
        $action = route('estudios.store');
    }
    $nomelogo = !empty($dado->logo) ? $dado->logo : 'imagem/estudios/sem-imagem.jpeg';
@endphp

<form action="{{ $action }}" method="POST" enctype="multipart/form-data">
    @csrf
    @if (!empty($dado->id))
        @method('PUT')
    @endif
    <input type="hidden" name="id" value="{{ $dado->id ?? '' }}">

    <div class="formcard">

        <p class="titulosection">Estudio</p>
        <div class="d-flex gap-4 align-items-start mb-4">

            <div>
                <label style="display:block; margin-bottom:0.4rem; font-size:0.82rem; font-weight:600; color:#555;">Logo</label>
                <div class="fotinha" onclick="document.getElementById('logo').click()">
                    <img id="logoimg" src="/storage/{{ $nomelogo }}" alt="logo">
                    <div class="sobrelogo">
                        <span>Alterar</span>
                    </div>
                </div>
                <input type="file" id="logo" name="logo" accept="image/*" class="d-none"
                    onchange="imagem(this)">
            </div>

            <div class="flex-fill">
                <label for="nome" class="form-label fw-semibold">Nome do Estudio</label>
                <input type="text" autocomplete="off" class="form-control form-control-lg" name="nome"
                    id="nome" placeholder="Ex: Warner Bros."
                    value="{{ old('nome', $dado->nome ?? '') }}">
            </div>
        </div>

        <p class="titulosection">Detalhes</p>
        <div class="row g-3 mb-4">
            <div class="col-md-4">
                <label for="ano_fundacao" class="form-label fw-semibold">Ano de Fundação</label>
                <input type="date" autocomplete="off" class="form-control" name="ano_fundacao" id="ano_fundacao"
                    value="{{ old('ano_fundacao', $dado->ano_fundacao ?? '') }}">
            </div>

            <div class="col-md-4">
                <label for="pais_fundacao" class="form-label fw-semibold">País de Fundação</label>
                <input type="text" autocomplete="off" class="form-control" name="pais_fundacao" id="pais_fundacao"
                    placeholder="Ex: Reino Unido"
                    value="{{ old('pais_fundacao', $dado->pais_fundacao ?? '') }}">
            </div>
        </div>

        <div class="d-flex gap-2 pt-2 border-top">
            <button type="submit" class="btn btn-success px-4">Salvar</button>
            <a href="{{ url('estudios') }}" class="btn btn-light border px-4">Cancelar</a>
        </div>

    </div>
</form>

<script>
    function imagem(input) {
        if (input.files && input.files[0]) {
            const reader = new FileReader();
            reader.onload = e => {
                document.getElementById('logoimg').src = e.target.result;
            };
            reader.readAsDataURL(input.files[0]);
        }
    }
</script>

<style>

    .btn-light.border {
        background: #2a1f1f;
        border-color: #3d2a2a !important;
        color: #b89a85;
    }
    .btn-light.border:hover {
        background: #3d2a2a;
        color: #e8d5c4;
    }


    h4 { color: #f0c080; }


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
    .sobrelogo {
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
    .fotinha:hover .sobrelogo { opacity: 1; }
    .fotinha:hover img { filter: brightness(0.6); }

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

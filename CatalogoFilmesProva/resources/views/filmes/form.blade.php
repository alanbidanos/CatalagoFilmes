@extends('main')
@section('titulo', 'Filmes')
@section('conteudo')


<div class="d-flex align-items-center gap-2 mb-4">
    <a href="{{ url('filmes') }}" class="btn btn-sm btn-light border">Voltar</a>
    <h4 class="mb-0">{{ !empty($dado->id) ? 'Editar Filme' : 'Novo Filme' }}</h4>
</div>

@php
    if (!empty($dado->id)) {
        $action = route('filmes.update', $dado->id);
    } else {
        $action = route('filmes.store');
    }
    $nomecapa = !empty($dado->capa) ? $dado->capa : 'imagem/filmes/sem-imagem.jpeg';
    $notaatual = old('nota', $dado->nota ?? 0);
@endphp

<form action="{{ $action }}" method="POST" enctype="multipart/form-data">
    @csrf
    @if (!empty($dado->id))
        @method('PUT')
    @endif
    <input type="hidden" name="id" value="{{ $dado->id ?? '' }}">

    <div class="formcard">


        <p class="titulosection">Filme</p>
        <div class="d-flex gap-4 align-items-start mb-4">


            <div>
                <label for="capa" style="display:block; margin-bottom:0.4rem; font-size:0.82rem; font-weight:600; color:#555;">Capa</label>
                <div class="capinha" onclick="document.getElementById('capa').click()">
                    <img id="capaimg" src="/storage/{{ $nomecapa }}" alt="capa">
                    <div class="sobrecapa">
                        <span>Alterar</span>
                    </div>
                </div>
                <input type="file" id="capa" name="capa" accept="image/*" class="d-none"
                    onchange="imagem(this)">
            </div>


            <div class="flex-fill">
                <label for="nome" class="form-label fw-semibold">Nome do Filme</label>
                <input type="text" autocomplete="off" class="form-control form-control-lg" name="nome"
                    id="nome" placeholder="Ex: Interestelar"
                    value="{{ old('nome', $dado->nome ?? '') }}">
            </div>
        </div>


        <p class="titulosection">Detalhes</p>
        <div class="row g-3 mb-4">
            <div class="col-md-3">
                <label for="ano" class="form-label fw-semibold">Ano</label>
                <input type="number" autocomplete="off" class="form-control" name="ano" id="ano"
                    placeholder="Ex: 2014" min="1900" max="2099"
                    value="{{ old('ano', $dado->ano ?? '') }}">
            </div>
            <div class="col-md-3">
                <label for="duracao" class="form-label fw-semibold">Duração</label>
                <input type="time" autocomplete="off" class="form-control" name="duracao" id="duracao"
                    value="{{ old('duracao', $dado->duracao ?? '') }}">
            </div>
            <div class="col-md-3">
                <label for="genero" class="form-label fw-semibold">Gênero</label>
                <input type="text" autocomplete="off" class="form-control" name="genero" id="genero"
                    placeholder="Ex: Ficção Científica"
                    value="{{ old('genero', $dado->genero ?? '') }}">
            </div>
            <div class="col-md-3">
                <label for="diretores_id" class="form-label fw-semibold">Diretor</label>
                <select class="form-select" name="diretores_id" id="diretores_id">
                    <option value="">Selecione...</option>
                    @foreach ($diretores as $diretor)
                        <option value="{{ $diretor->id }}"
                            {{ old('diretores_id', $dado->diretores_id ?? '') == $diretor->id ? 'selected' : '' }}>
                            {{ $diretor->nome }}
                        </option>
                    @endforeach
                </select>
            </div>
        </div>

        <p class="titulosection">Avaliação</p>
        <div class="mb-4">
            <label class="form-label fw-semibold d-block">Nota</label>
            <div class="estrelinhas" id="estrelinhas">
                @for ($i = 5; $i >= 1; $i--)
                    <input type="radio" id="star{{ $i }}" name="notaestrela" value="{{ $i }}"
                        {{ (int)$notaatual == $i ? 'checked' : '' }}>
                    <label for="star{{ $i }}" title="{{ $i }}">★</label>
                @endfor
            </div>
            <input type="hidden" name="nota" id="nota-hidden" value="{{ $notaatual }}">
            <small class="text-muted mt-1 d-block">Nota selecionada: <span id="nota-label">{{ $notaatual ?: '—' }}</span>/5</small>
        </div>

        <div class="d-flex gap-2 pt-2 border-top">
            <button type="submit" class="btn btn-success px-4">
                 Salvar
            </button>
            <a href="{{ url('filmes') }}" class="btn btn-light border px-4">Cancelar</a>
        </div>

    </div>
</form>

<script>
    function imagem(input) {
        if (input.files && input.files[0]) {
            const reader = new FileReader();
            reader.onload = e => {
                document.getElementById('capaimg').src = e.target.result;
            };
            reader.readAsDataURL(input.files[0]);
        }
    }

    document.querySelectorAll('#estrelinhas input').forEach(radio => {
        radio.addEventListener('change', function () {
            document.getElementById('nota-hidden').value = this.value;
            document.getElementById('nota-label').textContent = this.value;
        });
    });
</script>



<style>

    .btn-light.border {
        background: #1e1e35;
        border-color: #2a2a45 !important;
        color: #9090aa;
    }
    .btn-light.border:hover {
        background: #2a2a45;
        color: #e0e0e0;
    }

    h4 { color: #e2b96f; }

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

    .form-control, .form-select {
        background-color: #16162a !important;
        border-color: #2a2a45 !important;
        color: #e0e0e0 !important;
    }
    .form-control::placeholder { color: #6060aa; }
    .form-control:focus, .form-select:focus {
        border-color: #e2b96f !important;
        box-shadow: 0 0 0 0.2rem rgba(226,185,111,0.15) !important;
    }
    .form-label { color: #9090aa; }

    /* ── Capa retangular ── */
    .capinha {
        position: relative;
        width: 200px;
        height: 300px;
        border-radius: 10px;
        overflow: hidden;
        box-shadow: 0 2px 10px rgba(0,0,0,0.4);
        border: 3px solid #2a2a45;
        cursor: pointer;
        flex-shrink: 0;
        transition: border-color 0.2s;
    }
    .capinha:hover { border-color: #e2b96f; }
    .capinha img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        transition: filter 0.2s;
    }
    .sobrecapa {
        position: absolute;
        inset: 0;
        background: rgba(0,0,0,0.55);
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        opacity: 0;
        transition: opacity 0.2s;
        color: #e2b96f;
        font-size: 0.82rem;
        font-weight: 700;
        letter-spacing: 0.05em;
        gap: 4px;
    }
    .capinha:hover .sobrecapa { opacity: 1; }
    .capinha:hover img { filter: brightness(0.6); }

    /* ── Estrelas ── */
    .estrelinhas {
        display: flex;
        flex-direction: row-reverse;
        justify-content: flex-end;
        gap: 4px;
    }
    .estrelinhas input { display: none; }
    .estrelinhas label {
        font-size: 2rem;
        color: #2a2a45;
        cursor: pointer;
        transition: color 0.15s;
        line-height: 1;
    }
    .estrelinhas input:checked ~ label,
    .estrelinhas label:hover,
    .estrelinhas label:hover ~ label {
        color: #e2b96f;
    }

    /* ── Texto nota ── */
    .text-muted { color: #9090aa !important; }

    /* ── Botões ── */
    .border-top { border-color: #2a2a45 !important; }
    .btn-success {
        background: #e2b96f !important;
        border-color: #e2b96f !important;
        color: #1a1a2e !important;
        font-weight: 600;
    }
    .btn-success:hover {
        background: #f0d090 !important;
        border-color: #f0d090 !important;
    }
    .btn-light {
        background: transparent !important;
        border-color: #2a2a45 !important;
        color: #9090aa !important;
    }
    .btn-light:hover {
        background: #2a2a45 !important;
        color: #e0e0e0 !important;
    }
</style>
@stop

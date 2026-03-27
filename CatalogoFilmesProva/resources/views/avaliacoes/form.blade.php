@extends('main')
@section('titulo', 'Formulário Avaliação')
@section('conteudo')

<div class="d-flex align-items-center gap-2 mb-4">
    <a href="{{ url('avaliacoes') }}" class="btn btn-sm btn-light border">Voltar</a>
    <h4 class="mb-0 titulopagina">{{ !empty($dado->id) ? 'Editar Avaliação' : 'Nova Avaliação' }}</h4>
</div>

@php
    if (!empty($dado->id)) {
        $action = route('avaliacoes.update', $dado->id);
    } else {
        $action = route('avaliacoes.store');
    }
    $notaatual = old('nota', $dado->nota ?? 0);
@endphp

<form action="{{ $action }}" method="POST">
    @csrf
    @if (!empty($dado->id))
        @method('PUT')
    @endif
    <input type="hidden" name="id" value="{{ $dado->id ?? '' }}">

    <div class="formcard">

        <p class="titulosection">Identificação</p>
        <div class="row g-3 mb-4">
            <div class="col-md-6">
                <label for="usuario" class="form-label fw-semibold">Usuário</label>
                <input type="text" autocomplete="off" class="form-control campoinput" name="usuario"
                    id="usuario" placeholder="Ex: João Silva"
                    value="{{ old('usuario', $dado->usuario ?? '') }}">
            </div>
            <div class="col-md-6">
                <label for="filmes_id" class="form-label fw-semibold">Filme</label>
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
        </div>

        <p class="titulosection">Avaliação</p>
        <div class="row g-3 mb-4">
            <div class="col-12">
                <label for="comentario" class="form-label fw-semibold">Comentário</label>
                <textarea autocomplete="off" class="form-control campoinput" name="comentario"
                    id="comentario" rows="4"
                    placeholder="Escreva sua opinião sobre o filme...">{{ old('comentario', $dado->comentario ?? '') }}</textarea>
            </div>
            <div class="col-12">
                <label class="form-label fw-semibold d-block">Nota</label>
                <div class="estrelinhas" id="estrelinhas">
                    @for ($i = 5; $i >= 1; $i--)
                        <input type="radio" id="star{{ $i }}" name="notaestrela" value="{{ $i }}"
                            {{ (int)$notaatual == $i ? 'checked' : '' }}>
                        <label for="star{{ $i }}" title="{{ $i }}">★</label>
                    @endfor
                </div>
                <input type="hidden" name="nota" id="nota-hidden" value="{{ $notaatual }}">
                <small class="mt-1 d-block notatexto">
                    Nota selecionada: <span id="nota-label">{{ $notaatual ?: '—' }}</span>/5
                </small>
            </div>
        </div>

        <div class="d-flex gap-2 pt-2 border-top bordadivider">
            <button type="submit" class="btn btnbuscar px-4">Salvar</button>
            <a href="{{ url('avaliacoes') }}" class="btn btncancelar px-4">Cancelar</a>
        </div>

    </div>
</form>

<script>
    document.querySelectorAll('#estrelinhas input').forEach(radio => {
        radio.addEventListener('change', function () {
            document.getElementById('nota-hidden').value = this.value;
            document.getElementById('nota-label').textContent = this.value;
        });
    });
</script>

<style>
    .titulopagina {
        color: #e2b96f;
        letter-spacing: 0.05em;
    }

    /* ── Botão voltar ── */
    .btn-light.border {
        background: #1e1e35;
        border-color: #2a2a45 !important;
        color: #9090aa;
    }
    .btn-light.border:hover {
        background: #2a2a45;
        color: #e0e0e0;
    }

    /* ── Formcard ── */
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

    /* ── Inputs ── */
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
    .notatexto { color: #9090aa; font-size: 0.82rem; }

    /* ── Botões ── */
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

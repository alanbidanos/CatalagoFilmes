@extends('main')
@section('titulo', 'Avaliações')
@section('conteudo')

<div class="d-flex justify-content-center align-items-center mb-3">
    <h4 class="mb-0 titulopagina">Avaliações</h4>
</div>

<div class="barrapesquisa mb-4">
    <div class="py-3">
        <form action="{{ route('avaliacoes.search') }}" method="post">
            @csrf
            <div class="row g-2 align-items-end">
                <div class="col-md-3">
                    <label class="form-label mb-1">Tipo</label>
                    <select name="tipo" class="form-select form-select-sm campoinput">
                        <option value="usuario">Usuário</option>
                        <option value="filmes_id">Filme</option>
                        <option value="comentario">Comentário</option>
                        <option value="nota">Nota</option>
                    </select>
                </div>
                <div class="col-md-4">
                    <label class="form-label mb-1">Valor</label>
                    <input type="text" class="form-control form-control-sm campoinput" name="valor" placeholder="Pesquisar...">
                </div>
                <div class="col-auto">
                    <button type="submit" class="btn btnbuscar btn-sm">Buscar</button>
                </div>
                <div class="col-auto">
                    <a href="{{ url('avaliacoes/create') }}" class="btn btnnovo btn-sm">＋ Nova Avaliação</a>
                </div>
            </div>
        </form>
    </div>
</div>


<div class="d-flex flex-column gap-3">
    @foreach ($dados as $item)
        @php
            $inicial = strtoupper(substr($item->usuario, 0, 1));
            $nota = (int) $item->nota;
        @endphp

        <div class="cardavaliacao">


            <div class="d-flex align-items-center gap-3 mb-3">
                <div class="avatar">{{ $inicial }}</div>
                <div class="flex-fill">
                    <div class="avausuario">{{ $item->usuario }}</div>
                    <div class="avafilme">{{ $item->filme->nome ?? '—' }}</div>
                </div>


                <div class="avanota">
                    @for ($i = 1; $i <= 5; $i++)
                        <span class="{{ $i <= $nota ? 'estrelaon' : 'estrelaoff' }}">★</span>
                    @endfor
                    <span class="notanumero">{{ $nota }}/5</span>
                </div>
            </div>

            <p class="avacomentario">{{ $item->comentario }}</p>

            <div class="avaacoes">
                <a href="{{ route('avaliacoes.edit', $item->id) }}" class="btn btneditar btn-sm">Editar</a>
                <form action="{{ route('avaliacoes.destroy', $item->id) }}" method="post">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btndeletar btn-sm"
                        onclick="return confirm('Deseja remover o registro?')">
                        Deletar
                    </button>
                </form>
            </div>

        </div>
    @endforeach
</div>

<style>


    .cardavaliacao {
        background: #1a1a2e;
        border: 1px solid #2a2a45;
        border-radius: 14px;
        padding: 1.25rem 1.5rem;
        box-shadow: 0 2px 16px rgba(0,0,0,0.35);
        transition: border-color 0.18s, box-shadow 0.18s;
    }
    .cardavaliacao:hover {
        border-color: #e2b96f;
        box-shadow: 0 4px 24px rgba(226,185,111,0.12);
    }
    .avatar {
        width: 46px;
        height: 46px;
        border-radius: 50%;
        background: #e2b96f;
        color: #1a1a2e;
        font-weight: 800;
        font-size: 1.1rem;
        display: flex;
        align-items: center;
        justify-content: center;
        flex-shrink: 0;
    }
    .avausuario {
        font-weight: 700;
        color: #e2b96f;
        font-size: 0.95rem;
    }
    .avafilme {
        font-size: 0.78rem;
        color: #9090aa;
        font-style: italic;
    }
    .avanota {
        display: flex;
        align-items: center;
        gap: 2px;
        flex-shrink: 0;
    }
    .estrelaon  { color: #e2b96f; font-size: 1rem; }
    .estrelaoff { color: #2a2a45; font-size: 1rem; }
    .notanumero {
        font-size: 0.75rem;
        color: #9090aa;
        margin-left: 4px;
    }
    .avacomentario {
        color: #c8c8d8;
        font-size: 0.92rem;
        line-height: 1.6;
        margin-bottom: 1rem;
        padding-left: 0.25rem;
        border-left: 3px solid #2a2a45;
        padding-left: 0.75rem;
    }
    .avaacoes {
        display: flex;
        gap: 0.5rem;
    }
    .btneditar {
        background: #e2b96f; border-color: #e2b96f;
        color: #1a1a2e; font-weight: 600;
    }
    .btneditar:hover { background: #f0d090; border-color: #f0d090; color: #1a1a2e; }
    .btndeletar {
        background: transparent; border: 1px solid #c0392b;
        color: #c0392b; font-weight: 600;
    }
    .btndeletar:hover { background: #c0392b; color: #fff; }
</style>

@stop

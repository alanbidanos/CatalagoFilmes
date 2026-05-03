@extends('main')
@section('titulo', 'Premiações')
@section('conteudo')



<div class="d-flex justify-content-center align-items-center mb-3 titulopagina">
    <h4 class="mb-0 ">Premiações</h4>
</div>

<div class="barrapesquisa mb-4">
    <div class="cardbody py-3">
        <form action="{{ route('premiacoes.search') }}" method="post">
            @csrf
            <div class="row g-2 align-items-end">
                <div class="col-md-3">
                    <label class="form-label mb-1">Tipo</label>
                    <select name="tipo" class="form-select form-select-sm campoinput">
                        <option value="nome">Nome</option>
                        <option value="filmes_id">Filme Premiado</option>
                        <option value="ano">Ano da premiação</option>
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
                    <a href="{{ url('premiacoes/create') }}" class="btn btnnovo btn-sm">＋ Nova Premiação</a>
                </div>
            </div>
        </form>
    </div>
</div>

<div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 row-cols-xl-4 g-4">
    @foreach ($dados as $item)

        <div class="col">
            <div class="cardfilme card">
                <div class="cardbody">
                    <div class="d-flex justify-content-between align-items-start mb-1">
                        <h6 class="cardtitulo mb-0" title="{{ $item->nome }}">{{ $item->nome }}</h6>
                    </div>

                    <p class="premdado mb-0">
                        Filme premiado: <span>{{ $item->filme->nome ?? '—' }}</span>
                    </p>
                    <p class="premdado mb-1">
                        Ano da premiação: <span>{{ $item->ano }}</span>
                        &nbsp;·&nbsp;
                    </p>


                    <div class="cardacao">
                        <a href="{{ route('premiacoes.edit', $item->id) }}" class="btn btn-warning btn-sm">Editar</a>

                        <form action="{{ route('premiacoes.destroy', $item->id) }}" method="post" class="flex-fill">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm w-100"
                                onclick="return confirm('Deseja remover o registro?')">
                                Deletar
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    @endforeach
</div>




<style>

    .cardfilme {
        border: 1px solid #2a2a45 !important;
        border-radius: 12px;
        overflow: hidden;
        box-shadow: 0 2px 16px rgba(0,0,0,0.4);
        transition: transform 0.18s, box-shadow 0.18s, border-color 0.18s;
        background: #1a1a2e;
        height: 100%;
        display: flex;
    flex-direction: column;
    }
    .cardfilme:hover {
        transform: translateY(-4px);
        box-shadow: 0 8px 32px rgba(226,185,111,0.15);
        border-color: #e2b96f !important;
    }
    .cardfilme img {
        object-fit: cover;
        border-radius: 0;
    }
    .cardfilme .cardbody {
        padding: 1rem;
        margin-top: auto;
    }
    .cardfilme .cardtitulo {
        font-size: 1rem;
        font-weight: 700;
        margin-bottom: 0.4rem;
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
        color: #e2b96f;
    }

.cardimgbox {
    height: 420px;
    display: flex;
    align-items: center;
    justify-content: center;
    background: #12121f;
    overflow: hidden;
}
.cardimgbox img {
    max-height: 100%;
    max-width: 100%;
    object-fit: contain;
}
    .premdado {
        font-size: 0.82rem;
        font-style: italic;
        color: #9090aa;
        margin-bottom: 0.2rem;
    }
    .premdado span {
        font-weight: bold;
        color: #e2b96f;
    }
    .cardacao {
        display: flex;
        gap: 0.5rem;
        margin-top: 0.75rem;
    }
    .cardacao .btn {
        flex: 1;
        font-size: 0.82rem;
        padding: 0.35rem 0.5rem;
    }


</style>


@stop

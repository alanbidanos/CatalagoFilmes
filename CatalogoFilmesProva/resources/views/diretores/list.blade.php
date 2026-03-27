@extends('main')
@section('titulo', 'Diretores')
@section('conteudo')

    <div class="titulopagina d-flex justify-content-center align-items-center mb-3">
        <h4 class="mb-0">Diretores</h4>
    </div>

  <div class="barrapesquisa mb-4">
    <div class="cardbody py-3">
        <form action="{{ route('diretores.search') }}" method="post">
            @csrf
            <div class="row g-2 align-items-end">
                <div class="col-md-3">
                    <label class="form-label mb-1">Tipo</label>
                    <select name="tipo" class="form-select form-select-sm campoinput">
                        <option value="nome">Nome</option>
                        <option value="idade">Idade</option>
                        <option value="pais">País de origem</option>
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
                    <a href="{{ url('diretores/create') }}" class="btn btnnovo btn-sm">＋ Novo Diretor</a>
                </div>
            </div>
        </form>
    </div>
</div>

    <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 row-cols-xl-4 g-4">
        @foreach ($dados as $item)
            @php
                $nome_foto = !empty($item->foto) ? $item->foto : '\imagem\diretores\sem-imagem.jpeg';
            @endphp

            <div class="col">
                <div class="carddiretor card">
                    <img src="/storage/{{ $nome_foto }}" alt="{{ $item->nome }}">

                    <div class="cardbody">
                        <div class="d-flex justify-content-between align-items-start mb-1">
                            <h6 class="cardtitulo mb-0" title="{{ $item->nome }}">{{ $item->nome }}</h6>

                        </div>

                        <p class="diretordado mb-1">
                            Nascimento: <span>{{ \Carbon\Carbon::parse($item->nascimento)->format('d/m/Y') }}</span>
                        </p>

                        <p class="diretordado mb-1 ">
                            Idade: <span>{{ $item->idade }}</span>
                        </p>

                        <p class="diretordado mb-0">
                            País: <span>{{ $item->pais }}</span>
                        </p>

                        <div class="cardacao">
                            <a href="{{ route('diretores.edit', $item->id) }}" class="btn btn-warning btn-sm">Editar</a>

                            <form action="{{ route('diretores.destroy', $item->id) }}" method="post" class="flex-fill">
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
        .carddiretor {
            border: none;
            border-radius: 12px;
            overflow: hidden;
            box-shadow: 0 2px 12px rgba(0, 0, 0, 0.10);
            transition: transform 0.18s, box-shadow 0.18s;
            background: #2a1f1f;
            color: #e8d5c4;
            height: 100%;
        }

        .carddiretor:hover {
            transform: translateY(-4px);
            box-shadow: 0 8px 24px rgba(0, 0, 0, 0.15);
        }

        .carddiretor img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            object-position: top;
            border-radius: 0;
        }

        .carddiretor .cardbody {
            padding: 1rem;
        }

        .carddiretor .cardtitulo {
            font-size: 1rem;
            font-weight: 700;
            margin-bottom: 0.4rem;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
            color: #f0c080;
        }

        .diretordado {
            font-size: 0.82rem;
            font-style: italic;
            color: #b89a85;
            margin-bottom: 0.2rem;
        }

        .diretordado span {
            font-weight: bold;
            color: #f0c080;
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

        .idadecor {
            background: #c0392b;
            color: #fff;
            font-weight: 700;
            font-size: 0.75rem;
            padding: 0.3em 0.65em;
            border-radius: 20px;
        }

        body {
        background-color: #352525;
    }
    </style>

@stop

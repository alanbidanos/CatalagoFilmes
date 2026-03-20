@extends('main')
@section('titulo', 'Listagem de Filmes')
@section('conteudo')

    <h4>Listagem de Filmes</h4>

    <div class="row">
        <div class="col">
            <form action="{{ route('filmes.search') }}" method="post">
                @csrf
                <div class="row">

                    <div class="col-md-3">
                        <label class="form-label">Tipo</label>
                        <select name="tipo" class="form-select">
                            <option value="nome">Nome</option>
                            <option value="ano">Ano</option>
                            <option value="duracao">Duração</option>
                            <option value="nota">Nota</option>
                            <option value="genero">Gênero</option>
                            <option value="diretores_id">Diretor</option>
                        </select>
                    </div>
                    <div class="col-md-3">
                        <label class="form-label">Valor</label>
                        <input type="text" class="form-control" name="valor" placeholder="Pesquisar...">
                    </div>
                    <div class="col-md-3">
                        <button type="submit" class="btn btn-primary"> Buscar</button>
                    </div>
                    <div class="col-md-3">
                        <a href="{{ url('filmes/create') }}" class="btn btn-success"> Novo</a>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <div class="row">
        <div class="col">
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Nome</th>
                        <th scope="col">Capa</th>
                        <th scope="col">Ano</th>
                        <th scope="col">Duração</th>
                        <th scope="col">Nota</th>
                        <th scope="col">Gênero</th>
                        <th scope="col">Diretor</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($dados as $item)
                        @php
                            $nome_foto = !empty($item->capa) ? $item->capa : 'sem_imagem.jpeg';
                        @endphp

                        <tr>
                            <th scope="row">{{ $item->id }}</th>
                            <td>{{ $item->nome }}</td>
                            <td> <img src="/storage/{{ $nome_foto }}" class="rounded-circle" width="150px"
                                    height="150px" alt="foto">
                            </td>
                            <td>{{ $item->ano }}</td>
                            <td>{{ $item->duracao }}</td>
                            <td>{{ $item->nota }}</td>
                            <td>{{ $item->genero }}</td>
                            <td>{{ $item->diretor->nome ?? '' }}</td>
                            <td><a href="{{ route('filmes.edit', $item->id) }}" class="btn btn-warning">Editar</a></td>
                            <td>
                                <form action="{{ route('filmes.destroy', $item->id) }}" method="post">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger"
                                        onclick="return confirm('Deseja remover o registro?')">
                                        Deletar</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>


@stop

@extends('main')
@section('titulo', 'Listagem de diretores')
@section('conteudo')

    <h4>Listagem de Diretores</h4>

    <div class="row">
        <div class="col">
            <form action="{{ route('diretores.search') }}" method="post">
                @csrf
                <div class="row">

                    <div class="col-md-3">
                        <label class="form-label">Tipo</label>
                        <select name="tipo" class="form-select">
                            <option value="nome">Nome</option>
                            <option value="idade">idade</option>
                            <option value="pais">País de origem</option>
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
                        <a href="{{ url('diretores/create') }}" class="btn btn-success"> Novo</a>
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
                        <th scope="col">Foto</th>
                        <th scope="col">Nascimento</th>
                        <th scope="col">Idade</th>
                        <th scope="col">País de Origem</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($dados as $item)
                        @php
                            $nome_foto = !empty($item->foto) ? $item->foto : '\imagem\diretores\sem-imagem.jpeg';
                        @endphp

                        <tr>
                            <th scope="row">{{ $item->id }}</th>
                            <td>{{ $item->nome }}</td>
                            <td> <img src="/storage/{{ $nome_foto }}" class="rounded-circle" width="150px"
                                    height="150px" alt="foto">
                            </td>
                            <td>{{ $item->nascimento }}</td>
                            <td>{{ $item->idade }}</td>
                            <td>{{ $item->pais }}</td>
                            <td><a href="{{ route('diretores.edit', $item->id) }}" class="btn btn-warning">Editar</a></td>
                            <td>
                                <form action="{{ route('diretores.destroy', $item->id) }}" method="post">
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

@extends('main')
@section('titulo', 'Listagem de avaliações')
@section('conteudo')

    <h4>Listagem de Avaliações</h4>

    <div class="row">
        <div class="col">
            <form action="{{ route('avaliacoes.search') }}" method="post">
                @csrf
                <div class="row">

                    <div class="col-md-3">
                        <label class="form-label">Tipo</label>
                        <select name="tipo" class="form-select">
                            <option value="usuario">Usuário</option>
                            <option value="filme_id">Filme</option>
                            <option value="comentario">Comentário</option>
                            <option value="nota">nota</option>
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
                        <a href="{{ url('avaliacoes/create') }}" class="btn btn-success"> Novo</a>
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
                        <th scope="col">Usuário</th>
                        <th scope="col">Filme</th>
                        <th scope="col">Comentário</th>
                        <th scope="col">Nota</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($dados as $item)
                        <tr>
                            <th scope="row">{{ $item->id }}</th>
                            <td>{{ $item->usuario }}</td>
                            <td>{{ $item->filme->nome ?? '' }}</td>
                            <td>{{ $item->comentario }}</td>
                            <td>{{ $item->nota }}</td>
                            <td><a href="{{ route('avaliacoes.edit', $item->id) }}" class="btn btn-warning">Editar</a></td>
                            <td>
                                <form action="{{ route('avaliacoes.destroy', $item->id) }}" method="post">
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

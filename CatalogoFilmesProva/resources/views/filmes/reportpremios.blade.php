<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>

<body>
<div>

        <h3>{{ $titulo }}</h2>

    <div class="containter">
        <table class="table table-hover">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Filme</th>
                    <th scope="col">Ano</th>
                    <th scope="col">Duração</th>
                    <th scope="col">Nota</th>
                    <th scope="col">Prêmio</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($filmes as $item)
                    <tr>
                        <td scope="row">{{ $loop->iteration }}º</td>
                        <td>{{ $item->nome }}</td>
                        <td>{{ $item->ano }}</td>
                        <td>{{ $item->duracao }} min</td>
                        <td>{{ $item->nota }}</td>
                        <td>
                            @if ($item->premiacao)
                                <span>{{ $item->premiacao->nome }}</span>
                            @else
                                <span>Sem prêmio</span>
                            @endif
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>


        <p>Total de filmes: {{ $filmes->count() }}</p>


</div>
</body>
</html>

<style>
    table, td, th {
        border-bottom: 1px solid black;
        border-top: 1px solid black;
        text-align: center;
        border-collapse: collapse;
        padding: 5px;
    }

</style>

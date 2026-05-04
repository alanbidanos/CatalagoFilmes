<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>

<body>

    <h3>{{ $titulo }}</h3>
<div class="container">
    <table class="table table-hover">
        <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">id</th>
                <th scope="col">Nome  </th>
                <th scope="col">Ano  </th>
                <th scope="col">Duração  </th>
                <th scope="col">Nota  </th>
            </tr>
        </thead>
        <tbody>
            @foreach ($filmes as $item)
                <tr>
                    <th scope="row">{{ $loop->iteration .'º' }}</th>
                    <th scope="row">{{ $item->id }}</th>
                    <td>{{ $item->nome }}</td>
                    <td>{{ $item->ano }}</td>
                    <td>{{ $item->duracao }}</td>
                    <td>{{ $item->nota }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
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
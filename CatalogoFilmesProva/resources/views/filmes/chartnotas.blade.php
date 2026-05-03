@extends('main')
@section('titulo', 'Distribuição de Notas')
@section('conteudo')

<h4 class="titulopagina mb-4">Distribuição de Notas</h4>

<div class="container px-4 mx-auto">

        <div class="p-6 m-20 bg-white rounded shadow">
            {!! $chart->container() !!}
        </div>

    </div>

    <script src="{{ $chart->cdn() }}"></script>

    {{ $chart->script() }}

@stop


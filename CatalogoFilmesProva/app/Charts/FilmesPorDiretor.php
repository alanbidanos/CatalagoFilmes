<?php

namespace App\Charts;

use ArielMejiaDev\LarapexCharts\LarapexChart;
use Illuminate\Support\Facades\DB;

class FilmesPorDiretor
{
    protected $chart;

    public function __construct(LarapexChart $chart)
    {
        $this->chart = $chart;
    }

    public function build(): \ArielMejiaDev\LarapexCharts\BarChart
    {

        $filmesPorDiretor = DB::table('filmes')
            ->join('diretores', 'diretores.id', '=', 'filmes.diretores_id')
            ->select('diretores.nome', DB::raw('count(1) as qtd_filmes'))
            ->groupBy('diretores.nome')
            ->orderBy('qtd_filmes', 'desc')
            ->get();

        $qtdFilmes = [];
        $nomeDiretores = [];

        foreach ($filmesPorDiretor as $item) {
            $qtdFilmes[] = $item->qtd_filmes;
            $nomeDiretores[] = $item->nome;
        }

        return $this->chart->barChart()
            ->setTitle('Quantidade de Filmes por Diretor')
            ->setSubtitle('')
            ->addData($qtdFilmes)
            ->setLabels($nomeDiretores);
    }
}

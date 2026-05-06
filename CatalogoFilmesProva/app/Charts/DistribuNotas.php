<?php

namespace App\Charts;

use ArielMejiaDev\LarapexCharts\LarapexChart;
use Illuminate\Support\Facades\DB;

class DistribuNotas
{
    protected $chart;

    public function __construct(LarapexChart $chart)
    {
        $this->chart = $chart;
    }

    public function build(): \ArielMejiaDev\LarapexCharts\PieChart
    {

        $distribuicao = DB::table('filmes')
    ->select('nota', DB::raw('count(1) as qtd'))
    ->groupBy('nota')
    ->orderBy('nota', 'asc')
    ->get();

        $quantidades = [];
        $faixas = [];

        foreach ($distribuicao as $item) {
            $quantidades[] = $item->qtd;
            $faixas[] = 'Nº de filmes com a nota ' . $item->nota;
        }

        return $this->chart->pieChart()
            ->setTitle('Distribuição de Notas')
            ->setSubtitle('números de filmes com certa nota')
            ->addData($quantidades)
            ->setLabels($faixas);
    }
}

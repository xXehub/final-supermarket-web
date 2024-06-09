<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;

use App\Models\Produk;
use ConsoleTVs\Charts\Commands\ChartsCommand;

class ChartController extends Controller
{
    public function produkAdditionChart()
    {
        // Misalnya, Anda ingin mengambil produk yang ditambahkan dalam 30 hari terakhir
        $produk = Produk::whereDate('created_at', '>', now()->subDays(30))->get();

        $chart = ChartsCommand::database($produk, 'line', 'highcharts')
            ->title('Penambahan Produk')
            ->elementLabel('Jumlah Produk')
            ->dimensions(500, 300)
            ->responsive(true)
            ->groupByDate();

        return view('chart', ['chart' => $chart]);
    }
}
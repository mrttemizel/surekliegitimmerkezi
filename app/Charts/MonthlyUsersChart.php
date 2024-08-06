<?php

namespace App\Charts;

use App\Models\Application;
use ArielMejiaDev\LarapexCharts\LarapexChart;

class MonthlyUsersChart
{
    protected $chart;

    public function __construct(LarapexChart $chart)
    {
        $this->chart = $chart;
    }

    public function build(): \ArielMejiaDev\LarapexCharts\HorizontalBar
    {
        return $this->chart->horizontalBarChart()
            ->setColors(['#FFC107', '#D32F2F'])
            ->addData('Toplam Sayı:',
                [
                    Application::all()->count(),
                    Application::all()->where('basvuru_durumu','=',0)->count(),
                    Application::all()->where('basvuru_durumu','=',1)->count(),
                    Application::all()->where('basvuru_durumu','=',2)->count(),
                ])
            ->setXAxis(['Toplam Başvuru Sayısı', 'İnceleme Olan Başvuru Sayısı', 'Onaylanan Başvuru Sayısı', 'Reddedilen Başvuru Sayısı',]);
    }
}

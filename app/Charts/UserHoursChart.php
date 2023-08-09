<?php

namespace App\Charts;

use ArielMejiaDev\LarapexCharts\LarapexChart;

class UserHoursChart
{
    protected $chart;

    public function __construct(LarapexChart $chart)
    {
        $this->chart = $chart;
    }

    public function build($data, $type): \ArielMejiaDev\LarapexCharts\BarChart
    {
        $chart = $this->chart->barChart()
        ->setTitle('Hours Chart')
        ->setSubtitle($type);

        if($data->count() > 0) {
            $hours = [];
            $dates = [];
            foreach($data as $d) {
                $start = new \DateTime($d->start_time);
                $end = new \DateTime($d->end_time);
                $diff = $start->diff($end);
                $hours[] = $diff->h;
                $dates[] = \Carbon\Carbon::parse($d->work_date)->format('d-m-Y');
            }
            $chart->addData('User Hours', $hours)
            ->setXAxis($dates);
        } else {
            $chart->addData()
            ->setXAxis();
        }
        

        return $chart;
    }
}

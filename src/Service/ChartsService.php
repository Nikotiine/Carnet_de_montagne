<?php

namespace App\Service;

use Symfony\UX\Chartjs\Builder\ChartBuilderInterface;
use Symfony\UX\Chartjs\Model\Chart;

class ChartsService
{
    private ChartBuilderInterface $chartBuilder;

    /**
     * @param ChartBuilderInterface $chartBuilder
     */
    public function __construct(ChartBuilderInterface $chartBuilder)
    {
        $this->chartBuilder = $chartBuilder;
    }

    public function barChart(
        string $title,
        array $labels,
        array $data,
        array $colors,
        int $suggestedMax
    ): Chart {
        $chart = $this->chartBuilder->createChart(Chart::TYPE_BAR);
        return $this->settings(
            $chart,
            $title,
            $labels,
            $data,
            $colors,
            $suggestedMax
        );
    }

    public function doughnutChart(
        string $title,
        array $labels,
        array $data,
        array $colors,
        int $suggestedMax
    ): Chart {
        $chart = $this->chartBuilder->createChart(Chart::TYPE_DOUGHNUT);
        return $this->settings(
            $chart,
            $title,
            $labels,
            $data,
            $colors,
            $suggestedMax
        );
    }

    public function pieChart(
        string $title,
        array $labels,
        array $data,
        array $colors,
        int $suggestedMax
    ): Chart {
        $chart = $this->chartBuilder->createChart(Chart::TYPE_PIE);
        return $this->settings(
            $chart,
            $title,
            $labels,
            $data,
            $colors,
            $suggestedMax
        );
    }

    private function settings(
        Chart $chart,
        string $title,
        array $labels,
        array $data,
        array $colors,
        int $suggestedMax
    ): Chart {
        return $chart
            ->setData([
                "labels" => $labels,
                "datasets" => [
                    [
                        "label" => "Sorties realisée",
                        "backgroundColor" => $colors,
                        "borderColor" => "#eee",
                        "data" => $data,
                    ],
                ],
            ])
            ->setOptions([
                "scales" => [
                    "y" => [
                        "suggestedMin" => 0,
                        "suggestedMax" => $suggestedMax + 5,
                    ],
                ],
                "plugins" => [
                    "legend" => [
                        "display" => true,
                        "position" => "bottom",
                    ],
                    "title" => [
                        "text" => $title,
                        "display" => true,
                        "position" => "top",
                        "font" => [
                            "size" => 14,
                        ],
                    ],
                ],
            ]);
    }
}

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

    public function createBarCharts(
        array $labels,
        array $data,
        array $colors,
        int $suggestedMax
    ): Chart {
        return $this->chartBuilder
            ->createChart(Chart::TYPE_BAR)
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
            ]);
    }
    public function createDoughnutCharts(
        string $title,
        array $labels,
        array $data,
        array $colors,
        int $suggestedMax
    ): Chart {
        return $this->chartBuilder
            ->createChart(Chart::TYPE_DOUGHNUT)
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

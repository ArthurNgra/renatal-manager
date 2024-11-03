<?php

namespace App\Nova\Dashboards;

use App\Models\Facture;
use App\Nova\Metrics\FacturesOuvertes;
use App\Nova\Metrics\Reduction;
use App\Nova\Metrics\Revenus;
use Archi\FactureOuverte\FactureOuverte;
use Coroowicaksono\ChartJsIntegration\BarChart;
use Coroowicaksono\ChartJsIntegration\StackedChart;
use Laravel\Nova\Dashboards\Main as Dashboard;

class Main extends Dashboard
{
    /**
     * Get the cards for the dashboard.
     *
     * @return array
     */
    public function name(): string
    {
        return 'Dashboard';
    }

    public function cards()
    {
        $totalsWithoutReduction = Facture::getMonthlyTotalWithoutReduction();
        $totalsWithReduction = Facture::getMonthlyTotalWithReduction();

        // Extraire les catégories (les mois)
        $categories = array_keys($totalsWithoutReduction);

        // Extraire les données des totaux
        $dataWithoutReduction = array_values($totalsWithoutReduction);
        $dataWithReduction = array_values($totalsWithReduction);
        return [
            new FacturesOuvertes(),
            new Revenus(),
            new Reduction(),
            (new BarChart())

                ->title('Revenue sur les 12 derniers mois')
                ->animations([
                    'enabled' => true,
                    'easing' => 'easeinout',
                ])
                ->series(array([
                    'barPercentage' => 0.3,
                    'label' => 'Sans réduction',
                    'backgroundColor' => '#ffcc5c',
                    'data' => $dataWithoutReduction,
                ], [
                    'barPercentage' => 0.3,
                    'label' => 'Avec réduction',
                    'backgroundColor' => '#ff6f69',
                    'data' => $dataWithReduction,
                ]))
                ->options([
                    'xaxis' => [
                        'categories' => $categories, // Les mois
                    ],

                ])
            ->height(1/2),

        ];
    }
}

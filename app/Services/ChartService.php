<?php

namespace App\Services;

use App\Models\MaterialModel;
use Coroowicaksono\ChartJsIntegration\PieChart;
use Illuminate\Support\Facades\DB;

class ChartService
{
    public function __construct()
    {
    }

    public static function pieChartMostRentedMaterials()
    {
        // Retrieve the most rented materials with their rental counts
        $materials = MaterialModel::select('model', DB::raw('COUNT(material_rental.rental_id) as rentals_count'))
            ->join('material_rental', 'materials.id', '=', 'material_rental.material_id')
            ->groupBy('model')  // Grouper par nom de modèle
            ->orderBy('rentals_count', 'desc')  // Trier par le total des locations décroissant
            ->take(8)  // Limiter aux 8 modèles les plus loués
            ->get();

        // Prepare data for the pie chart
        // Préparer les données pour le graphique en camembert
        $data = $materials->pluck('rentals_count')->toArray(); // Total de locations pour chaque modèle
        $labels = $materials->pluck('model')->toArray(); // Nom du modèle de matériel

        return (new PieChart())
            ->title('Matériaux les plus loués')
            ->series([
                [
                    'data' => $data,
                    'backgroundColor' => ["#ffcc5c", "#91e8e1", "#ff6f69", "#88d8b0", "#b088d8", "#d8b088", "#88b0d8", "#6f69ff"],
                ]
            ])
            ->options([
                'xaxis' => [
                    'categories' => $labels  // Set categories dynamically based on material names
                ],
            ])
            ->width('1/2');
    }
}

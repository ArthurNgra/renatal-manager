<?php

namespace App\Services;

use App\Models\ClientModel;
use App\Models\Devis;
use App\Models\Facture;

class InvoiceService
{

    protected Facture $facture;

    public function __construct(Facture $facture)
    {
        $this->facture = $facture;
    }
    public static function getMonthlyTotalWithReduction(): array
    {
        // Initialiser le tableau pour stocker les totaux mensuels
        $monthlyTotals = [];

        // Obtenir la date actuelle
        $now = now();

        // Boucler sur les 12 derniers mois
        for ($i = 0; $i < 12; $i++) {
            // Déterminer le premier et dernier jour du mois
            $startOfMonth = $now->copy()->subMonths($i)->startOfMonth();
            $endOfMonth = $now->copy()->subMonths($i)->endOfMonth();


            // Récupérer les factures du mois en cours
            $factures = Facture::whereBetween('due_date', [$startOfMonth, $endOfMonth])
                ->get();

            // Calculer la somme des totaux avec réduction pour ce mois
            $total = 0;
            foreach ($factures as $facture) {
                if ($facture->status == 'Payé') {
                    $total += $facture->getTotalWithReduction();
                } // Utilisation de la méthode getTotalWithReduction()
            }

            // Ajouter le total dans le tableau avec le mois
            $monthlyTotals[$startOfMonth->format('Y-m')] = $total;
        }

        return $monthlyTotals;
    }

    public function getTotalWithReduction(): float
    {
        return $this->facture->devis->getFinalAmountAttribute();
    }

    public static function getMonthlyTotalWithoutReduction(): array
    {
        // Initialiser le tableau pour stocker les totaux mensuels
        $monthlyTotals = [];

        // Obtenir la date actuelle
        $now = now();

        // Boucler sur les 12 derniers mois
        for ($i = 0; $i < 12; $i++) {
            // Déterminer le premier et dernier jour du mois
            $startOfMonth = $now->copy()->subMonths($i)->startOfMonth();
            $endOfMonth = $now->copy()->subMonths($i)->endOfMonth();

            // Récupérer les factures du mois en cours
            $factures = Facture::whereBetween('due_date', [$startOfMonth, $endOfMonth])->get();

            // Calculer la somme des totaux sans réduction pour ce mois
            $total = 0;
            foreach ($factures as $facture) {
                if ($facture->status == 'Payé') {
                    $total += $facture->getTotal();
                } // Utilisation de la méthode getTotal()
            }

            // Ajouter le total dans le tableau avec le mois
            $monthlyTotals[$startOfMonth->format('Y-m')] = $total;
        }

        return $monthlyTotals;
    }

    public static function getTotalLast12MonthsWithReduction(): float
    {
        $startOfMonth = now()->endOfMonth();
        $endOfMonth = now()->copy()->subMonths(12)->startOfMonth();


        $factures = Facture::all()->filter(function ($fact) use ($startOfMonth, $endOfMonth) {
            return $fact->whereDate('due_date', '>=', $startOfMonth)
                ->whereDate('due_date', '<=', $endOfMonth);
        });
        // Calculer la somme des totaux avec réduction
        $total = 0;
        foreach ($factures as $facture) {
            if ($facture->status == 'Payé') {
                $total += $facture->getTotalWithReduction();
            }// Utilisation de la méthode getTotalWithReduction()
        }

        return $total;
    }

    public static function getYearlyDiscount()
    {

        return self::getTotalLast12MonthsWithoutReduction() - (self::getTotalLast12MonthsWithReduction());
    }

    public static function getTotalLast12MonthsWithoutReduction(): float
    {


        // Obtenir la date actuelle
        $startOfMonth = now()->endOfMonth();
        $endOfMonth = now()->copy()->subMonths(12)->startOfMonth();

        // Récupérer les factures du mois en cours
        $factures = Facture::all()->filter(function ($fact) use ($startOfMonth, $endOfMonth) {
            return $fact->whereDate('due_date', '>=', $startOfMonth)
                ->whereDate('due_date', '<=', $endOfMonth);
        });

        // Calculer la somme des totaux sans réduction
        $total = 0;
        foreach ($factures as $facture) {
            if ($facture->status == 'Payé') {
                $total += $facture->getTotal();
            }
        }

        return $total;
    }

    public function getClientAttribute()
    {
        return ClientModel::find($this->facture->client_id);
    }

    public function getTotal(): float
    {
        return $this->facture->devis->getAmountAttribute();
    }

    public function updateStatus(string $status)
    {
        switch ($status) {
            case 'P':
                    $status='payé';
                    break;
            case 'U':
                $status='impayé';
                break;
        }

        $this->facture->update(['status' => $status]);

    }
}

<?php

namespace App\Models;

use Error;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Str;
use function dd;
use function now;

class Facture extends Model
{

    protected $keyType = 'string';

    public $incrementing = false;
    public function devis(): BelongsTo
    {
        return $this->belongsTo(Devis::class);
    }
    public function devisClient()
    {
        return $this->hasMany(Devis::class, 'client_id', 'client_id');
    }
    public static function boot() {
        parent::boot();

        static::creating(function ($model) {
            if(Devis::find($model->devis_id)->status!='valider'){
                throw new Error('Le devis n est pas valider par le client');
            }

            $model->status = 'Ouverte';

            $model->client_id=Devis::find($model->devis_id)->rental->client->id;
        });
    }
    public $timestamps = false;

    protected $fillable = [
        'devis_id',
        'status',
        'due_date',
    ];



    protected $casts = [
        'due_date' => 'date',
    ];

    public function getTotal():float
    {

        return $this->devis->getAmountAttribute();
    }

    public function getTotalWithReduction():float
    {
        return $this->devis->getFinalAmountAttribute();
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
            if( $facture->status == 'Payé') {
                $total += $facture->getTotalWithReduction();
            }// Utilisation de la méthode getTotalWithReduction()
        }

        return $total;
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
            $factures = self::whereBetween('due_date', [$startOfMonth, $endOfMonth])->get();

            // Calculer la somme des totaux sans réduction pour ce mois
            $total = 0;
            foreach ($factures as $facture) {
                if( $facture->status == 'Payé') {
                    $total += $facture->getTotal();
                } // Utilisation de la méthode getTotal()
            }

            // Ajouter le total dans le tableau avec le mois
            $monthlyTotals[$startOfMonth->format('Y-m')] = $total;
        }

        return $monthlyTotals;
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
            $factures = self::whereBetween('due_date', [$startOfMonth, $endOfMonth])
                ->get();

            // Calculer la somme des totaux avec réduction pour ce mois
            $total = 0;
            foreach ($factures as $facture) {
                if( $facture->status == 'Payé') {
                    $total += $facture->getTotalWithReduction();
                } // Utilisation de la méthode getTotalWithReduction()
            }

            // Ajouter le total dans le tableau avec le mois
            $monthlyTotals[$startOfMonth->format('Y-m')] = $total;
        }

        return $monthlyTotals;
    }
    public static function getYearlyDiscount()
    {

        return Facture::getTotalLast12MonthsWithoutReduction()-(Facture::getTotalLast12MonthsWithReduction());
    }

}

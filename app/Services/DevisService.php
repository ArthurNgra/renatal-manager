<?php

namespace App\Services;

use App\Models\Devis;

class DevisService
{


    protected  Devis $devis;
    public function __construct( Devis $devis)
    {
    $this->devis = $devis;
    }

    public function getAmountAttribute(): float
    {
        return $this->devis->rental->materials->sum('price') + $this->devis->prestations()->sum('price');
    }

    public function getAmountTtc(): float
    {
        $materials = $this->devis->rental->materials->sum(function($material){
            $material->price * $this->devis->client()->invoicespec->tva;
        });

        return 0;
    }

    public function getFinalAmountAttribute(): float
    {
        $total = $this->devis->amount;
        foreach ($this->devis->reductions as $reduction) {
            if ($reduction->type === '%') {
                $total -= ($total * $reduction->valeur) / 100;
            } elseif ($reduction->type === '€') {
                $total -= $reduction->valeur;
            }
        }
        return max($total, 0);
    }

    public function getFinalAmountTtcAttribute(): float
    {
        $total = $this->getAmountTtc();
        foreach ($this->devis->reductions as $reduction) {
            if ($reduction->type === '%') {
                $total -= ($total * $reduction->valeur) / 100;
            } elseif ($reduction->type === '€') {
                $total -= $reduction->valeur;
            }
        }
        return max($total, 0);
    }
}

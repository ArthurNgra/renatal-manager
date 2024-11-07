<?php

namespace App\Services;

use App\Models\ClientModel;
use App\Models\Devis;
use App\Models\InvoiceSpec;
use App\Models\Spec;


class DevisService
{


    protected Devis $devis;

    public function __construct(Devis $devis)
    {
        $this->devis = $devis;
    }

    public function getAmountAttribute(): float
    {

        return $this->devis->rental->materials->sum('price') + $this->devis->prestations()->sum('price');
    }

    public function getAmountTtc()
    {
        return ($this->getTva()*$this->getAmountAttribute())/100+$this->getFinalAmountAttribute() ;


    }

    public function getTva()
    {
        $client = ClientModel::where('id', $this->devis->rental->client->id)->first();
        return $client->spec->tva;
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

<?php

namespace App\Services;

use App\Models\MaterialModel;
use Date;

class MaterialService
{
    public function __construct()
    {
    }

    public static function getAvailableMaterials(
         $from,  $to
    ){
        return MaterialModel::whereDoesntHave('rentals', function ($q) use ($from, $to) {
            $q->where(function ($q) use ($from, $to) {
                $q->whereBetween('from', [$from, $to])
                    ->orWhereBetween('to', [$from, $to])
                    ->orWhere(function ($q2) use ($from, $to) {
                        $q2->where('from', '<=', $from)
                            ->where('to', '>=', $to);
                    });
            });
        })->get();

    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Prestation extends Model
{
    public $timestamps = false;

    protected $fillable = [
        'name',
        'description',
        'price',
    ];

    public function devis()
    {
        return $this->belongsToMany(Devis::class);
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Reduction extends Model
{
    public $timestamps = false;

    protected $fillable = [
        'name',
        'type',
        'valeur',
    ];
    public function devis()
    {
        return $this->belongsToMany(Devis::class, 'devis_reductions', 'reduction_id', 'devis_id');
    }

    public function packages(){
        return $this->hasMany(Package::class);
    }


}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PackageItem extends Model
{
    public $timestamps = false;

    protected $fillable = [
        'name',
        'quantity',
    ];

    public function packages(){
        return $this->belongsToMany(Package::class);
    }
}

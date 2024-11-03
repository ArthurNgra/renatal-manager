<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Package extends Model
{
    public $timestamps = false;

    protected $fillable = [
        'name',
    ];

    public function packageItems()
    {
        return $this->belongsToMany(PackageItem::class, );

    }

    public function reduction(){
        return $this->belongsTo(Reduction::class);
    }
}

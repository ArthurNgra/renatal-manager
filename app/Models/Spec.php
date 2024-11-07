<?php

namespace App\Models;

use App\Nova\Client;
use Illuminate\Database\Eloquent\Model;

class Spec extends Model
{
    public $timestamps = false;

    protected $fillable = [
        'name',
        'tva',
    ];

    public function clients(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->HasMany(Client::class);
    }
}

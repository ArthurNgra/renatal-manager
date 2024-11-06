<?php

namespace App\Models;

use App\Nova\Client;
use Illuminate\Database\Eloquent\Model;

class InvoiceSpec extends Model
{
    public $timestamps = false;

    protected $fillable = [
        'tva',
        'type',
    ];

    public function clients(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->HasMany(Client::class);
    }
}

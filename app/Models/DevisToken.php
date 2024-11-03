<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class DevisToken extends Model
{
    public $timestamps = false;

    protected $fillable = [

        'devis_id',
        'token',
        'used',
    ];

    public function devis(): BelongsTo
    {
        return $this->belongsTo(Devis::class);
    }
}

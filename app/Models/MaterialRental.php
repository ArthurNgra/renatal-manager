<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class MaterialRental extends Model
{
    use HasFactory;
    protected $table = 'material_rental';

    protected $fillable = [
        'rental_id',
        'material_id',
    ];

    public function rental(): BelongsTo
    {
        return $this->belongsTo(RentalModel::class, 'rental_id');
    }

    public function material(): BelongsTo
    {
        return $this->belongsTo(MaterialModel::class, 'material_id');
    }
}

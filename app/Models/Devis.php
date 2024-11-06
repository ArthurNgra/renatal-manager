<?php

namespace App\Models;

use App\Services\DevisService;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use function max;

class Devis extends Model
{



    protected static function boot()
    {
        parent::boot();
        static::creating(function ($model) {
            $model->status = 'Créer';
        });

    }

    public $timestamps = false;

    protected $fillable = [
        'downloadurl',
        'status',
        'rental_id',
    ];

    protected $appends = [
        'amount',
        'final_amount'
    ];

    public function client()
    {
        return $this->rental->client;
    }

    public function rental(): BelongsTo
    {
        return $this->belongsTo(RentalModel::class, 'rental_id')->with(['materials', 'client']);
    }

    public function factures()
    {
        return $this->hasMany(Facture::class);
    }

    public function prestations()
    {
        return $this->belongsToMany(Prestation::class, 'prestation_devis', 'devis_id', 'prestation_id');
    }

    public function reductions()
    {
        return $this->belongsToMany(Reduction::class, 'devis_reductions', 'devis_id', 'reduction_id');
    }

    public function materialsForNova(): BelongsToMany
    {
        if ($this->rental) {
            return $this->rental->materials();
        }
        return $this->belongsToMany(MaterialModel::class, 'material_rental', 'rental_id', 'material_id')->whereRaw('1 = 0');
    }

    public function getAmountAttribute(): float
    {
        return (new DevisService($this))->getAmountAttribute();
    }

    public function getAmountTtcAttribute(): float
    {
        return  (new DevisService($this))->getAmountTtc();
    }

    public function getClient(): ClientModel
    {
        return $this->rental->client;
    }


    public function getMaterialsAttribute()
    {
        return $this->rental->materials;
    }

    public function getFinalAmountAttribute(): float
    {
        return  (new DevisService($this))->getFinalAmountAttribute();
    }

    public function getFinalAmountTtcAttribute(): float
    {
        return (new DevisService($this))->getFinalAmountTtcAttribute();
    }

    public function hasReduction()
    {
        return $this->reductions()->count() > 0;
    }
}

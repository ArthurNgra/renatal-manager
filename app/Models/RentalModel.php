<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class RentalModel extends Model
{
    use HasFactory;

    protected $table = 'rentals';
    protected $fillable = [
        'client_id',
        'referal_phone',
        'address',
        'from',
        'to',
        'special_demands',
    ];

    public function client(): BelongsTo
    {
        return $this->belongsTo(ClientModel::class);
    }

    public function materials(): \Illuminate\Database\Eloquent\Relations\BelongsToMany
    {
        return $this->belongsToMany(MaterialModel::class, 'material_rental', 'rental_id', 'material_id');
    }

    public function prestationModels(): \Illuminate\Database\Eloquent\Relations\BelongsToMany
    {
       return $this->belongsToMany(PrestationModel::class, 'prestation_rental', 'rental_model_id', 'prestation_model_id');
    }
    public function devis()
    {
        return $this->hasMany(Devis::class, 'rental_id');
    }

    public function availableForDates()
    {
        // Access date attributes directly to ensure no scope issues
        $from = $this->attributes['from'];
        $to = $this->attributes['to'];

        return MaterialModel::whereDoesntHave('rentals', function ($query) use ($from, $to) {
            $query->whereBetween('from', [$from, $to])
                ->orWhereBetween('to', [$from,$to])
              ;
        })->get();
    }



    protected function casts(): array
    {
        return [
            'from' => 'date',
            'to' => 'date',
        ];
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ClientModel extends Model
{
    use HasFactory;
    protected $table = 'clients';
    protected $fillable = [
        'Society',
        'firstname',
        'lastname',
        'phone',
        'mail',
        'address',
        'siret',
    ];

    public function rentals(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(RentalModel::class, 'client_id');
    }
    public function factures(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(Facture::class, 'client_id');
    }
}

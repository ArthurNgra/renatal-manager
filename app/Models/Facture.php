<?php

namespace App\Models;

use App\Nova\Client;
use App\Services\InvoiceService;
use Error;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Str;
use function dd;
use function now;

class Facture extends Model
{

    protected $keyType = 'string';



    public function devis(): BelongsTo
    {
        return $this->belongsTo(Devis::class);
    }
    public function devisClient()
    {
        return $this->hasMany(Devis::class, 'client_id', 'client_id');
    }

    public function client(): BelongsTo
    {
        return $this->belongsTo(Client::class);
    }
    public static function boot() {
        parent::boot();

        static::creating(function ($model) {
            if(Devis::find($model->devis_id)->status!='valider'){
                throw new Error('Le devis n est pas valider par le client');
            }

            $model->status = 'Ouverte';

            $model->client_id=Devis::find($model->devis_id)->rental->client->id;
        });
    }
    public $timestamps = false;

    protected $fillable = [
        'devis_id',
        'status',
        'due_date',
    ];



    protected $casts = [
        'due_date' => 'date',
    ];

    public function getClientAttribute()
    {
        return (new  InvoiceService($this))->getClientAttribute($this);
    }
    public function getTotal():float
    {
        return (new  InvoiceService($this))->getTotal();
    }

    public function getTotalWithReduction():float
    {
        return (new  InvoiceService($this))->getTotalWithReduction();
    }

    public static function getTotalLast12MonthsWithoutReduction(): float
    {
        return InvoiceService::getTotalLast12MonthsWithoutReduction();
    }
    public static function getTotalLast12MonthsWithReduction(): float
    {
        return InvoiceService::getTotalLast12MonthsWithReduction();
    }
    public static function getMonthlyTotalWithoutReduction(): array
    {
        return InvoiceService::getMonthlyTotalWithoutReduction();
    }
    public static function getMonthlyTotalWithReduction(): array
    {
        return InvoiceService::getMonthlyTotalWithReduction();
    }
    public static function getYearlyDiscount()
    {
        return InvoiceService::getYearlyDiscount();
    }

}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class MaterialModel extends Model
{
    use HasFactory;

    protected $table = 'materials';
    protected $fillable = [
        'category_id',
        'brand',
        'model',
        'specs',
        'serial',
        'has_issue',
    ];

    protected static function boot()
    {
        parent::boot();
        static::creating(function ($model) {
            $model->has_issue = 1;
        });
    }
    public function rentals(): \Illuminate\Database\Eloquent\Relations\BelongsToMany
    {
        return $this->belongsToMany(RentalModel::class,'material_rental','material_id','rental_id');
    }
    public function category()
    {
        return $this->belongsTo(Category::class,'category_id','id',);
    }

    public function scopeAvailableForDates($query, $from, $to)
    {
        return $query->whereDoesntHave('rentals', function ($query) use ($from, $to) {
            $query->where(function ($query) use ($from, $to) {
                $query->whereBetween('from', [$from, $to])
                    ->orWhereBetween('to', [$from, $to])
                    ->orWhere(function ($query) use ($from, $to) {
                        $query->where('from', '<=', $from)
                            ->where('to', '>=', $to);
                    });
            });
        });
    }
    public function scopeAvailableBeforeDate($query, $date)
    {
        return $query->whereDoesntHave('rentals', function ($query) use ($date) {
            $query->where('to', '<', $date);
        });
    }
    public function scopeAvailableOnDate($query, $date)
    {
        return $query->whereDoesntHave('rentals', function ($query) use ($date) {
            $query->where('from', '<=', $date)
                ->where('to', '>=', $date);
        });
    }

    protected function casts(): array
    {
        return [
            'has_issue' => 'boolean',
        ];
    }


}

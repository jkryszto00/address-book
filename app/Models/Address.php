<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Address extends Model
{
    use HasFactory;
    protected $fillable = ['user_id', 'street', 'number', 'city', 'zip'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function scopeFilter($query, array $filters)
    {
        $query->when($filters['number'] ?? null, function ($query, $number) {
            $query->where('number', 'like', '%'.$number.'%');
        })->when($filters['street'] ?? null, function ($query, $street) {
            $query->where('street', 'like', '%'.$street.'%');
        })->when($filters['city'] ?? null, function ($query, $city) {
            $query->where('city', 'like', '%'.$city.'%');
        })->when($filters['zip'] ?? null, function ($query, $zip) {
            $query->where('zip', 'like', '%'.$zip.'%');
        });
    }
}

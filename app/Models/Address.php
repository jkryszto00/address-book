<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Searchable\Searchable;
use Spatie\Searchable\SearchResult;

class Address extends Model implements Searchable
{
    use HasFactory;
    protected $fillable = ['user_id', 'street', 'number', 'city', 'zip'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function getSearchResult(): SearchResult
    {
        return new SearchResult($this, 'address');
    }
}

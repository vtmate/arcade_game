<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Place extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'image', 
    ];

    public function contests(): HasMany
    {
        return $this->hasMany(Contest::class);
    }
}

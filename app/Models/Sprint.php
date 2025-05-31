<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Sprint extends Model
{
    use HasFactory;

    protected $fillable = ['name'];

    public function historias(): HasMany
    {
        return $this->hasMany(Historia::class);
    }

    public function scopeActive(Builder $query)
    {
        return $query->where('fecha_fin', '>=', now());
    }
}
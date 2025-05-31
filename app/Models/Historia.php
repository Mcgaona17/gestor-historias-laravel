<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Historia extends Model
{
    use HasFactory;

    protected $fillable = [
    'titulo', 
    'descripcion', 
    'puntos', 
    'estado', 
    'fecha_creacion', 
    'responsable', 
    'sprint_id'
];


    public function sprint(): BelongsTo
    {
        return $this->belongsTo(Sprint::class);
    }

    protected $dates = ['fecha_creacion', 'fecha_finalizacion'];
}
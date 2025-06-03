<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Modelo extends Model
{
    /** @use HasFactory<\Database\Factories\ModeloFactory> */
    use HasFactory;

    protected $fillable = [
        'nome',
        'marca_id', // Corrija para marca_id
    ];

    // Um Modelo pertence a uma Marca
    public function marca()
    {
        return $this->belongsTo(Marca::class);
    }
}

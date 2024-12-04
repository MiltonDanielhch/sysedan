<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reforestacion extends Model
{
    use HasFactory;
    protected $fillable = [
        'especie_plantin', 
        'cantidad_plantines',
        'formulario_id',
    ];
    public function formulario()
    {
        return $this->belongsTo(Formulario::class);
    }
}

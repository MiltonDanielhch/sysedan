<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SectorPecuario extends Model
{
    use HasFactory;
    protected $fillable = [
        'tipo_especie_id',
        'numero_animales_afectados',
        'numero_animales_fallecidos',
        'formulario_id',
    ];

    public function tipoEspecie()
    {
        return $this->belongsTo(TipoEspecie::class);
    }

    public function formulario()
    {
        return $this->belongsTo(Formulario::class);
    }
}

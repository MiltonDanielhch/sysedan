<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SectorAgricola extends Model
{
    use HasFactory;
    protected $fillable = [
        'tipo_cultivo_id',
        'hectareas_afectados',
        'hectareas_perdidas',
        'formulario_id',
    ];

    public function tipoCultivo()
    {
        return $this->belongsTo(TipoCultivo::class);
    }

    public function formulario()
    {
        return $this->belongsTo(Formulario::class);
    }
}

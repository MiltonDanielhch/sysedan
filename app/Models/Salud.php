<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Salud extends Model
{
    use HasFactory;
    protected $fillable = [
        'grupo_etario_id',
        'detalle_enfermedad_id',
        'formulario_id',
        'cantidad_grupo_enfermos'
    ];
    public function grupoEtario()
    {
        return $this->belongsTo(GrupoEtario::class);
    }

    public function detalleEnfermedad()
    {
        return $this->belongsTo(DetalleEnfermedad::class);
    }
    public function formulario()
    {
        return $this->belongsTo(Formulario::class);
    }
}

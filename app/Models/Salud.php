<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Salud extends Model
{
    use HasFactory;
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

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ServicioBasico extends Model
{
    use HasFactory;

    public function tipoServicioBasico()
    {
        return $this->belongsTo(TipoServicioBasico::class);
    }

    public function formulario()
    {
        return $this->belongsTo(Formulario::class);
    }
}

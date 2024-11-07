<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SectorPecuario extends Model
{
    use HasFactory;
    public function tipoEspecie()
    {
        return $this->belongsTo(TipoEspecie::class);
    }

    public function formulario()
    {
        return $this->belongsTo(Formulario::class);
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FaunaSilvestre extends Model
{
    use HasFactory;
    public function detalleFaunaSilvestre()
    {
        return $this->belongsTo(DetalleFaunaSilvestre::class);
    }

    public function tipoFaunaEspecie()
    {
        return $this->belongsTo(TipoFaunaEspecie::class);
    }

    public function formulario()
    {
        return $this->belongsTo(Formulario::class);
    }
}


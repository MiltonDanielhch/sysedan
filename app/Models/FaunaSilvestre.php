<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FaunaSilvestre extends Model
{
    use HasFactory;
    protected $fillable = [
        'detalle_fauna_silvestre_id',
        'tipo_especie_id',
        'numero_fauna_silvestre',
        'formulario_id',
    ];
    public function detalleFaunaSilvestre()
    {
        return $this->belongsTo(DetalleFaunaSilvestre::class);
    }

    public function tipoEspecie()
    {
        return $this->belongsTo(TipoEspecie::class);
    }

    public function formulario()
    {
        return $this->belongsTo(Formulario::class);
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ServicioBasico extends Model
{
    use HasFactory;
    protected $fillable = [
        'tipo_servicio_basico_id',
        'informacion_tipo_dano',
        'numero_comunidades_afectadas',
        'formulario_id',
    ];

    public function tipoServicioBasico()
    {
        return $this->belongsTo(TipoServicioBasico::class);
    }

    public function formulario()
    {
        return $this->belongsTo(Formulario::class);
    }
}

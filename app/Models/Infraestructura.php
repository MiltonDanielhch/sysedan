<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Infraestructura extends Model
{
    use HasFactory;
    protected $fillable = [
        'tipo_infraestructura_id',
        'numeros_infraestructuras_afectadas',
        'formulario_id',
    ];

    public function tipoInfraestructura()
    {
        return $this->belongsTo(TipoInfraestructura::class);
    }

    public function formulario()
    {
        return $this->belongsTo(Formulario::class);
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ComunidadIncendio extends Model
{
    use HasFactory;
    protected $fillable = [
        'incendios_registrados',
        'incendios_activos',
        'necesidades',
        'num_familias_afectadas',
        'num_familias_damnificadas',
        'comunidad_id',
        'incendio_id',
    ];

    public function comunidad()
    {
        return $this->belongsTo(Comunidad::class);
    }

    public function incendio()
    {
        return $this->belongsTo(Incendio::class);
    }
}

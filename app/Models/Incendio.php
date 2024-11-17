<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Incendio extends Model
{
    use HasFactory;
    protected $fillable = [
        'fecha_inicio',
        'causas_probables',
        'estado',
    ];
    public function comunidad()
    {
        return $this->belongsToMany(Comunidad::class)->withPivot(['incendios_registrados', 'incendios_activos', 'necesidades', 'num_familias_afectadas', 'num_familias_damnificadas'])->withTimestamps();
    }
    public function formularios(){
        return $this->hasMany(Formulario::class);
    }

}

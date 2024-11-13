<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TipoInfraestructura extends Model
{
    use HasFactory;
    protected $fillable = [
        'nombre_tipo_infraestructura',
        'descripcion',
    ];
    public function infraestructuras()
    {
        return $this->hasMany(Infraestructura::class);
    }

}

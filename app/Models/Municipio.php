<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Municipio extends Model
{
    use HasFactory;
    protected $fillable = [
        'nombre_municipio',
        'nombre_alcalde',
        'poblacion_total',
        'provincia_id'
    ];
    public function provincia(){
        return $this->belongsTo(Provincia::class);
    }
    public function comunidades()
    {
        return $this->hasMany(Comunidad::class);
    }
}

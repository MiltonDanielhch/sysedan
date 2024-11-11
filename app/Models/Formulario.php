<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Formulario extends Model
{
    use HasFactory;
    protected $fillable = [
        'fecha_llenado',
        'comunidad_id',
        'incendio_id',
    ];
    public function comunidad(){
        return $this->belongsTo(Comunidad::class);
    }
}

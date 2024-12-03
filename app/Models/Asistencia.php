<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Asistencia extends Model
{
    use HasFactory;

    protected $casts = [
        'fecha_asistencia' => 'date',  // Automatically cast 'fecha_asistencia' to a Carbon instance
    ];
    protected $fillable = [
        'actividades',
        'cantidad_beneficiarios',
        'fecha_asistencia',
        'formulario_id',
    ];

    public function formulario()
    {
        return $this->belongsTo(Formulario::class);
    }
}

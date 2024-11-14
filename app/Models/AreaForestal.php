<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AreaForestal extends Model
{

    protected $fillable = [
        'detalle_area_forestal_id',
        'hectareas_perdidas_forestales',
        'formulario_id',
    ];

    public function detalleAreaForestal()
    {
        return $this->belongsTo(DetalleAreaForestal::class);
    }

    public function formulario()
    {
        return $this->belongsTo(Formulario::class);
    }
}

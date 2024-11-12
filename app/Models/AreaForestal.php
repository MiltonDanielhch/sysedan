<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AreaForestal extends Model
{
    use HasFactory;
    public function detalleAreaForestal()
    {
        return $this->belongsTo(DetalleAreaForestal::class);
    }

    public function formulario()
    {
        return $this->belongsTo(Formulario::class);
    }
}

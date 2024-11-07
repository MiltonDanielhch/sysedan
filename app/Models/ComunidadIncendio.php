<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ComunidadIncendio extends Model
{
    use HasFactory;

    public function comunidad()
    {
        return $this->belongsTo(Comunidad::class);
    }

    public function incendio()
    {
        return $this->belongsTo(Incendio::class);
    }
}

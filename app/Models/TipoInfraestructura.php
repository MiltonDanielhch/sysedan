<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TipoInfraestructura extends Model
{
    use HasFactory;

    public function infraestructuras()
    {
        return $this->hasMany(Infraestructura::class);
    }
}

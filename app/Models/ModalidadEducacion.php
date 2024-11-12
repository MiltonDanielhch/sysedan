<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ModalidadEducacion extends Model
{
    use HasFactory;

    public function instituciones()
    {
        return $this->hasMany(Institucion::class);
    }

}

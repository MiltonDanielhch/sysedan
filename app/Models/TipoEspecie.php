<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TipoEspecie extends Model
{
    use HasFactory;
    public function sectorPecuarios()
    {
        return $this->hasMany(SectorPecuario::class);
    }
}

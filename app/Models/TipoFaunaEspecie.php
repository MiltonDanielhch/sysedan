<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TipoFaunaEspecie extends Model
{
    use HasFactory;
    public function faunaSilvestres()
    {
        return $this->hasMany(FaunaSilvestre::class);
    }
}

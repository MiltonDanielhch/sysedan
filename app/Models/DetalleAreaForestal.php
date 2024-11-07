<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetalleAreaForestal extends Model
{
    use HasFactory;
    public function areaForestals()
    {
        return $this->hasMany(AreaForestal::class);
    }
}

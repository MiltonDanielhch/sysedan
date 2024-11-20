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
    public function delete()
    {
        $this->delete();
    }
    public function comunidad(){
        return $this->belongsTo(Comunidad::class);
    }
    public function incendio(){
        return $this->belongsTo(Incendio::class);
    }
    public function incendios()
{
    return $this->hasMany(Incendio::class);
}

}

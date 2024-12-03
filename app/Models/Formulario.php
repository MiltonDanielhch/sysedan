<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Formulario extends Model
{
    use HasFactory;
    protected $fillable = [
        'fecha_llenado',
        'comunidad_id',
        'incendio_id',
    ];
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
// --------------
    public function personaAfectadaIncendios()
    {
        return $this->hasMany(PersonaAfectadaIncendio::class);
    }
      public function salud()
      {
          return $this->hasMany(Salud::class);
      }

      public function educacion()
      {
          return $this->hasMany(Educacion::class);
      }

      public function infraestructura()
      {
          return $this->hasMany(Infraestructura::class);
      }

      public function servicioBasico()
      {
          return $this->hasMany(ServicioBasico::class);
      }

      public function sectorPecuario()
      {
          return $this->hasMany(SectorPecuario::class);
      }

      public function sectorAgricola()
      {
          return $this->hasMany(SectorAgricola::class);
      }

      public function areaForestal()
      {
          return $this->hasMany(AreaForestal::class);
      }

      public function faunaSilvestre()
      {
          return $this->hasMany(FaunaSilvestre::class);
      }

      public function asistencias(){
        return $this->hasMany(Asistencia::class);
      }
        /**
     * Elimina el formulario y sus relaciones de manera segura.
     */
    public function safeDelete()
    {
        // Usar una transacción para asegurar que todas las eliminaciones sean atómicas
        DB::beginTransaction();
        try {
            // Eliminar las relaciones
            $this->personaAfectadaIncendios()->delete();
            $this->salud()->delete();
            $this->educacion()->delete();
            $this->infraestructura()->delete();
            $this->servicioBasico()->delete();
            $this->sectorPecuario()->delete();
            $this->sectorAgricola()->delete();
            $this->areaForestal()->delete();
            $this->faunaSilvestre()->delete();

            // Eliminar la relación entre Comunidad e Incendio
            $this->comunidad->incendios()->detach($this->incendio->id);

            // Eliminar el Incendio
            $this->incendio->delete();

            // Eliminar el formulario
            $this->delete();

            // Confirmar la transacción
            DB::commit();

        } catch (\Exception $e) {
            // Deshacer los cambios si algo falla
            DB::rollBack();
            // Se puede manejar el error de forma más detallada, como con logging
            throw $e; // Para propagar el error
        }
    }
}

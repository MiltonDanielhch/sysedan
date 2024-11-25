<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateFormularioRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            //Formulario
            'fecha_llenado' => 'required|date',
            // Comunidad
            'nombre_comunidad' => 'required|string',
            'tipo_comunidad' => 'required|string',
            'municipio_id' => 'required|integer|exists:municipios,id',
            // Incendio
            'fecha_inicio' => 'required|date',
            'causas_probables' => 'nullable|string',
            'estado' => 'nullable|string',
            // Comunidad Incendios
            'incendios_registrados' => 'required|integer',
            'incendios_activos' => 'required|integer',
            'necesidades' => 'nullable|string',
            'num_familias_afectadas' => 'required|integer',
            'num_familias_damnificadas' => 'required|integer',
            // persona_afectada_incendios
            // 'grupo_etario_id.*' => 'required|integer|exists:grupo_etarios,id',
            'cantidad_afectados_por_incendios.*' => 'required|integer',
            // educacion
            'institucion_id.*' => 'required|integer',
            'num_estudiantes.*.*' => 'nullable|integer',
            // saluds
            'detalle_enfermedad_id.*' => 'required|integer|exists:detalle_enfermedads,id',
            'cantidad_grupo_enfermos.*.*' => 'nullable|integer|min:0',
            // Infraestructura
            'tipo_infraestructura_id.*' => 'required|integer|exists:tipo_infraestructuras,id',
            'numeros_infraestructuras_afectadas.*' => 'nullable|integer',

            //servicios basicos
            'tipo_servicio_basico_id.*' => 'required|integer|exists:tipo_servicio_basicos,id',
            'informacion_tipo_dano.*' => 'nullable|string',
            'numero_comunidades_afectadas.*' => 'nullable|integer',


             // sector pecuario
             'tipo_especie_id.*' => 'required|integer|exists:tipo_especies,id',
             'numero_animales_afectados.*' => 'nullable|integer',
             'numero_animales_fallecidos.*' => 'nullable|integer',

             // sector agricola
             'tipo_cultivo_id.*' => 'required|integer',
             'hectareas_afectados.*' => 'nullable|numeric',
             'hectareas_perdidas.*' => 'nullable|numeric',

             // area forestal
             'detalle_area_forestal_id.*' => 'required|integer',
             'hectareas_perdidas_forestales.*' => 'required|numeric',

            //  fauna silvestre
            'detalle_fauna_silvestre_id.*' => 'required|integer',
            'numero_fauna_silvestre.*.*' => 'required|integer',
        ];
    }
}

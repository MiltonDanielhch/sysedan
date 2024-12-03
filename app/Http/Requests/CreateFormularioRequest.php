<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateFormularioRequest extends FormRequest
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
            // formulario
            'fecha_llenado' => 'required|date',
            //comunidad
            // 'nombre_comunidad' => 'required|string',
            // 'tipo_comunidad' => 'required|string',
            'municipio_id' => 'required|integer|exists:municipios,id',
            'comunidad_id' => 'required|integer|exists:comunidads,id',
            //incendio
            'fecha_inicio' => 'required|date',
            'causas_probables' => 'nullable|string',
            'estado' => 'nullable|string',
            // comunidad_incendios
            'incendios_registrados' => 'nullable|integer',
            'incendios_activos' => 'nullable|integer',
            'necesidades' => 'nullable|string',
            'num_familias_afectadas' => 'nullable|integer',
            'num_familias_damnificadas' => 'nullable|integer',


            // asistencia
            'actividades' => 'nullable|string',
            'cantidad_beneficiarios' => 'nullable|integer',
            'fecha_asistencia' => 'nullable|date',

            // persona_afectada_incendios
            'grupo_etario_id.*' => 'required|integer|exists:grupo_etarios,id',
            'cantidad_afectados_por_incendios.*' => 'nullable|integer',

            // saluds
            'detalle_enfermedad_id.*' => 'required|integer|exists:detalle_enfermedads,id',
            'cantidad_grupo_enfermos.*.*' => 'nullable|integer|min:0',

            // educacion
            'institucion_id.*' => 'required|integer',
            'num_estudiantes.*.*' => 'nullable|integer',

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
            'hectareas_perdidas_forestales.*' => 'nullable|numeric',

            //  fauna silvestre
            'detalle_fauna_silvestre_id.*' => 'required|integer',
            'numero_fauna_silvestre.*.*' => 'nullable|integer',



            // reforestacion
            // 'especie_plantin' => 'nullable|string',
            // 'cantidad_plantines' => 'nullable|integer',
            // 'fecha_reforestacion' => 'nullable|date',
        ];
    }
}

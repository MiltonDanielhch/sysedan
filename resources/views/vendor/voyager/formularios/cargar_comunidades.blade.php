<select name="comunidad_id" id="select_comunidad" class="form-control select2" required>
    <option value="" disabled selected>-- Selecciona un Municipio --</option>
    @foreach ($comunidades as $comunidad)
    <option value="{{ $comunidad->id }}">{{ $comunidad->nombre_comunidad }}</option>
    @endforeach
</select>





{{-- <select name="comunidad_id" id="select_comunidad" class="form-control select2" required>
    <option value="">-- Selecciona una Comunidad --</option>
    @foreach ($comunidades as $comunidad)
        <option value="{{ $comunidad->id }}" {{ old('comunidad_id', $model->comunidad_id ?? '') == $comunidad->id ? 'selected' : '' }}>
            {{ $comunidad->nombre_comunidad }}
        </option>
    @endforeach
</select> --}}

<script>
    $(document).ready(function() {
        $('#select_comunidad').select2();  // Aplica select2 al campo
    });
</script>

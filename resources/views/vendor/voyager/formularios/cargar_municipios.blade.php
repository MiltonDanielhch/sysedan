<select name="municipio" id="select_municipio" class="form-control" required>
    <option value="" disabled selected>-- Selecciona un Municipio --</option>
    @foreach ($municipios as $municipio)
    <option value="{{ $municipio->id }}">{{ $municipio->nombre_municipio }}</option>
    @endforeach
</select>

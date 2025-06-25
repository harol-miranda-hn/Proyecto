<x-guest-layout>
    <div class="container py-4">

        <!-- Encabezado -->
        <div class="bg-warning bg-gradient text-white rounded-3 p-3 mb-4 d-flex flex-wrap align-items-start gap-3">
            <div class="rounded-circle bg-white bg-opacity-25 d-flex align-items-center justify-content-center"
                 style="width: 48px; height: 48px;">
                <i class="fas fa-file-signature fs-5"></i>
            </div>
            <div class="flex-grow-1">
                <h2 class="h6 mb-1">Editar Matrícula</h2>
                <p class="mb-0 small">Modifique los campos necesarios y guarde los cambios</p>
            </div>
        </div>

        <!-- Formulario -->
        <div class="bg-white rounded-3 shadow-sm p-4">
            <form action="{{ route('matriculas.update', $matricula->id) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="row g-3">

                    <!-- Alumno -->
                    <div class="col-md-6">
                        <label for="alumno_id" class="form-label">Alumno *</label>
                        <select name="alumno_id" id="alumno_id" class="form-select">
                            <option value="">Seleccione un alumno</option>
                            @foreach($alumnos as $alumno)
                                <option value="{{ $alumno->id }}"
                                    {{ old('alumno_id', $matricula->alumno_id) == $alumno->id ? 'selected' : '' }}>
                                    {{ $alumno->nombre_completo }}
                                </option>
                            @endforeach
                        </select>
                        @error('alumno_id')
                        <div class="text-danger small">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Grado -->
                    <div class="col-md-6">
                        <label for="grado_id" class="form-label">Grado *</label>
                        <select name="grado_id" id="grado_id" class="form-select">
                            <option value="">Seleccione un grado</option>
                            @foreach($grados as $grado)
                                <option value="{{ $grado->id }}"
                                    {{ old('grado_id', $matricula->grado_id) == $grado->id ? 'selected' : '' }}>
                                    {{ $grado->curso }} de {{ $grado->modalidad }} - sección {{ $grado->seccion }} ({{ $grado->jornada }})
                                </option>
                            @endforeach
                        </select>
                        @error('grado_id')
                        <div class="text-danger small">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Fecha -->
                    <div class="col-md-6">
                        <label for="fecha_matricula" class="form-label">Fecha de Matrícula *</label>
                        <input type="date" name="fecha_matricula" id="fecha_matricula" class="form-control"
                               value="{{ old('fecha_matricula', \Carbon\Carbon::parse($matricula->fecha_matricula)->format('Y-m-d')) }}"

                        @error('fecha_matricula')
                        <div class="text-danger small">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <!-- Botones -->
                <div class="mt-4 d-flex flex-column flex-sm-row justify-content-end gap-2">
                    <a href="{{ route('matriculas.index') }}" class="btn btn-outline-secondary">
                        <i class="fas fa-arrow-left me-1"></i> Volver
                    </a>
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-save me-1"></i> Guardar Cambios
                    </button>
                </div>
            </form>
        </div>
    </div>
</x-guest-layout>

<x-guest-layout>
    <div class="container py-4">

        <!-- Encabezado del formulario -->
        <div class="bg-primary bg-gradient text-white rounded-3 p-3 mb-4 d-flex flex-wrap align-items-start gap-3">
            <div class="rounded-circle bg-white bg-opacity-25 d-flex align-items-center justify-content-center" style="width: 48px; height: 48px;">
                <i class="fas fa-calendar-plus fs-5"></i>
            </div>
            <div class="flex-grow-1">
                <h2 class="h6 mb-1">Registrar Nueva Asistencia</h2>
                <p class="mb-0 small">Seleccione el grado, la fecha y marque el estado correspondiente para cada alumno</p>
            </div>
        </div>

        <!-- Contenedor del formulario -->
        <div class="bg-white rounded-3 shadow-sm p-4">
            <form action="{{ route('asistencias.store') }}" method="POST">
                @csrf

                <!-- Datos generales -->
                <div class="mb-4 border-bottom pb-3">
                    <div class="d-flex align-items-center text-primary mb-3">
                        <div class="bg-light rounded-circle d-flex justify-content-center align-items-center me-2" style="width: 32px; height: 32px;">
                            <i class="fas fa-info-circle small"></i>
                        </div>
                        <h5 class="mb-0">Datos de Asistencia</h5>
                    </div>

                    <div class="row g-3">
                        <div class="col-md-6">
                            <label for="grado_id" class="form-label">Grado *</label>
                            <select name="grado_id" id="grado_id" class="form-select" required>
                                <option value="">Seleccione un grado...</option>
                                @foreach($grados as $grado)
                                    @php
                                        $curso = $grado->curso ?? 'N/D';
                                        $mod = strtolower($grado->modalidad ?? '');
                                        $modalidad = str_contains($mod, 'robótica') ? 'BTP en Robótica' : (str_contains($mod, 'informática') ? 'BTP en Informática' : ucfirst($mod));
                                        $seccion = $grado->seccion ?? '';
                                        $jornada = $grado->jornada ?? '';
                                    @endphp
                                    <option value="{{ $grado->id }}" {{ old('grado_id') == $grado->id ? 'selected' : '' }}>
                                        {{ $curso }} de {{ $modalidad }} '{{ $seccion }}' ({{ $jornada }})
                                    </option>
                                @endforeach
                            </select>
                            @error('grado_id') <div class="text-danger small">{{ $message }}</div> @enderror
                        </div>

                        <div class="col-md-6">
                            <label for="fecha" class="form-label">Fecha *</label>
                            <input type="date" id="fecha" class="form-control" value="{{ now()->toDateString() }}" disabled>
                            <input type="hidden" name="fecha" value="{{ now()->toDateString() }}">
                            @error('fecha') <div class="text-danger small">{{ $message }}</div> @enderror
                        </div>
                    </div>
                </div>

                <!-- Lista de alumnos -->
                <div class="mb-4">
                    <div class="d-flex align-items-center text-primary mb-3">
                        <div class="bg-light rounded-circle d-flex justify-content-center align-items-center me-2" style="width: 32px; height: 32px;">
                            <i class="fas fa-users small"></i>
                        </div>
                        <h5 class="mb-0">Estado de los Alumnos</h5>
                    </div>

                    <div id="mensaje-no-alumnos" class="text-muted small text-center my-3">Seleccione un grado para mostrar sus alumnos...</div>

                    <div id="alumnos-container"></div>
                </div>

                <!-- Botones -->
                <div class="d-flex flex-column flex-sm-row justify-content-end gap-2 mt-4">
                    <a href="{{ route('asistencias.index') }}" class="btn btn-outline-secondary">
                        <i class="fas fa-times me-1"></i> Cancelar
                    </a>
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-check-circle me-1"></i> Guardar Asistencia
                    </button>
                </div>
            </form>
        </div>
    </div>

    <!-- Script: carga dinámica de alumnos -->
    <script>
        const gradoSelect = document.getElementById('grado_id');
        const container = document.getElementById('alumnos-container');
        const mensaje = document.getElementById('mensaje-no-alumnos');

        gradoSelect.addEventListener('change', function () {
            const gradoId = this.value;
            container.innerHTML = '';
            mensaje.style.display = 'block';
            mensaje.innerText = 'Cargando alumnos...';

            if (gradoId) {
                fetch(`/api/grados/${gradoId}/alumnos`)
                    .then(res => res.json())
                    .then(alumnos => {
                        if (alumnos.length === 0) {
                            mensaje.innerText = 'No hay alumnos registrados en este grado.';
                            return;
                        }

                        mensaje.style.display = 'none';

                        let html = `
                            <div class="table-responsive">
                                <table class="table table-sm table-bordered align-middle text-center">
                                    <thead class="table-light">
                                        <tr>
                                            <th>Alumno</th>
                                            <th>Asistió</th>
                                            <th>Faltó</th>
                                            <th>Excusado</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                        `;

                        alumnos.forEach(alumno => {
                            html += `
                                <tr>
                                    <td class="text-start">${alumno.nombre_completo}</td>
                                    <td><input type="radio" name="estados[${alumno.id}]" value="asistio" required></td>
                                    <td><input type="radio" name="estados[${alumno.id}]" value="falto" required></td>
                                    <td><input type="radio" name="estados[${alumno.id}]" value="excusado" required></td>
                                </tr>
                            `;
                        });

                        html += '</tbody></table></div>';
                        container.innerHTML = html;
                    });
            }
        });
    </script>
</x-guest-layout>

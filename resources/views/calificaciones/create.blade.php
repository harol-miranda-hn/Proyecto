<x-guest-layout>
    <div class="container py-4">
        <!-- Encabezado -->
        <div class="bg-primary bg-gradient text-white rounded-3 p-3 mb-4 d-flex align-items-start gap-3">
            <div class="rounded-circle bg-white bg-opacity-25 d-flex align-items-center justify-content-center" style="width: 48px; height: 48px;">
                <i class="fas fa-clipboard-list fs-5"></i>
            </div>
            <div>
                <h2 class="h6 mb-1">Registrar Calificaciones</h2>
                <p class="mb-0 small">Seleccione un alumno matriculado y registre sus notas.</p>
            </div>
        </div>

        @if($errors->any())
            <div class="alert alert-danger mt-3">
                <ul class="mb-0">
                    @foreach ($errors->all() as $error)
                        <li><span class="badge bg-danger">{{ $error }}</span></li>
                    @endforeach
                </ul>
            </div>
        @endif


        <!-- Formulario -->
        <div class="bg-white shadow-sm rounded-3 p-4">
            <form id="formCalificaciones" action="{{ route('calificaciones.store') }}" method="POST">
                @csrf

                <!-- Alumno -->
                <div class="mb-4">
                    <label class="form-label">Alumno *</label>
                    <select name="matricula_id" id="alumno_id" class="form-select" required>
                        <option value="">Seleccione un alumno matriculado</option>
                        @foreach($alumnos as $alumno)
                            @foreach($alumno->matriculas as $matricula)
                                <option value="{{ $matricula->id }}"
                                        data-grado="{{ $matricula->grado->curso }} - {{ $matricula->grado->modalidad }} ({{ $matricula->grado->seccion }} - {{ $matricula->grado->jornada }})"
                                        data-asignaturas='@json($matricula->grado->asignaturas)'>
                                    {{ $alumno->nombre_completo }} - {{ $matricula->grado->curso }} ({{ $matricula->grado->seccion }})
                                </option>
                            @endforeach
                        @endforeach
                    </select>
                    @error('matricula_id')
                    <div class="text-danger small">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Info Grado -->
                <div id="gradoInfo" class="mb-3 d-none">
                    <div class="alert alert-info small">
                        <strong>Grado:</strong> <span id="gradoLabel"></span>
                    </div>
                </div>

                <!-- Advertencia -->
                <div id="advertenciaAsignaturas" class="alert alert-warning d-none">
                    Este grado no tiene asignaturas asignadas.
                    <a href="{{ route('asignaciones.index') }}" class="btn btn-sm btn-warning ms-2">
                        <i class="fas fa-plus-circle me-1"></i> Asignar Clases
                    </a>
                </div>

                <!-- Tabla -->
                <div class="table-responsive d-none" id="tablaContainer">
                    <table class="table table-bordered align-middle">
                        <thead class="table-light text-center">
                        <tr>
                            <th>Asignatura</th>
                            <th>Parcial 1</th>
                            <th>Parcial 2</th>
                            <th>Parcial 3</th>
                            <th>Parcial 4</th>
                            <th>Promedio</th>
                            <th>Aplica</th>
                        </tr>
                        </thead>
                        <tbody id="tablaCalificaciones"></tbody>
                    </table>
                </div>

                <!-- Botones -->
                <div class="d-flex justify-content-end gap-2 mt-4">
                    <a href="{{ route('calificaciones.index') }}" class="btn btn-outline-secondary">
                        <i class="fas fa-arrow-left me-1"></i> Cancelar
                    </a>
                    <button type="submit" class="btn btn-success">
                        <i class="fas fa-save me-1"></i> Guardar Calificaciones
                    </button>
                </div>
            </form>
        </div>
    </div>

    <script>
        const alumnoSelect = document.getElementById('alumno_id');
        const tablaBody = document.getElementById('tablaCalificaciones');
        const tablaContainer = document.getElementById('tablaContainer');
        const advertencia = document.getElementById('advertenciaAsignaturas');
        const gradoInfo = document.getElementById('gradoInfo');
        const gradoLabel = document.getElementById('gradoLabel');
        const form = document.getElementById('formCalificaciones');

        alumnoSelect.addEventListener('change', function () {
            const selected = this.options[this.selectedIndex];
            const asignaturasRaw = selected.getAttribute('data-asignaturas');
            const grado = selected.getAttribute('data-grado');

            tablaBody.innerHTML = '';
            tablaContainer.classList.add('d-none');
            advertencia.classList.add('d-none');
            gradoInfo.classList.add('d-none');
            gradoLabel.textContent = '';

            if (asignaturasRaw) {
                const asignaturas = JSON.parse(asignaturasRaw);

                if (!asignaturas.length) {
                    advertencia.classList.remove('d-none');
                    return;
                }

                asignaturas.forEach((asignatura, index) => {
                    const row = `
                        <tr data-index="${index}">
                            <td>
                                ${asignatura.nombre}
                                <input type="hidden" name="calificaciones[${index}][asignatura_id]" value="${asignatura.id}">
                            </td>
                            ${[1,2,3,4].map(n => `
                                <td>
                                    <input type="text"
                                           name="calificaciones[${index}][parcial_${n}]"
                                           class="form-control parcial"
                                           inputmode="numeric"
                                           maxlength="3"
                                           placeholder="0-100">
                                </td>
                            `).join('')}
                            <td class="text-center promedio">—</td>
                            <td class="text-center aplica">—</td>
                        </tr>
                    `;
                    tablaBody.insertAdjacentHTML('beforeend', row);
                });

                tablaContainer.classList.remove('d-none');
                gradoLabel.textContent = grado;
                gradoInfo.classList.remove('d-none');
            }
        });

        document.addEventListener('input', function (e) {
            if (e.target.classList.contains('parcial')) {
                let val = e.target.value.toUpperCase();
                if (val === 'NSP') {
                    e.target.value = 'NSP';
                } else {
                    val = val.replace(/[^0-9]/g, '').slice(0, 3);
                    e.target.value = val;
                }

                const row = e.target.closest('tr');
                const parciales = Array.from(row.querySelectorAll('.parcial'))
                    .map(input => {
                        const v = input.value.toUpperCase();
                        if (v === 'NSP') return 0;
                        const num = parseInt(v);
                        return isNaN(num) ? null : num;
                    })
                    .filter(n => n !== null);

                const promedioCell = row.querySelector('.promedio');
                const aplicaCell = row.querySelector('.aplica');

                if (parciales.length) {
                    const promedio = Math.round(parciales.reduce((a, b) => a + b, 0) / parciales.length);
                    promedioCell.textContent = promedio;

                    aplicaCell.textContent = parciales.length >= 3
                        ? (promedio >= 70 ? 'Aprobó' : 'Reprobó')
                        : 'Abandonó';
                } else {
                    promedioCell.textContent = '—';
                    aplicaCell.textContent = '—';
                }
            }
        });


        form.addEventListener('submit', function (e) {
            const rows = form.querySelectorAll('#tablaCalificaciones tr');
            let valido = true;

            rows.forEach((row, i) => {
                const inputs = Array.from(row.querySelectorAll('.parcial'));
                const notasLlenas = inputs.filter(input => input.value.trim() !== '');

                if (notasLlenas.length === 0) {
                    valido = false;
                    row.classList.add('table-danger');
                } else {
                    row.classList.remove('table-danger');
                }
            });

            if (!valido) {
                e.preventDefault();
                alert("⚠️ Debes ingresar al menos una nota por asignatura.");
            }
        });

    </script>
</x-guest-layout>

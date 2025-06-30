<x-guest-layout>
    <div class="container py-4">
        <!-- Encabezado -->
        <div class="bg-success bg-gradient text-white rounded-3 p-3 mb-4 d-flex align-items-start gap-3">
            <div class="rounded-circle bg-white bg-opacity-25 d-flex align-items-center justify-content-center" style="width: 48px; height: 48px;">
                <i class="fas fa-clipboard-check fs-5"></i>
            </div>
            <div>
                <h2 class="h6 mb-1">Editar Calificaciones</h2>
                <p class="mb-0 small">Modifique las notas y guarde los cambios.</p>
            </div>
        </div>

        <!-- Contenedor de Toasts -->
        <div class="toast-container position-fixed top-0 end-0 p-3" style="z-index: 1100;">
            @if(session('status'))
                <div class="toast align-items-center text-bg-success border-0 show" role="alert" aria-live="assertive" aria-atomic="true">
                    <div class="d-flex">
                        <div class="toast-body">{{ session('status') }}</div>
                        <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast" aria-label="Cerrar"></button>
                    </div>
                </div>
            @endif

            @if ($errors->any())
                @foreach ($errors->all() as $error)
                    <div class="toast align-items-center text-bg-danger border-0 show mb-2" role="alert" aria-live="assertive" aria-atomic="true">
                        <div class="d-flex">
                            <div class="toast-body">{{ $error }}</div>
                            <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast" aria-label="Cerrar"></button>
                        </div>
                    </div>
                @endforeach
            @endif
        </div>

        <!-- Formulario -->
        <div class="bg-white shadow-sm rounded-3 p-4">
            <form id="formCalificaciones" method="POST" action="{{ route('calificaciones.update', $matricula->id) }}">
                @csrf
                @method('PUT')

                <!-- Alumno -->
                <div class="mb-4">
                    <label class="form-label">Alumno</label>
                    <input type="text" class="form-control" value="{{ $matricula->alumno->nombre_completo }}" readonly>
                </div>

                <!-- Grado -->
                <div class="mb-4">
                    <label class="form-label">Grado</label>
                    <input type="text" class="form-control" value="{{ $matricula->grado->curso }} - {{ $matricula->grado->seccion }}" readonly>
                </div>

                <!-- Tabla -->
                <div class="table-responsive">
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
                        <tbody id="tablaCalificaciones">
                        @foreach($calificaciones as $index => $item)
                            <tr data-index="{{ $index }}">
                                <td>
                                    {{ $item->asignatura->nombre }}
                                    <input type="hidden" name="calificaciones[{{ $index }}][asignatura_id]" value="{{ $item->asignatura_id }}">
                                </td>
                                @for ($i = 1; $i <= 4; $i++)
                                    @php
                                        $valor = $item["parcial_$i"];
                                        $mostrar = $valor === 0 ? 'NSP' : (is_numeric($valor) ? intval($valor) : '');
                                    @endphp
                                    <td>
                                        <input type="text"
                                               name="calificaciones[{{ $index }}][parcial_{{ $i }}]"
                                               class="form-control parcial"
                                               inputmode="numeric"
                                               maxlength="3"
                                               value="{{ old("calificaciones.$index.parcial_$i", $mostrar) }}"
                                               placeholder="">
                                    </td>
                                @endfor
                                <td class="text-center promedio">—</td>
                                <td class="text-center aplica">—</td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>

                <!-- Botones -->
                <div class="d-flex justify-content-end gap-2 mt-4">
                    <a href="{{ route('calificaciones.index') }}" class="btn btn-outline-secondary">
                        <i class="fas fa-arrow-left me-1"></i> Cancelar
                    </a>
                    <button type="submit" class="btn btn-success">
                        <i class="fas fa-save me-1"></i> Guardar Cambios
                    </button>
                </div>
            </form>
        </div>
    </div>

    <!-- Scripts -->
    <script>
        function mostrarMensaje(mensaje, tipo = 'info') {
            const contenedor = document.getElementById('mensajeBadge');
            const badge = document.createElement('div');
            badge.className = `badge bg-${tipo} p-3 shadow-sm d-inline-block mb-2`;
            badge.textContent = mensaje;
            contenedor.appendChild(badge);
            setTimeout(() => badge.remove(), 5000);
        }

        document.addEventListener('input', function (e) {
            if (e.target.classList.contains('parcial')) {
                let val = e.target.value.toUpperCase();
                e.target.value = val === 'NSP' ? 'NSP' : val.replace(/[^0-9]/g, '').slice(0, 3);

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

        document.addEventListener('DOMContentLoaded', () => {
            document.querySelectorAll('.parcial').forEach(input => {
                input.dispatchEvent(new Event('input'));
            });

            const toastList = [].slice.call(document.querySelectorAll('.toast'));
            toastList.forEach(toastEl => new bootstrap.Toast(toastEl, { delay: 5000 }).show());
        });

    </script>

    <div id="mensajeBadge" style="position: fixed; top: 20px; right: 20px; z-index: 1050;"></div>

    <!-- Bootstrap JS CDN (si no lo tienes en layout) -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</x-guest-layout>

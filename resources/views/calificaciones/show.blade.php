<x-guest-layout>
    <div class="container py-4">
        <div class="px-4 py-4 shadow rounded-4 border" style="background-color: #fafafa;">

            <!-- Encabezado -->
            <div class="mb-3">
                <h2 class="h4 fw-bold" style="color: #6200ea;">Detalle de Calificaciones</h2>
                <div id="gradoInfo" class="mb-3">
                    <div class="alert alert-info small">
                        <p class="text-muted mb-1">
                            <strong>{{ $matricula->alumno->nombre_completo ?? 'N/D' }}</strong>
                        </p>
                        <p class="text-muted">
                            {{ $matricula->grado->curso ?? 'N/D' }} de {{ $matricula->grado->modalidad ?? '' }} -
                            sección {{ $matricula->grado->seccion ?? '' }}
                            (jornada {{ $matricula->grado->jornada ?? '' }})
                        </p>
                    </div>
                </div>
            </div>

            @if(count($asignaturas))
                <div class="table-responsive">
                    <table class="table table-bordered table-hover align-middle text-center table-sm">
                        <thead class="table-dark">
                        <tr>
                            <th>#</th>
                            <th>Asignatura</th>
                            <th>Parcial 1</th>
                            <th>Parcial 2</th>
                            <th>Parcial 3</th>
                            <th>Parcial 4</th>
                            <th>Promedio</th>
                            <th>Estado</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($asignaturas as $index => $asignatura)
                            @php
                                $cal = $calificaciones->get($asignatura->id);
                                $prom = $promedios[$asignatura->id] ?? ['promedio' => 0, 'estado' => 'N/A'];
                            @endphp
                            <tr>
                                <td>{{ $index + 1 }}</td>
                                <td class="text-start">{{ $asignatura->nombre }}</td>
                                <td>{{ isset($cal->parcial_1) ? round($cal->parcial_1) : '—' }}</td>
                                <td>{{ isset($cal->parcial_2) ? round($cal->parcial_2) : '—' }}</td>
                                <td>{{ isset($cal->parcial_3) ? round($cal->parcial_3) : '—' }}</td>
                                <td>{{ isset($cal->parcial_4) ? round($cal->parcial_4) : '—' }}</td>
                                <td>
                                    <span class="badge rounded-pill text-white"
                                          style="background-color: #388e3c;">
                                        {{ round($prom['promedio']) }}
                                    </span>
                                </td>
                                <td>
                                    <span class="badge rounded-pill text-dark"
                                          style="background-color: #e0e0e0;">
                                        {{ $prom['estado'] }}
                                    </span>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            @else
                <div class="text-center text-muted py-4">
                    No hay asignaturas registradas para este grado.
                </div>
            @endif

            <div class="mt-4">
                <a href="{{ route('calificaciones.index') }}" class="btn btn-secondary">
                    <i class="fas fa-arrow-left me-1"></i> Volver a listado
                </a>
            </div>
        </div>
    </div>
</x-guest-layout>

<x-guest-layout>
    <div class="container py-4">

        <!-- Encabezado -->
        <div class="bg-info bg-gradient text-white rounded-3 p-3 mb-4 d-flex flex-wrap align-items-start gap-3">
            <div class="rounded-circle bg-white bg-opacity-25 d-flex align-items-center justify-content-center" style="width: 48px; height: 48px;">
                <i class="fas fa-calendar-day fs-5"></i>
            </div>
            <div class="flex-grow-1">
                <h2 class="h6 mb-1">Detalles de Asistencia</h2>
                <p class="mb-0 small">Visualización del estado de asistencia por alumno</p>
            </div>
        </div>

        <!-- Tarjeta de información -->
        <div class="bg-white rounded-3 shadow-sm p-4">

            <!-- Sección: Información General -->
            <div class="mb-4">
                <div class="d-flex align-items-center text-primary mb-3">
                    <i class="fas fa-info-circle me-2"></i>
                    <h5 class="mb-0">Información General</h5>
                </div>

                <div class="row g-3">
                    <div class="col-md-12">
                        <small class="text-muted">Grado</small>
                        <div class="fw-semibold text-dark">
                            {{ $asistencia->grado->curso }} de <strong>{{ $asistencia->grado->modalidad }} </strong>'{{ $asistencia->grado->seccion }}' {{ $asistencia->grado->jornada }}
                        </div>
                    </div>
                    <div class="col-md-6">
                        <small class="text-muted">Fecha</small>
                        <div class="fw-semibold text-dark">
                            {{ \Carbon\Carbon::parse($asistencia->fecha)->locale('es')->translatedFormat('l d \d\e F, Y') }}
                        </div>
                    </div>
                </div>
            </div>

            <hr class="my-4">

            <!-- Sección: Lista de alumnos -->
            <div class="mb-3">
                <div class="d-flex align-items-center text-primary mb-3">
                    <i class="fas fa-users me-2"></i>
                    <h5 class="mb-0">Estado de Asistencia</h5>
                </div>

                <div class="table-responsive">
                    <table class="table table-bordered table-sm text-center align-middle">
                        <thead class="table-light">
                        <tr>
                            <th>#</th>
                            <th>Alumno</th>
                            <th>Asistió</th>
                            <th>Faltó</th>
                            <th>Excusado</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach ($asistencia->asistenciaAlumnos as $index => $registro)
                            <tr>
                                <td>{{ $index + 1 }}</td>
                                <td class="text-start">{{ $registro->alumno->nombre_completo }}</td>
                                <td>
                                    @if ($registro->estado === 'asistio')
                                        <i class="fas fa-check-circle text-success"></i>
                                    @endif
                                </td>
                                <td>
                                    @if ($registro->estado === 'falto')
                                        <i class="fas fa-times-circle text-danger"></i>
                                    @endif
                                </td>
                                <td>
                                    @if ($registro->estado === 'excusado')
                                        <i class="fas fa-exclamation-circle text-warning"></i>
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>

            <!-- Botones -->
            <div class="mt-4 d-flex justify-content-end gap-2">
                <a href="{{ route('asistencias.index') }}" class="btn btn-outline-secondary">
                    <i class="fas fa-arrow-left me-1"></i> Volver
                </a>
                <a href="{{ route('asistencias.edit', $asistencia->id) }}" class="btn btn-warning text-white">
                    <i class="fas fa-edit me-1"></i> Editar
                </a>
            </div>
        </div>
    </div>
</x-guest-layout>

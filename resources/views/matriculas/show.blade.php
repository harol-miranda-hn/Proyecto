<x-guest-layout>
    <div class="container py-4">

        <!-- Encabezado -->
        <div class="bg-info bg-gradient text-white rounded-3 p-3 mb-4 d-flex flex-wrap align-items-start gap-3">
            <div class="rounded-circle bg-white bg-opacity-25 d-flex align-items-center justify-content-center" style="width: 48px; height: 48px;">
                <i class="fas fa-file-alt fs-5"></i>
            </div>
            <div class="flex-grow-1">
                <h2 class="h6 mb-1">Detalles de Matrícula</h2>
                <p class="mb-0 small">Información completa de la matrícula registrada</p>
            </div>
        </div>

        <!-- Tarjeta de información -->
        <div class="bg-white rounded-3 shadow-sm p-4">

            <!-- Información de la matrícula -->
            <div class="mb-4">
                <div class="d-flex align-items-center text-primary mb-3">
                    <i class="fas fa-user-check me-2"></i>
                    <h5 class="mb-0">Información de la Matrícula</h5>
                </div>

                <div class="row g-3">
                    <div class="col-md-6">
                        <small class="text-muted">Alumno</small>
                        <div class="fw-semibold text-dark">{{ $matricula->alumno->nombre_completo }}</div>
                    </div>

                    <div class="col-md-6">
                        <small class="text-muted">Fecha de Matrícula</small>
                        <div class="fw-semibold text-dark">
                            {{ \Carbon\Carbon::parse($matricula->fecha_matricula)->format('d/m/Y') }}
                        </div>
                    </div>

                    <div class="col-md-12">
                        <small class="text-muted">Grado</small>
                        <div class="fw-semibold text-dark">
                            {{ $matricula->grado->curso }} de {{ $matricula->grado->modalidad }}
                            - sección {{ $matricula->grado->seccion }} ({{ $matricula->grado->jornada }})
                        </div>
                    </div>
                </div>
            </div>

            <!-- Botones -->
            <div class="mt-4 d-flex justify-content-end gap-2">
                <a href="{{ route('matriculas.index') }}" class="btn btn-outline-secondary">
                    <i class="fas fa-arrow-left me-1"></i> Volver
                </a>
                <a href="{{ route('matriculas.edit', $matricula->id) }}" class="btn btn-warning text-white">
                    <i class="fas fa-edit me-1"></i> Editar
                </a>
            </div>
        </div>
    </div>
</x-guest-layout>

<x-guest-layout>
    <div class="container py-4">

        <!-- Encabezado -->
        <div class="bg-info bg-gradient text-white rounded-3 p-3 mb-4 d-flex flex-wrap align-items-start gap-3">
            <div class="rounded-circle bg-white bg-opacity-25 d-flex align-items-center justify-content-center" style="width: 48px; height: 48px;">
                <i class="fas fa-chalkboard-teacher fs-5"></i>
            </div>
            <div class="flex-grow-1">
                <h2 class="h6 mb-1">Detalles del Grado</h2>
                <p class="mb-0 small">Información completa del grado registrado</p>
            </div>
        </div>

        <!-- Tarjeta de información -->
        <div class="bg-white rounded-3 shadow-sm p-4">
            <!-- Sección: Información general -->
            <div class="mb-4">
                <div class="d-flex align-items-center text-primary mb-3">
                    <i class="fas fa-info-circle me-2"></i>
                    <h5 class="mb-0">Información del Grado</h5>
                </div>

                <div class="row g-3">
                    <div class="col-md-6">
                        <small class="text-muted">Curso</small>
                        <div class="fw-semibold text-dark">{{ $grado->curso }}</div>
                    </div>

                    <div class="col-md-6">
                        <small class="text-muted">Modalidad</small>
                        <div class="fw-semibold text-dark">{{ $grado->modalidad }}</div>
                    </div>

                    <div class="col-md-6">
                        <small class="text-muted">Jornada</small>
                        <div class="fw-semibold text-dark">{{ $grado->jornada }}</div>
                    </div>

                    <div class="col-md-2">
                        <small class="text-muted">Sección</small>
                        <div class="fw-semibold text-dark">{{ $grado->seccion }}</div>
                    </div>

                    <div class="col-md-4">
                        <small class="text-muted">Matrícula actual</small>
                        <div class="fw-semibold text-dark">{{ $grado->matricula }} alumnos</div>
                    </div>
                </div>
            </div>

            <!-- Botones -->
            <div class="mt-4 d-flex justify-content-end gap-2">
                <a href="{{ route('grados.index') }}" class="btn btn-outline-secondary">
                    <i class="fas fa-arrow-left me-1"></i> Volver
                </a>
                <a href="{{ route('grados.edit', $grado->id) }}" class="btn btn-warning text-white">
                    <i class="fas fa-edit me-1"></i> Editar
                </a>
            </div>
        </div>
    </div>
</x-guest-layout>

<x-guest-layout>
    <div class="container py-4">

        <!-- Encabezado -->
        <div class="bg-info bg-gradient text-white rounded-3 p-3 mb-4 d-flex align-items-start gap-3">
            <div class="rounded-circle bg-white bg-opacity-25 d-flex align-items-center justify-content-center"
                 style="width: 48px; height: 48px;">
                <i class="fas fa-book-reader fs-5"></i>
            </div>
            <div class="flex-grow-1">
                <h2 class="h6 mb-1">Detalles de la Asignatura</h2>
                <p class="mb-0 small">Información completa de la asignatura registrada</p>
            </div>
        </div>

        <!-- Detalles -->
        <div class="bg-white rounded-3 shadow-sm p-4">
            <div class="mb-4">
                <div class="d-flex align-items-center text-primary mb-3">
                    <i class="fas fa-info-circle me-2"></i>
                    <h5 class="mb-0">Información General</h5>
                </div>

                <div class="row g-3">
                    <div class="col-md-6">
                        <small class="text-muted">Nombre</small>
                        <div class="fw-semibold text-dark">{{ $asignatura->nombre }}</div>
                    </div>

                    <div class="col-md-6">
                        <small class="text-muted">Creada</small>
                        <div class="fw-semibold text-dark">
                            {{ $asignatura->created_at->format('d/m/Y') }}
                        </div>
                    </div>
                </div>
            </div>

            <div class="mt-4 d-flex justify-content-end gap-2">
                <a href="{{ route('asignaturas.index') }}" class="btn btn-outline-secondary">
                    <i class="fas fa-arrow-left me-1"></i> Volver
                </a>
                <a href="{{ route('asignaturas.edit', $asignatura->id) }}" class="btn btn-warning text-white">
                    <i class="fas fa-edit me-1"></i> Editar
                </a>
            </div>
        </div>
    </div>
</x-guest-layout>

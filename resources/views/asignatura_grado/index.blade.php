<x-guest-layout>
    <div class="container py-4">

        <!-- Contenedor principal -->
        <div class="bg-light border rounded-3 px-3 py-4 shadow-sm">

            <!-- Encabezado -->
            <div class="d-flex flex-column flex-md-row justify-content-between align-items-start align-items-md-center mb-4 gap-3">
                <h2 class="h4 text-primary-emphasis fw-bold m-0">Asignaturas por Grado</h2>
            </div>

            <!-- Tarjetas de Grados -->
            <div class="row row-cols-1 row-cols-md-2 g-3">
                @forelse($grados as $index => $grado)
                    <div class="col">
                        <div class="card shadow-sm border-0 rounded-4 h-100">
                            <div class="card-body d-flex flex-column justify-content-between">

                                <!-- Título del grado -->
                                <div class="mb-3">
                                    <div class="d-flex justify-content-between align-items-start mb-2">
                                        <h5 class="card-title fw-bold text-primary-emphasis mb-0">
                                            {{ $grado->curso }} - {{ $grado->modalidad }} - Sección {{ $grado->seccion }}
                                        </h5>
                                        <span class="badge bg-light text-muted">{{ $grado->jornada }}</span>
                                    </div>

                                    <!-- Asignaturas -->
                                    @if($grado->asignaturas->isEmpty())
                                        <p class="text-muted fst-italic">No hay asignaturas asignadas a este grado.</p>
                                    @else
                                        <ul class="mb-0">
                                            @foreach($grado->asignaturas as $asignatura)
                                                <li>{{ $asignatura->nombre }}</li>
                                            @endforeach
                                        </ul>
                                    @endif
                                </div>

                                <!-- Botón Asignar -->
                                <div class="d-flex justify-content-end gap-2 mt-auto">
                                    <a href="{{ route('grados.asignaturas.edit', $grado->id) }}" class="btn btn-sm btn-primary" title="Asignar asignaturas">
                                        <i class="fas fa-edit me-1"></i> Asignar
                                    </a>
                                </div>

                            </div>
                        </div>
                    </div>
                @empty
                    <div class="col-12">
                        <div class="text-center text-muted py-3">No se encontraron grados disponibles.</div>
                    </div>
                @endforelse
            </div>

            <!-- Paginación -->
            @if ($grados->hasPages())
                <div class="d-flex flex-column flex-md-row justify-content-between align-items-center mt-4 gap-2">
                    <div class="text-muted small mb-2 mb-md-0">
                        Mostrando {{ $grados->firstItem() }} a {{ $grados->lastItem() }} de {{ $grados->total() }} resultados
                    </div>
                    <div>
                        {{ $grados->links('pagination::bootstrap-5') }}
                    </div>
                </div>
            @endif

        </div>
    </div>
</x-guest-layout>

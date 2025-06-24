<x-guest-layout>
    <div class="container py-4">

        <div class="bg-light border rounded-3 px-3 py-4 shadow-sm">

            <!-- Toasts -->
            @if(session('status'))
                <div class="toast align-items-center text-bg-success border-0 show position-fixed top-0 end-0 m-4" role="alert">
                    <div class="d-flex">
                        <div class="toast-body">{{ session('status') }}</div>
                        <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast" aria-label="Cerrar"></button>
                    </div>
                </div>
            @endif

            @if(session('error'))
                <div class="toast align-items-center text-bg-danger border-0 show position-fixed top-0 end-0 m-4" role="alert">
                    <div class="d-flex">
                        <div class="toast-body">{{ session('error') }}</div>
                        <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast" aria-label="Cerrar"></button>
                    </div>
                </div>
            @endif

            <!-- Encabezado y acciones -->
            <div class="d-flex flex-column flex-md-row justify-content-between align-items-start align-items-md-center mb-4 gap-3">
                <h2 class="h4 text-primary-emphasis fw-bold m-0">Calificaciones</h2>

                <div class="d-flex flex-wrap align-items-stretch gap-2">
                    <form method="GET" action="{{ route('calificaciones.index') }}" class="d-flex" style="flex: 1 1 auto; min-width: 240px;">
                        <div class="input-group">
                            <input type="text" name="search" value="{{ request('search') }}" class="form-control" placeholder="Buscar por alumno, asignatura o tipo">
                            <button type="submit" class="btn btn-outline-primary" title="Buscar">
                                <i class="fas fa-search"></i>
                            </button>
                        </div>
                    </form>

                    <a href="{{ route('calificaciones.index') }}" class="btn btn-outline-secondary d-flex align-items-center justify-content-center" title="Restablecer">
                        <i class="fas fa-sync-alt"></i>
                    </a>

                    <a href="{{ route('calificaciones.create') }}" class="btn btn-success d-flex align-items-center justify-content-center" title="Agregar nueva calificación">
                        <i class="fas fa-plus"></i> <span class="d-none d-sm-inline ms-1">Nueva</span>
                    </a>
                </div>
            </div>

            <!-- Tabla de Calificaciones -->
            <div class="table-responsive">
                <table class="table table-bordered table-hover align-middle text-center table-sm">
                    <thead class="table-dark">
                    <tr>
                        <th style="width: 50px;">N°</th>
                        <th>Alumno</th>
                        <th>Grado</th>
                        <th>Asignatura</th>
                        <th>Tipo</th>
                        <th>Nota</th>
                        <th>Acciones</th>
                    </tr>
                    </thead>
                    <tbody class="table-light">
                    @forelse($calificaciones as $index => $calificacion)
                        <tr>
                            <td class="fw-bold">{{ $calificaciones->firstItem() + $index }}</td>
                            <td class="text-start fw-semibold">{{ $calificacion->alumno->nombre_completo }}</td>
                            <td>{{ $calificacion->grado->curso }} - {{ $calificacion->grado->seccion }} ({{ $calificacion->grado->jornada }})</td>
                            <td>{{ $calificacion->asignatura->nombre }}</td>
                            <td><span class="badge bg-info text-dark">{{ $calificacion->tipo }}</span></td>
                            <td><span class="badge bg-success">{{ number_format($calificacion->nota, 2) }}</span></td>
                            <td>
                                <div class="d-flex justify-content-center gap-2">
                                    <a href="{{ route('calificaciones.show', $calificacion->id) }}" class="btn btn-sm btn-outline-primary" title="Ver">
                                        <i class="fas fa-eye"></i>
                                    </a>
                                    <a href="{{ route('calificaciones.edit', $calificacion->id) }}" class="btn btn-sm btn-outline-warning" title="Editar">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <button class="btn btn-sm btn-outline-danger delete-btn" data-id="{{ $calificacion->id }}" title="Eliminar">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="text-center text-muted">No se encontraron calificaciones registradas.</td>
                        </tr>
                    @endforelse
                    </tbody>
                </table>
            </div>

            <!-- Paginación -->
            @if ($calificaciones->hasPages())
                <div class="d-flex flex-column flex-md-row justify-content-between align-items-center mt-4 gap-2">
                    <div class="text-muted small mb-2 mb-md-0">
                        Mostrando {{ $calificaciones->firstItem() }} a {{ $calificaciones->lastItem() }} de {{ $calificaciones->total() }} resultados
                    </div>
                    <div>
                        {!! $calificaciones->onEachSide(1)->links('pagination::bootstrap-5') !!}
                    </div>
                </div>
            @endif

        </div>

        <!-- Modal de Confirmación -->
        <div id="confirm-delete-modal" class="modal fade" tabindex="-1">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header bg-danger text-white">
                        <h5 class="modal-title">¿Eliminar calificación?</h5>
                        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Cerrar"></button>
                    </div>
                    <div class="modal-body">
                        <p>Esta acción no se puede deshacer. La calificación será eliminada permanentemente.</p>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                        <form id="delete-form" method="POST" action="">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger">Eliminar</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <!-- Scripts -->
        <script>
            document.querySelectorAll('.delete-btn').forEach(button => {
                button.addEventListener('click', function () {
                    const id = this.getAttribute('data-id');
                    const form = document.getElementById('delete-form');
                    form.action = `/calificaciones/${id}`;
                    new bootstrap.Modal(document.getElementById('confirm-delete-modal')).show();
                });
            });

            setTimeout(() => {
                document.querySelectorAll('.toast').forEach(toast => toast.classList.remove('show'));
            }, 3500);
        </script>

    </div>
</x-guest-layout>

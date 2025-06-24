<x-guest-layout>
    <div class="container py-4">

        <!-- Contenedor completo: Encabezado + Tabla + Paginación -->
        <div class="bg-light border rounded-3 px-3 py-4 shadow-sm">

            <!-- Toasts -->
            @if(session('status'))
                <div class="toast align-items-center text-bg-success border-0 show position-fixed top-0 end-0 m-4" role="alert">
                    <div class="d-flex">
                        <div class="toast-body">
                            {{ session('status') }}
                        </div>
                        <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast" aria-label="Cerrar"></button>
                    </div>
                </div>
            @endif

            @if(session('error'))
                <div class="toast align-items-center text-bg-danger border-0 show position-fixed top-0 end-0 m-4" role="alert">
                    <div class="d-flex">
                        <div class="toast-body">
                            {{ session('error') }}
                        </div>
                        <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast" aria-label="Cerrar"></button>
                    </div>
                </div>
            @endif

            <!-- Encabezado y Acciones -->
            <div class="d-flex flex-column flex-md-row justify-content-between align-items-start align-items-md-center mb-4 gap-3">
                <h2 class="h4 text-primary-emphasis fw-bold m-0">Alumnos</h2>

                <div class="d-flex flex-wrap align-items-stretch gap-2">
                    <form method="GET" action="{{ route('alumnos.index') }}" class="d-flex" style="flex: 1 1 auto; min-width: 240px;">
                        <div class="input-group">
                            <input type="text" name="search" value="{{ request('search') }}" class="form-control" placeholder="Buscar por nombre o ID">
                            <button type="submit" class="btn btn-outline-primary" title="Buscar">
                                <i class="fas fa-search"></i>
                            </button>
                        </div>
                    </form>

                    <a href="{{ route('alumnos.index') }}" class="btn btn-outline-secondary d-flex align-items-center justify-content-center" title="Restablecer">
                        <i class="fas fa-sync-alt"></i>
                    </a>

                    <a href="{{ route('alumnos.create') }}" class="btn btn-success d-flex align-items-center justify-content-center" title="Agregar nuevo alumno">
                        <i class="fas fa-user-plus"></i> <span class="d-none d-sm-inline ms-1">Nuevo</span>
                    </a>
                </div>
            </div>

            <!-- Tabla de Alumnos -->
            <div class="table-responsive">
                <table class="table table-bordered table-hover align-middle text-center table-sm">
                    <thead class="table-dark">
                    <tr>
                        <th style="width: 50px;">N°</th>
                        <th>Nombre completo</th>
                        <th>Teléfono</th>
                        <th>Número de Identidad</th>
                        <th>Acciones</th>
                    </tr>
                    </thead>
                    <tbody class="table-light">
                    @forelse($alumnos as $index => $alumno)
                        <tr>
                            <td class="text-start fw-semibold">{{ $alumnos->firstItem() + $index }}</td>
                            <td class="text-start fw-semibold">{{ $alumno->nombre_completo }}</td>
                            <td>
                                <span class="badge bg-info text-dark">
                                    {{ substr($alumno->telefono, 0, 4) . ' - ' . substr($alumno->telefono, 4, 4) }}
                                </span>
                            </td>
                            <td>
                                <span class="badge bg-warning text-dark">
                                    {{ substr($alumno->numero_identidad, 0, 4) . ' - ' . substr($alumno->numero_identidad, 4, 4) . ' - ' . substr($alumno->numero_identidad, 8, 5) }}
                                </span>
                            </td>
                            <td>
                                <div class="d-flex justify-content-center gap-2">
                                    <a href="{{ route('alumnos.show', $alumno->id) }}" class="btn btn-sm btn-outline-primary" title="Ver detalles">
                                        <i class="fas fa-eye"></i>
                                    </a>
                                    <a href="{{ route('alumnos.edit', $alumno->id) }}" class="btn btn-sm btn-outline-warning" title="Editar alumno">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <button class="btn btn-sm btn-outline-danger delete-btn" data-user-id="{{ $alumno->id }}" title="Eliminar alumno">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="text-center text-muted">No se encontraron alumnos registrados.</td>
                        </tr>
                    @endforelse
                    </tbody>
                </table>
            </div>

            <!-- Paginación -->
            @if ($alumnos->hasPages())
                <div class="d-flex flex-column flex-md-row justify-content-between align-items-center mt-4 gap-2">
                    <!-- Texto a la izquierda -->
                    <div class="text-muted small mb-2 mb-md-0">
                        Mostrando {{ $alumnos->firstItem() }} a {{ $alumnos->lastItem() }} de {{ $alumnos->total() }} resultados
                    </div>

                    <!-- Controles a la derecha -->
                    <div>
                        {!! $alumnos->onEachSide(1)->links('pagination::bootstrap-5') !!}
                    </div>
                </div>
            @endif
        </div>

        <!-- Modal de Confirmación de Eliminación -->
        <div id="confirm-delete-modal" class="modal fade" tabindex="-1">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header bg-danger text-white">
                        <h5 class="modal-title">¿Estás seguro de eliminar?</h5>
                        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Cerrar"></button>
                    </div>
                    <div class="modal-body">
                        <p>Esta acción no se puede deshacer. El alumno será eliminado permanentemente.</p>
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
                    const userId = this.getAttribute('data-user-id');
                    const form = document.getElementById('delete-form');
                    form.action = `/alumnos/${userId}`;
                    new bootstrap.Modal(document.getElementById('confirm-delete-modal')).show();
                });
            });

            setTimeout(() => {
                document.querySelectorAll('.toast').forEach(toast => toast.classList.remove('show'));
            }, 3500);
        </script>

    </div>
</x-guest-layout>

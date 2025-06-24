<x-guest-layout>
    <div class="container py-4">

        <!-- Contenedor completo -->
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
                <h2 class="h4 text-primary-emphasis fw-bold m-0">Grados / Secciones</h2>

                <div class="d-flex flex-wrap align-items-stretch gap-2">
                    <!-- Buscar -->
                    <form method="GET" action="{{ route('grados.index') }}" class="d-flex" style="flex: 1 1 auto; min-width: 240px;">
                        <div class="input-group">
                            <input type="text" name="search" value="{{ request('search') }}" class="form-control" placeholder="Buscar grados o secciones">
                            <button type="submit" class="btn btn-outline-primary" title="Buscar">
                                <i class="fas fa-search"></i>
                            </button>
                        </div>
                    </form>

                    <!-- Restablecer -->
                    <a href="{{ route('grados.index') }}" class="btn btn-outline-secondary d-flex align-items-center justify-content-center" title="Restablecer">
                        <i class="fas fa-sync-alt"></i>
                    </a>

                    <!-- Nuevo grado -->
                    <a href="{{ route('grados.create') }}" class="btn btn-success d-flex align-items-center justify-content-center" title="Agregar nuevo grado">
                        <i class="fas fa-plus"></i> <span class="d-none d-sm-inline ms-1">Nuevo</span>
                    </a>

                    <!-- Matricular -->
                    <a href="{{ route('matriculas.create') }}" class="btn btn-primary d-flex align-items-center justify-content-center" title="Matricular alumnos">
                        <i class="fas fa-user-graduate"></i> <span class="d-none d-sm-inline ms-1">Matricular</span>
                    </a>
                </div>
            </div>

            <!-- Tabla de Grados -->
            <div class="table-responsive">
                <table class="table table-bordered table-hover align-middle text-center table-sm">
                    <thead class="table-dark">
                    <tr>
                        <th style="width: 50px;">N°</th>
                        <th>Modalidad</th>
                        <th>Curso</th>
                        <th>Sección</th>
                        <th>Jornada</th>
                        <th>Alumnos</th>
                        <th>Acciones</th>
                    </tr>
                    </thead>
                    <tbody class="table-light">
                    @forelse($grados as $index => $grado)
                        <tr>
                            <td class="text-center fw-semibold">{{ $grados->firstItem() + $index }}</td>
                            <td class="text-start fw-semibold">{{ $grado->modalidad }}</td>
                            <td>{{ $grado->curso }}</td>
                            <td>{{ $grado->seccion }}</td>
                            <td>{{ $grado->jornada }}</td>
                            <td><span class="badge bg-info text-dark">{{ $grado->matricula }}</span></td>
                            <td>
                                <div class="d-flex justify-content-center gap-2">
                                    <a href="{{ route('grados.show', $grado->id) }}" class="btn btn-sm btn-outline-primary" title="Ver detalles">
                                        <i class="fas fa-eye"></i>
                                    </a>
                                    <a href="{{ route('grados.edit', $grado->id) }}" class="btn btn-sm btn-outline-warning" title="Editar grado">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <button class="btn btn-sm btn-outline-danger delete-btn" data-user-id="{{ $grado->id }}" title="Eliminar grado">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="text-center text-muted">No se encontraron grados registrados.</td>
                        </tr>
                    @endforelse
                    </tbody>
                </table>
            </div>

            <!-- Paginación -->
            @if ($grados->hasPages())
                <div class="d-flex flex-column flex-md-row justify-content-between align-items-center mt-4 gap-2">
                    <div class="text-muted small mb-2 mb-md-0">
                        Mostrando {{ $grados->firstItem() }} a {{ $grados->lastItem() }} de {{ $grados->total() }} resultados
                    </div>
                    <div>
                        {!! $grados->onEachSide(1)->links('pagination::bootstrap-5') !!}
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
                        <p>Esta acción no se puede deshacer. El grado será eliminado permanentemente.</p>
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
                    form.action = `/grados/${userId}`;
                    new bootstrap.Modal(document.getElementById('confirm-delete-modal')).show();
                });
            });

            setTimeout(() => {
                document.querySelectorAll('.toast').forEach(toast => toast.classList.remove('show'));
            }, 3500);
        </script>

    </div>
</x-guest-layout>

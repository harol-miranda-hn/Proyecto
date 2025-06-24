<x-guest-layout>
    <div class="container py-4">

        <!-- Contenedor -->
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

            <!-- Encabezado y acciones -->
            <div class="d-flex flex-column flex-md-row justify-content-between align-items-start align-items-md-center mb-4 gap-3">
                <h2 class="h4 text-primary-emphasis fw-bold m-0">Proyectos</h2>
                <a href="{{ route('projects.create') }}" class="btn btn-success d-flex align-items-center justify-content-center" title="Agregar proyecto">
                    <i class="fas fa-plus me-1"></i> <span class="d-none d-sm-inline">Agregar proyecto</span>
                </a>
            </div>

            <!-- Tabla de Proyectos -->
            <div class="table-responsive">
                <table class="table table-bordered table-hover align-middle text-center table-sm">
                    <thead class="table-dark">
                    <tr>
                        <th style="width: 50px;">N°</th>
                        <th>Nombre del Proyecto</th>
                        <th>Estudiante</th>
                        <th>Profesor</th>
                        <th>Estado</th>
                        <th>Acciones</th>
                    </tr>
                    </thead>
                    <tbody class="table-light">
                    @forelse ($projects as $index => $project)
                        <tr>
                            <td class="text-start fw-semibold">{{ $projects->firstItem() + $index }}</td>

                            <td class="text-start fw-semibold">{{ $project->name }}</td>
                            <td class="text-start">{{ $project->student->name }}</td>
                            <td class="text-start">{{ $project->professor->name }}</td>
                            <td>
                                    <span class="badge {{ $project->status == 'activo' ? 'bg-success' : 'bg-secondary' }}">
                                        {{ ucfirst($project->status) }}
                                    </span>
                            </td>
                            <td>
                                <div class="d-flex justify-content-center gap-2">
                                    <a href="{{ route('projects.show', $project->id) }}" class="btn btn-sm btn-outline-primary" title="Ver">
                                        <i class="fas fa-eye"></i>
                                    </a>
                                    <a href="{{ route('projects.edit', $project->id) }}" class="btn btn-sm btn-outline-warning" title="Editar">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <button class="btn btn-sm btn-outline-danger delete-btn" data-project-id="{{ $project->id }}" title="Eliminar">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="text-center text-muted">No se encontraron proyectos registrados.</td>
                        </tr>
                    @endforelse
                    </tbody>
                </table>
            </div>

            <!-- Paginación -->
            @if ($projects->hasPages())
                <div class="d-flex flex-column flex-md-row justify-content-between align-items-center mt-4 gap-2">
                    <div class="text-muted small mb-2 mb-md-0">
                        Mostrando {{ $projects->firstItem() }} a {{ $projects->lastItem() }} de {{ $projects->total() }} resultados
                    </div>
                    <div>
                        {!! $projects->onEachSide(1)->appends(request()->query())->links('pagination::bootstrap-5') !!}
                    </div>
                </div>
            @endif
        </div>

        <!-- Modal de Confirmación de Eliminación -->
        <div id="confirm-delete-modal" class="modal fade" tabindex="-1">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header bg-danger text-white">
                        <h5 class="modal-title">¿Eliminar proyecto?</h5>
                        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Cerrar"></button>
                    </div>
                    <div class="modal-body">
                        <p>Esta acción no se puede deshacer. El proyecto será eliminado permanentemente.</p>
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
                    const projectId = this.getAttribute('data-project-id');
                    const form = document.getElementById('delete-form');
                    form.action = `/projects/${projectId}`;
                    new bootstrap.Modal(document.getElementById('confirm-delete-modal')).show();
                });
            });

            setTimeout(() => {
                document.querySelectorAll('.toast').forEach(toast => toast.classList.remove('show'));
            }, 3000);
        </script>

    </div>
</x-guest-layout>

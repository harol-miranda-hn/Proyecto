<x-guest-layout>
    <div class="container py-4">

        <!-- Contenedor principal -->
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

            <!-- Encabezado -->
            <div class="d-flex flex-column flex-md-row justify-content-between align-items-start align-items-md-center mb-4 gap-3">
                <h2 class="h4 text-primary-emphasis fw-bold m-0">Proyectos</h2>
                <a href="{{ route('projects.create') }}" class="btn btn-success d-flex align-items-center justify-content-center" title="Agregar proyecto">
                    <i class="fas fa-plus me-1"></i> <span class="d-none d-sm-inline">Agregar proyecto</span>
                </a>
            </div>

            <!-- Tarjetas de Proyectos -->
            <div class="row row-cols-1 row-cols-md-2 g-3">
                @forelse($projects as $index => $project)
                    <div class="col">
                        <div class="card shadow-sm border-0 rounded-4 h-100">
                            <div class="card-body d-flex flex-column justify-content-between">
                                <div class="mb-3">
                                    <div class="d-flex justify-content-between align-items-start mb-2">
                                        <h5 class="card-title fw-bold text-primary-emphasis mb-0">
                                            {{ $project->name }}
                                        </h5>
                                        <span class="badge bg-light text-muted">#{{ $projects->firstItem() + $index }}</span>
                                    </div>

                                    <p class="card-text text-muted mb-1">
                                        <i class="fas fa-user-graduate me-2 text-secondary"></i>
                                        <strong>Estudiante:</strong> {{ $project->student->name }}
                                    </p>

                                    <p class="card-text text-muted mb-1">
                                        <i class="fas fa-chalkboard-teacher me-2 text-secondary"></i>
                                        <strong>Profesor:</strong> {{ $project->professor->name }}
                                    </p>

                                    <p class="card-text">
                                        <span class="badge {{ $project->status === 'activo' ? 'bg-success' : 'bg-secondary' }}">
                                            {{ ucfirst($project->status) }}
                                        </span>
                                    </p>
                                </div>

                                <div class="d-flex justify-content-end gap-2 mt-auto">
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
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="col-12">
                        <div class="text-center text-muted py-3">No se encontraron proyectos registrados.</div>
                    </div>
                @endforelse
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
    </div>
</x-guest-layout>

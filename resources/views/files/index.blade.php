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
                <h2 class="h4 text-primary-emphasis fw-bold m-0">Archivos</h2>
                <a href="{{ route('files.create') }}" class="btn btn-success d-flex align-items-center justify-content-center" title="Subir archivo">
                    <i class="fas fa-upload me-1"></i> <span class="d-none d-sm-inline">Subir Archivo</span>
                </a>
            </div>

            <!-- Tarjetas de Archivos -->
            <div class="row row-cols-1 row-cols-md-2 g-3">
                @forelse($files as $index => $file)
                    <div class="col">
                        <div class="card shadow-sm border-0 rounded-4 h-100">
                            <div class="card-body d-flex flex-column justify-content-between">
                                <div class="mb-3">
                                    <div class="d-flex justify-content-between align-items-start mb-2">
                                        <h5 class="card-title fw-bold text-primary-emphasis mb-0">
                                            {{ $file->name }}
                                        </h5>
                                        <span class="badge bg-light text-muted">#{{ $files->firstItem() + $index }}</span>
                                    </div>

                                    <p class="card-text text-muted mb-2">
                                        <i class="fas fa-project-diagram me-2 text-secondary"></i>
                                        {{ $file->project->name }}
                                    </p>
                                </div>

                                <div class="d-flex justify-content-end gap-2 mt-auto">
                                    <a href="{{ route('files.download', $file->id) }}" class="btn btn-sm btn-outline-success" title="Descargar">
                                        <i class="fas fa-download"></i>
                                    </a>
                                    <button class="btn btn-sm btn-outline-danger delete-btn" data-file-id="{{ $file->id }}" title="Eliminar archivo">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="col-12">
                        <div class="text-center text-muted py-3">No se encontraron archivos.</div>
                    </div>
                @endforelse
            </div>

            <!-- Paginación -->
            @if ($files->hasPages())
                <div class="d-flex flex-column flex-md-row justify-content-between align-items-center mt-4 gap-2">
                    <div class="text-muted small mb-2 mb-md-0">
                        Mostrando {{ $files->firstItem() }} a {{ $files->lastItem() }} de {{ $files->total() }} resultados
                    </div>
                    <div>
                        {!! $files->onEachSide(1)->links('pagination::bootstrap-5') !!}
                    </div>
                </div>
            @endif

            <!-- Modal de confirmación -->
            <div id="confirm-delete-modal" class="modal fade" tabindex="-1">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-header bg-danger text-white">
                            <h5 class="modal-title">¿Eliminar archivo?</h5>
                            <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Cerrar"></button>
                        </div>
                        <div class="modal-body">
                            <p>Esta acción no se puede deshacer. El archivo será eliminado permanentemente.</p>
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
                        const fileId = this.getAttribute('data-file-id');
                        const form = document.getElementById('delete-form');
                        form.action = `/files/${fileId}`;
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

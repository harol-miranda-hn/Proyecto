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

            <!-- Encabezado -->
            <div class="d-flex flex-column flex-md-row justify-content-between align-items-start align-items-md-center mb-4 gap-3">
                <h2 class="h4 text-primary-emphasis fw-bold m-0">Archivos</h2>
                <a href="{{ route('files.create') }}" class="btn btn-success d-flex align-items-center justify-content-center" title="Subir archivo">
                    <i class="fas fa-upload me-1"></i> <span class="d-none d-sm-inline">Subir Archivo</span>
                </a>
            </div>

            <!-- Tabla de archivos -->
            <div class="table-responsive">
                <table class="table table-bordered table-hover align-middle text-center table-sm">
                    <thead class="table-dark">
                    <tr>
                        <th style="width: 50px;">N°</th>
                        <th>Nombre del Archivo</th>
                        <th>Proyecto Asociado</th>
                        <th>Acciones</th>
                    </tr>
                    </thead>
                    <tbody class="table-light">
                    @forelse ($files as $index => $file)
                        <tr>
                            <td class="text-center fw-semibold">{{ $files->firstItem() + $index }}</td>
                            <td class="text-start fw-semibold">{{ $file->name }}</td>
                            <td class="text-start">{{ $file->project->name }}</td>
                            <td>
                                <div class="d-flex justify-content-center gap-2">
                                    <a href="{{ route('files.download', $file->id) }}" class="btn btn-sm btn-outline-success" title="Descargar">
                                        <i class="fas fa-download"></i>
                                    </a>
                                    <button class="btn btn-sm btn-outline-danger delete-btn" data-file-id="{{ $file->id }}" title="Eliminar archivo">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="3" class="text-center text-muted">No se encontraron archivos.</td>
                        </tr>
                    @endforelse
                    </tbody>
                </table>
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
        </div>

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
</x-guest-layout>

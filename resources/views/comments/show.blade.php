<x-guest-layout>
    <div class="container py-4">
        <!-- Encabezado -->
        <div class="bg-info bg-gradient text-white rounded-3 p-3 mb-4 d-flex flex-wrap align-items-start gap-3">
            <div class="rounded-circle bg-white bg-opacity-25 d-flex align-items-center justify-content-center" style="width: 48px; height: 48px;">
                <i class="fas fa-comment-dots fs-5"></i>
            </div>
            <div class="flex-grow-1">
                <h2 class="h6 mb-1">Detalles del Comentario</h2>
                <p class="mb-0 small">Información completa del comentario registrado</p>
            </div>
        </div>

        <!-- Tarjeta de información -->
        <div class="bg-white rounded-3 shadow-sm p-4">
            <!-- Información del Comentario -->
            <div class="mb-4">
                <div class="d-flex align-items-center text-primary mb-3">
                    <i class="fas fa-quote-left me-2"></i>
                    <h5 class="mb-0">Contenido del Comentario</h5>
                </div>
                <div class="p-3 border rounded text-dark bg-light">
                    {{ $comment->content }}
                </div>
            </div>

            <hr class="my-4">

            <!-- Información Relacionada -->
            <div class="mb-4">
                <div class="d-flex align-items-center text-primary mb-3">
                    <i class="fas fa-link me-2"></i>
                    <h5 class="mb-0">Relaciones</h5>
                </div>

                <div class="row g-3">
                    <div class="col-md-6">
                        <small class="text-muted">Usuario que comentó</small>
                        <div class="fw-semibold text-dark">
                            {{ $comment->user->name }} <span class="text-muted small">({{ $comment->user->email }})</span>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <small class="text-muted">Proyecto relacionado</small>
                        <div class="fw-semibold text-dark">{{ $comment->project->name }}</div>
                    </div>
                </div>
            </div>

            <!-- Fechas -->
            <div class="row g-3">
                <div class="col-md-6">
                    <small class="text-muted">Creado el</small>
                    <div class="fw-semibold text-dark">
                        {{ \Carbon\Carbon::parse($comment->created_at)->locale('es')->translatedFormat('l d \d\e F, Y \a \l\a\s h:i A') }}
                    </div>
                </div>
                <div class="col-md-6">
                    <small class="text-muted">Última Actualización</small>
                    <div class="fw-semibold text-dark">
                        {{ \Carbon\Carbon::parse($comment->updated_at)->locale('es')->translatedFormat('l d \d\e F, Y \a \l\a\s h:i A') }}
                    </div>
                </div>
            </div>

            <!-- Botones -->
            <div class="mt-4 d-flex justify-content-end gap-2">
                <a href="{{ route('comments.index') }}" class="btn btn-outline-secondary">
                    <i class="fas fa-arrow-left me-1"></i> Volver
                </a>
                <a href="{{ route('comments.edit', $comment->id) }}" class="btn btn-warning text-white">
                    <i class="fas fa-edit me-1"></i> Editar
                </a>
            </div>
        </div>
    </div>
</x-guest-layout>

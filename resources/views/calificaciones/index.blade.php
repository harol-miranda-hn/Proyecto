<x-guest-layout>
    <div class="container py-4">

        <!-- Contenedor completo -->
        <div class="px-4 py-4 shadow rounded-4 border" style="background-color: #fafafa;">

            <!-- Toasts -->
            @if(session('status'))
                <div class="toast align-items-center border-0 show position-fixed top-0 end-0 m-4 text-white"
                     role="alert" style="background-color: #388e3c;">
                    <div class="d-flex">
                        <div class="toast-body">{{ session('status') }}</div>
                        <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast" aria-label="Cerrar"></button>
                    </div>
                </div>
            @endif

            @if(session('error'))
                <div class="toast align-items-center border-0 show position-fixed top-0 end-0 m-4 text-white"
                     role="alert" style="background-color: #b00020;">
                    <div class="d-flex">
                        <div class="toast-body">{{ session('error') }}</div>
                        <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast" aria-label="Cerrar"></button>
                    </div>
                </div>
            @endif

            <!-- Encabezado y acciones -->
            <div class="d-flex flex-column flex-md-row justify-content-between align-items-start align-items-md-center mb-4 gap-3">
                <h2 class="h4 fw-bold m-0" style="color: #6200ea;">Calificaciones</h2>

                <div class="d-flex flex-wrap align-items-stretch gap-2">
                    <form method="GET" action="{{ route('calificaciones.index') }}" class="d-flex" style="flex: 1 1 auto; min-width: 240px;">
                        <div class="input-group">
                            <input type="text" name="search" value="{{ request('search') }}" class="form-control" placeholder="Buscar por alumno, asignatura o tipo">
                            <button type="submit" class="btn" style="border-color: #6200ea; color: #6200ea;" title="Buscar">
                                <i class="fas fa-search"></i>
                            </button>
                        </div>
                    </form>

                    <a href="{{ route('calificaciones.index') }}" class="btn" style="border-color: #03dac6; color: #03dac6;" title="Restablecer">
                        <i class="fas fa-sync-alt"></i>
                    </a>

                    <a href="{{ route('calificaciones.create') }}" class="btn text-white rounded-pill px-3" style="background-color: #6200ea;" title="Agregar nueva calificación">
                        <i class="fas fa-plus"></i> <span class="d-none d-sm-inline ms-1">Nueva</span>
                    </a>
                </div>
            </div>

            @if($calificaciones->count())
                <!-- Tabla para escritorio -->
                <div class="table-responsive d-none d-md-block">
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
                        <tbody style="background-color: #ffffff;">
                        @foreach($calificaciones as $index => $calificacion)
                            <tr>
                                <td class="fw-semibold">{{ $calificaciones->firstItem() + $index }}</td>
                                <td class="text-start fw-semibold">{{ $calificacion->alumno->nombre_completo }}</td>
                                <td>{{ $calificacion->grado->curso }} - {{ $calificacion->grado->seccion }} ({{ $calificacion->grado->jornada }})</td>
                                <td>{{ $calificacion->asignatura->nombre }}</td>
                                <td>
                        <span class="badge rounded-pill px-3 py-2 text-dark" style="background-color: #b3e5fc;">
                            {{ $calificacion->tipo }}
                        </span>
                                </td>
                                <td>
                        <span class="badge rounded-pill px-3 py-2 text-white" style="background-color: #388e3c;">
                            {{ number_format($calificacion->nota, 2) }}
                        </span>
                                </td>
                                <td>
                                    <div class="d-flex justify-content-center gap-2">
                                        <a href="{{ route('calificaciones.show', $calificacion->id) }}" class="btn btn-sm text-white rounded-circle" style="background-color: #0288d1;" title="Ver detalles">
                                            <i class="fas fa-eye"></i>
                                        </a>
                                        <a href="{{ route('calificaciones.edit', $calificacion->id) }}" class="btn btn-sm text-white rounded-circle" style="background-color: #fbc02d;" title="Editar calificación">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        <button class="btn btn-sm text-white rounded-circle delete-btn" style="background-color: #b00020;" data-id="{{ $calificacion->id }}" title="Eliminar calificación">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>

                <!-- Tarjetas para móviles -->
                <div class="d-md-none">
                    @foreach($calificaciones as $index => $calificacion)
                        <div class="card shadow-sm mb-3 border-0 rounded-4">
                            <div class="card-body">
                                <div class="d-flex justify-content-between align-items-center mb-2">
                                    <h6 class="mb-0 fw-bold" style="color: #6200ea;">{{ $calificacion->alumno->nombre_completo }}</h6>
                                    <span class="badge" style="background-color: #eeeeee; color: #757575;">#{{ $calificaciones->firstItem() + $index }}</span>
                                </div>
                                <ul class="list-group list-group-flush small mb-2">
                                    <li class="list-group-item px-0 py-1 border-0">
                                        <i class="fas fa-graduation-cap me-2 text-secondary"></i>
                                        {{ $calificacion->grado->curso }} - {{ $calificacion->grado->seccion }} ({{ $calificacion->grado->jornada }})
                                    </li>
                                    <li class="list-group-item px-0 py-1 border-0">
                                        <i class="fas fa-book me-2 text-secondary"></i>
                                        {{ $calificacion->asignatura->nombre }}
                                    </li>
                                    <li class="list-group-item px-0 py-1 border-0">
                                        <i class="fas fa-tag me-2 text-secondary"></i>
                                        <span class="badge rounded-pill px-3 py-2 text-dark" style="background-color: #b3e5fc;">{{ $calificacion->tipo }}</span>
                                    </li>
                                    <li class="list-group-item px-0 py-1 border-0">
                                        <i class="fas fa-star me-2 text-secondary"></i>
                                        <span class="badge rounded-pill px-3 py-2 text-white" style="background-color: #388e3c;">{{ number_format($calificacion->nota, 2) }}</span>
                                    </li>
                                </ul>
                                <div class="d-flex justify-content-end gap-2">
                                    <a href="{{ route('calificaciones.show', $calificacion->id) }}" class="btn btn-sm text-white rounded-circle" style="background-color: #0288d1;" title="Ver detalles">
                                        <i class="fas fa-eye"></i>
                                    </a>
                                    <a href="{{ route('calificaciones.edit', $calificacion->id) }}" class="btn btn-sm text-white rounded-circle" style="background-color: #fbc02d;" title="Editar calificación">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <button class="btn btn-sm text-white rounded-circle delete-btn" style="background-color: #b00020;" data-id="{{ $calificacion->id }}" title="Eliminar calificación">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            @else
                <div class="text-center text-muted py-3">No se encontraron calificaciones registradas.</div>
            @endif

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
                    <div class="modal-header text-white" style="background-color: #b00020;">
                        <h5 class="modal-title">¿Estás seguro de eliminar?</h5>
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
                            <button type="submit" class="btn text-white" style="background-color: #b00020;">Eliminar</button>
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

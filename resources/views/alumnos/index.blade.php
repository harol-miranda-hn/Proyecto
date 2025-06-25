<x-guest-layout>
    <div class="container py-4">

        <!-- Contenedor completo -->
        <div class="px-4 py-4 shadow rounded-4 border" style="background-color: #fafafa;">

            <!-- Toasts -->
            @if(session('status'))
                <div class="toast align-items-center border-0 show position-fixed top-0 end-0 m-4 text-white"
                     role="alert" style="background-color: #388e3c;">
                    <div class="d-flex">
                        <div class="toast-body">
                            {{ session('status') }}
                        </div>
                        <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast" aria-label="Cerrar"></button>
                    </div>
                </div>
            @endif

            @if(session('error'))
                <div class="toast align-items-center border-0 show position-fixed top-0 end-0 m-4 text-white"
                     role="alert" style="background-color: #b00020;">
                    <div class="d-flex">
                        <div class="toast-body">
                            {{ session('error') }}
                        </div>
                        <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast" aria-label="Cerrar"></button>
                    </div>
                </div>
            @endif

            <!-- Encabezado y acciones -->
            <div class="d-flex flex-column flex-md-row justify-content-between align-items-start align-items-md-center mb-4 gap-3">
                <h2 class="h4 fw-bold m-0" style="color: #6200ea;">Alumnos</h2>

                <div class="d-flex flex-wrap align-items-stretch gap-2">
                    <form method="GET" action="{{ route('alumnos.index') }}" class="d-flex" style="flex: 1 1 auto; min-width: 240px;">
                        <div class="input-group">
                            <input type="text" name="search" value="{{ request('search') }}" class="form-control" placeholder="Buscar por nombre o identidad">
                            <button type="submit" class="btn" style="border-color: #6200ea; color: #6200ea;" title="Buscar">
                                <i class="fas fa-search"></i>
                            </button>
                        </div>
                    </form>

                    <a href="{{ route('alumnos.index') }}" class="btn" style="border-color: #03dac6; color: #03dac6;" title="Restablecer">
                        <i class="fas fa-sync-alt"></i>
                    </a>

                    <a href="{{ route('alumnos.create') }}" class="btn text-white rounded-pill px-3" style="background-color: #6200ea;" title="Agregar nuevo alumno">
                        <i class="fas fa-user-plus"></i> <span class="d-none d-sm-inline ms-1">Nuevo</span>
                    </a>
                </div>
            </div>

            <!-- Tabla y tarjetas -->
            <div class="table-responsive">
                @if($alumnos->count())

                    <!-- Tabla para escritorio -->
                    <table class="table table-bordered table-hover align-middle table-sm d-none d-md-table">
                        <thead class="table-dark text-center">
                        <tr>
                            <th style="width: 50px;">N°</th>
                            <th>Nombre completo</th>
                            <th>Teléfono</th>
                            <th>Número de Identidad</th>
                            <th>Acciones</th>
                        </tr>
                        </thead>
                        <tbody style="background-color: #ffffff;">
                        @foreach($alumnos as $index => $alumno)
                            <tr>
                                <td class="text-center fw-semibold py-2">{{ $alumnos->firstItem() + $index }}</td>
                                <td class="text-start text-nowrap fw-semibold py-2">{{ $alumno->nombre_completo }}</td>
                                <td class="text-center">
                                    <span class="badge rounded-pill px-3 py-2 text-white" style="background-color: #0288d1;">
                                        {{ substr($alumno->telefono, 0, 4) . ' - ' . substr($alumno->telefono, 4, 4) }}
                                    </span>
                                </td>
                                <td class="text-center">
                                    <span class="badge rounded-pill px-3 py-2 text-dark" style="background-color: #ffecb3;">
                                        {{ substr($alumno->numero_identidad, 0, 4) . ' - ' . substr($alumno->numero_identidad, 4, 4) . ' - ' . substr($alumno->numero_identidad, 8, 5) }}
                                    </span>
                                </td>
                                <td>
                                    <div class="d-flex justify-content-center gap-2">
                                        <a href="{{ route('alumnos.show', $alumno->id) }}" class="btn btn-sm text-white rounded-circle" style="background-color: #0288d1;" title="Ver detalles">
                                            <i class="fas fa-eye"></i>
                                        </a>
                                        <a href="{{ route('alumnos.edit', $alumno->id) }}" class="btn btn-sm text-white rounded-circle" style="background-color: #fbc02d;" title="Editar alumno">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        <button class="btn btn-sm text-white rounded-circle delete-btn" style="background-color: #b00020;" data-user-id="{{ $alumno->id }}" title="Eliminar alumno">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>

                    <!-- Tarjetas para móviles -->
                    <div class="d-md-none">
                        @foreach($alumnos as $index => $alumno)
                            <div class="card shadow-sm mb-3 border-0 rounded-4">
                                <div class="card-body">
                                    <div class="d-flex justify-content-between align-items-center mb-2">
                                        <h6 class="mb-0 fw-bold" style="color: #6200ea;">{{ $alumno->nombre_completo }}</h6>
                                        <span class="badge" style="background-color: #eeeeee; color: #757575;">#{{ $alumnos->firstItem() + $index }}</span>
                                    </div>
                                    <ul class="list-group list-group-flush small mb-2">
                                        <li class="list-group-item px-0 py-1 border-0 d-flex align-items-center">
                                            <i class="fas fa-phone-alt me-2 text-secondary"></i>
                                            {{ substr($alumno->telefono, 0, 4) . ' - ' . substr($alumno->telefono, 4, 4) }}
                                        </li>
                                        <li class="list-group-item px-0 py-1 border-0 d-flex align-items-center">
                                            <i class="fas fa-id-card me-2 text-secondary"></i>
                                            {{ substr($alumno->numero_identidad, 0, 4) . ' - ' . substr($alumno->numero_identidad, 4, 4) . ' - ' . substr($alumno->numero_identidad, 8, 5) }}
                                        </li>
                                    </ul>
                                    <div class="d-flex justify-content-end gap-2">
                                        <a href="{{ route('alumnos.show', $alumno->id) }}" class="btn btn-sm text-white rounded-circle" style="background-color: #0288d1;" title="Ver detalles">
                                            <i class="fas fa-eye"></i>
                                        </a>
                                        <a href="{{ route('alumnos.edit', $alumno->id) }}" class="btn btn-sm text-white rounded-circle" style="background-color: #fbc02d;" title="Editar alumno">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        <button class="btn btn-sm text-white rounded-circle delete-btn" style="background-color: #b00020;" data-user-id="{{ $alumno->id }}" title="Eliminar alumno">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @else
                    <div class="text-center text-muted py-3">No se encontraron alumnos registrados.</div>
                @endif
            </div>

            <!-- Paginación -->
            @if ($alumnos->hasPages())
                <div class="d-flex flex-column flex-md-row justify-content-between align-items-center mt-4 gap-2">
                    <div class="text-muted small mb-2 mb-md-0">
                        Mostrando {{ $alumnos->firstItem() }} a {{ $alumnos->lastItem() }} de {{ $alumnos->total() }} resultados
                    </div>
                    <div>
                        {!! $alumnos->onEachSide(1)->links('pagination::bootstrap-5') !!}
                    </div>
                </div>
            @endif
        </div>

        <!-- Modal de confirmación de eliminación -->
        <div id="confirm-delete-modal" class="modal fade" tabindex="-1">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header text-white" style="background-color: #b00020;">
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

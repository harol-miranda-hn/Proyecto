<x-guest-layout>
    <div class="container py-4">

        <!-- Contenedor principal -->
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

            <!-- Encabezado -->
            <div class="d-flex flex-column flex-md-row justify-content-between align-items-start align-items-md-center mb-4 gap-3">
                <h2 class="h4 text-primary-emphasis fw-bold m-0">Usuarios</h2>
                <a href="{{ route('users.create') }}" class="btn btn-success d-flex align-items-center justify-content-center" title="Agregar usuario">
                    <i class="fas fa-user-plus me-1"></i> <span class="d-none d-sm-inline">Agregar usuario</span>
                </a>
            </div>

            <!-- Tabla de usuarios -->
            <div class="table-responsive">
                <table class="table table-bordered table-hover align-middle text-center table-sm">
                    <thead class="table-dark">
                    <tr>
                        <th style="width: 50px;">N°</th>
                        <th>Nombre</th>
                        <th>Correo Electrónico</th>
                        <th>Tipo de Usuario</th>
                        <th>Acciones</th>
                    </tr>
                    </thead>
                    <tbody class="table-light">
                    @forelse($users as $index => $user)
                        <tr>
                            <td class="text-start fw-semibold">{{ $users->firstItem() + $index }}</td>
                            <td class="text-start fw-semibold">{{ $user->name }}</td>
                            <td class="text-start">{{ $user->email }}</td>
                            <td>
                                @if ($user->role === 'profesor')
                                    <span class="badge bg-primary">Profesor</span>
                                @elseif ($user->role === 'Profesor')
                                    <span class="badge bg-success">Profesor</span>
                                @elseif ($user->role === 'estudiante')
                                    <span class="badge bg-success">Estudiante</span>
                                @elseif ($user->role === 'Estudiante')
                                    <span class="badge bg-success">Estudiante</span>
                                @elseif ($user->role === 'administrador')
                                    <span class="badge bg-danger">Administrador</span>
                                @elseif ($user->role === 'Administrador')
                                    <span class="badge bg-danger">Administrador</span>
                                @else
                                    <span class="badge bg-secondary">{{ $user->role }}</span>
                                @endif
                            </td>

                            <td>
                                <div class="d-flex justify-content-center gap-2">
                                    <a href="{{ route('users.show', $user->id) }}" class="btn btn-sm btn-outline-primary" title="Ver">
                                        <i class="fas fa-eye"></i>
                                    </a>
                                    <a href="{{ route('users.edit', $user->id) }}" class="btn btn-sm btn-outline-warning" title="Editar">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <button class="btn btn-sm btn-outline-danger delete-btn" data-user-id="{{ $user->id }}" title="Eliminar">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="text-center text-muted">No se encontraron usuarios registrados.</td>
                        </tr>
                    @endforelse
                    </tbody>
                </table>
            </div>

            <!-- Paginación -->
            @if($users->hasPages())
                <div class="d-flex flex-column flex-md-row justify-content-between align-items-center mt-4 gap-2">
                    <div class="text-muted small mb-2 mb-md-0">
                        Mostrando {{ $users->firstItem() }} a {{ $users->lastItem() }} de {{ $users->total() }} resultados
                    </div>
                    <div>
                        {!! $users->onEachSide(1)->links('pagination::bootstrap-5') !!}
                    </div>
                </div>
            @endif
        </div>

        <!-- Modal de Confirmación de Eliminación -->
        <div id="confirm-delete-modal" class="modal fade" tabindex="-1">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header bg-danger text-white">
                        <h5 class="modal-title">¿Eliminar usuario?</h5>
                        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Cerrar"></button>
                    </div>
                    <div class="modal-body">
                        <p>Esta acción no se puede deshacer. El usuario será eliminado permanentemente.</p>
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
                    form.action = `/users/${userId}`;
                    new bootstrap.Modal(document.getElementById('confirm-delete-modal')).show();
                });
            });

            setTimeout(() => {
                document.querySelectorAll('.toast').forEach(toast => toast.classList.remove('show'));
            }, 3000);
        </script>
    </div>
</x-guest-layout>

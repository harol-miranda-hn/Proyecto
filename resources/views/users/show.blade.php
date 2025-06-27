<x-guest-layout>
    <div class="container py-4">

        <!-- Encabezado -->
        <div class="bg-info bg-gradient text-white rounded-3 p-3 mb-4 d-flex flex-wrap align-items-start gap-3">
            <div class="rounded-circle bg-white bg-opacity-25 d-flex align-items-center justify-content-center" style="width: 48px; height: 48px;">
                <i class="fas fa-user-shield fs-5"></i>
            </div>
            <div class="flex-grow-1">
                <h2 class="h6 mb-1">Detalles del Usuario</h2>
                <p class="mb-0 small">Información completa del usuario seleccionado</p>
            </div>
        </div>

        <!-- Tarjeta de información -->
        <div class="bg-white rounded-3 shadow-sm p-4">
            <div class="row g-4">

                <!-- Nombre -->
                <div class="col-md-6">
                    <small class="text-muted">Nombre Completo</small>
                    <div class="fw-semibold text-dark">{{ $user->name }}</div>
                </div>

                <!-- Correo -->
                <div class="col-md-6">
                    <small class="text-muted">Correo Electrónico</small>
                    <div class="fw-semibold text-dark">{{ $user->email ?? 'No especificado' }}</div>
                </div>

                <!-- Rol -->
                <div class="col-md-12">
                    <small class="text-muted">Rol</small>
                    <div>
                        @php
                            $role = $user->role;
                            $badge = match($role) {
                                'superadmin' => 'badge bg-info',
                                'administrador' => 'badge bg-primary',
                                'profesor' => 'badge bg-warning text-success',
                                'estudiante' => 'badge bg-success',
                                default => 'badge bg-secondary'
                            };
                            $label = match($role) {
                                'superadmin' => 'Super Administrador',
                                'administrador' => 'Administrador',
                                'profesor' => 'Profesor',
                                'estudiante' => 'Estudiante',
                                default => ucfirst($role)
                            };
                        @endphp
                        <span class="{{ $badge }}">{{ $label }}</span>
                    </div>
                </div>

                <!-- Fecha de creación -->
                <div class="col-md-6">
                    <small class="text-muted">Fecha de Registro</small>
                    <div class="fw-semibold text-dark">
                        {{ $user->created_at->locale('es')->translatedFormat('l d \d\e F, Y \a \l\a\s h:i A') }}
                    </div>
                </div>

                <!-- Última actualización -->
                <div class="col-md-6">
                    <small class="text-muted">Última Actualización</small>
                    <div class="fw-semibold text-dark">
                        {{ $user->updated_at->locale('es')->translatedFormat('l d \d\e F, Y \a \l\a\s h:i A') }}
                    </div>
                </div>

            </div>

            <!-- Botones -->
            <div class="mt-4 d-flex justify-content-end gap-2">
                <a href="{{ route('users.index') }}" class="btn btn-outline-secondary">
                    <i class="fas fa-arrow-left me-1"></i> Volver
                </a>
                <a href="{{ route('users.edit', $user->id) }}" class="btn btn-warning text-white">
                    <i class="fas fa-user-edit me-1"></i> Editar
                </a>
            </div>
        </div>
    </div>
</x-guest-layout>

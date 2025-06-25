<x-guest-layout>
    <div class="container py-4">

        <!-- Encabezado -->
        <div class="bg-info bg-gradient text-white rounded-3 p-3 mb-4 d-flex flex-wrap align-items-start gap-3">
            <div class="rounded-circle bg-white bg-opacity-25 d-flex align-items-center justify-content-center" style="width: 48px; height: 48px;">
                <i class="fas fa-user-graduate fs-5"></i>
            </div>
            <div class="flex-grow-1">
                <h2 class="h6 mb-1">Detalles del Alumno</h2>
                <p class="mb-0 small">Información completa del alumno registrado</p>
            </div>
        </div>

        <!-- Tarjeta de información -->
        <div class="bg-white rounded-3 shadow-sm p-4">
            <!-- Sección: Datos personales -->
            <div class="mb-4">
                <div class="d-flex align-items-center text-primary mb-3">
                    <i class="fas fa-user-circle me-2"></i>
                    <h5 class="mb-0">Información Personal</h5>
                </div>
                <div class="row g-3">
                    <div class="col-md-6">
                        <small class="text-muted">Nombre Completo</small>
                        <div class="fw-semibold text-dark">{{ $alumno->nombre_completo }}</div>
                    </div>
                    <div class="col-md-6">
                        <small class="text-muted">Correo Electrónico</small>
                        <div class="fw-semibold text-dark">{{ $alumno->email ?? 'No especificado' }}</div>
                    </div>
                    <div class="col-md-3">
                        <small class="text-muted">Identidad</small>
                        <div class="fw-semibold text-dark">{{ $alumno->numero_identidad }}</div>
                    </div>
                    <div class="col-md-3">
                        <small class="text-muted">Teléfono</small>
                        <div class="fw-semibold text-dark">{{ $alumno->telefono }}</div>
                    </div>
                    <div class="col-md-3">
                        <small class="text-muted">Fecha de Nacimiento</small>
                        <div class="fw-semibold text-dark">
                            {{ \Carbon\Carbon::parse($alumno->fecha_nacimiento)->format('d/m/Y') }}
                        </div>
                    </div>
                    <div class="col-md-3">
                        <small class="text-muted">Género</small>
                        <div class="fw-semibold text-dark">
                            {{ $alumno->genero == 'M' ? 'Masculino' : 'Femenino' }}
                        </div>
                    </div>
                    <div class="col-12">
                        <small class="text-muted">Dirección</small>
                        <div class="fw-semibold text-dark">{{ $alumno->direccion ?? 'No especificada' }}</div>
                    </div>
                </div>
            </div>

            <hr class="my-4">

            <!-- Sección: Encargado -->
            <div class="mb-4">
                <div class="d-flex align-items-center text-primary mb-3">
                    <i class="fas fa-user-shield me-2"></i>
                    <h5 class="mb-0">Información del Encargado</h5>
                </div>
                <div class="row g-3">
                    <div class="col-md-4">
                        <small class="text-muted">Nombre</small>
                        <div class="fw-semibold text-dark">{{ $alumno->encargado_nombre }}</div>
                    </div>
                    <div class="col-md-4">
                        <small class="text-muted">Teléfono</small>
                        <div class="fw-semibold text-dark">{{ $alumno->encargado_telefono }}</div>
                    </div>
                    <div class="col-md-4">
                        <small class="text-muted">Parentesco</small>
                        <div class="fw-semibold text-capitalize text-dark">{{ $alumno->parentesco }}</div>
                    </div>
                </div>
            </div>

            <hr class="my-4">

            <!-- Sección: Información adicional -->
            <div>
                <div class="d-flex align-items-center text-primary mb-3">
                    <i class="fas fa-notes-medical me-2"></i>
                    <h5 class="mb-0">Información Adicional</h5>
                </div>
                <div class="row g-3">
                    <div class="col-md-6">
                        <small class="text-muted">Información de Salud</small>
                        <div class="fw-semibold text-dark">{{ $alumno->descripcion_enfermedad ?? 'No especificada' }}</div>
                    </div>
                    <div class="col-md-6">
                        <small class="text-muted">Observaciones</small>
                        <div class="fw-semibold text-dark">{{ $alumno->descripcion_observacion ?? 'No especificadas' }}</div>
                    </div>
                </div>
            </div>

            <!-- Botones -->
            <div class="mt-4 d-flex justify-content-end gap-2">
                <a href="{{ route('alumnos.index') }}" class="btn btn-outline-secondary">
                    <i class="fas fa-arrow-left me-1"></i> Volver
                </a>
                <a href="{{ route('alumnos.edit', $alumno->id) }}" class="btn btn-warning text-white">
                    <i class="fas fa-edit me-1"></i> Editar
                </a>
            </div>
        </div>

    </div>
</x-guest-layout>

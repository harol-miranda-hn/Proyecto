<x-guest-layout>
    <div class="container py-4">

        <!-- Encabezado -->
        <div class="bg-primary bg-gradient text-white rounded-3 p-3 mb-4 d-flex flex-wrap align-items-start gap-3">
            <div class="rounded-circle bg-white bg-opacity-25 d-flex align-items-center justify-content-center" style="width: 48px; height: 48px;">
                <i class="fas fa-book fs-5"></i>
            </div>
            <div class="flex-grow-1">
                <h2 class="h6 mb-1">Asignar Asignaturas</h2>
                <p class="mb-0 small">Seleccione las asignaturas que desea asociar al grado</p>
            </div>
        </div>

        <!-- Formulario -->
        <div class="bg-white rounded-3 shadow-sm p-4">
            <form method="POST" action="{{ route('grados.asignaturas.update', $grado->id) }}">
                @csrf
                @method('PUT')

                <!-- Información del Grado -->
                <div class="mb-4 border-bottom pb-3">
                    <div class="d-flex align-items-center text-primary mb-3">
                        <div class="bg-light rounded-circle d-flex justify-content-center align-items-center me-2" style="width: 32px; height: 32px;">
                            <i class="fas fa-layer-group small"></i>
                        </div>
                        <h5 class="mb-0">
                            {{ $grado->curso }} - Sección {{ $grado->seccion }} ({{ $grado->jornada }})
                        </h5>
                    </div>

                    <div class="row g-3">
                        @foreach($asignaturas as $asignatura)
                            <div class="col-md-6">
                                <div class="form-check">
                                    <input
                                        class="form-check-input"
                                        type="checkbox"
                                        name="asignaturas[]"
                                        value="{{ $asignatura->id }}"
                                        id="asig{{ $asignatura->id }}"
                                        @if($grado->asignaturas->contains($asignatura->id)) checked @endif
                                    >
                                    <label class="form-check-label" for="asig{{ $asignatura->id }}">
                                        {{ $asignatura->nombre }}
                                    </label>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>

                <!-- Botones -->
                <div class="d-flex flex-column flex-sm-row justify-content-end gap-2 mt-4">
                    <a href="{{ route('asignaciones.index') }}" class="btn btn-outline-secondary">
                        <i class="fas fa-arrow-left me-1"></i> Cancelar
                    </a>
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-save me-1"></i> Guardar Asignaciones
                    </button>
                </div>
            </form>
        </div>
    </div>
</x-guest-layout>

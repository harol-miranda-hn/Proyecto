<x-guest-layout>
    <div class="container py-4">

        <!-- Encabezado -->
        <div class="bg-warning bg-gradient text-white rounded-3 p-3 mb-4 d-flex flex-wrap align-items-start gap-3">
            <div class="rounded-circle bg-white bg-opacity-25 d-flex align-items-center justify-content-center" style="width: 48px; height: 48px;">
                <i class="fas fa-calendar-edit fs-5"></i>
            </div>
            <div class="flex-grow-1">
                <h2 class="h6 mb-1">Editar Asistencia</h2>
                <p class="mb-0 small">Modifique los estados de asistencia de los alumnos</p>
            </div>
        </div>

        <!-- Formulario -->
        <div class="bg-white rounded-3 shadow-sm p-4">
            <form action="{{ route('asistencias.update', $asistencia->id) }}" method="POST">
                @csrf
                @method('PUT')

                <!-- Información general -->
                <div class="mb-4 border-bottom pb-3">
                    <div class="row g-3">
                        <div class="col-md-6">
                            <label class="form-label">Grado</label>
                            <input type="text" class="form-control" value="{{ $asistencia->grado->curso }} {{ $asistencia->grado->seccion }} - {{ $asistencia->grado->jornada }}" disabled>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Fecha</label>
                            <input type="date" class="form-control" value="{{ $asistencia->fecha }}" disabled>
                        </div>
                    </div>
                </div>

                <!-- Tabla de alumnos -->
                <div class="table-responsive">
                    <table class="table table-bordered table-hover align-middle text-center table-sm">
                        <thead class="table-light">
                        <tr>
                            <th>Alumno</th>
                            <th>Asistió</th>
                            <th>Faltó</th>
                            <th>Excusado</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach ($alumnos as $alumno)
                            @php
                                $estadoActual = optional($asistencia->asistenciaAlumnos->firstWhere('alumno_id', $alumno->id))->estado;
                            @endphp
                            <tr>
                                <td class="text-start">{{ $alumno->nombre_completo }}</td>
                                <td>
                                    <input type="radio" name="estados[{{ $alumno->id }}]" value="asistio" {{ $estadoActual === 'asistio' ? 'checked' : '' }} required>
                                </td>
                                <td>
                                    <input type="radio" name="estados[{{ $alumno->id }}]" value="falto" {{ $estadoActual === 'falto' ? 'checked' : '' }} required>
                                </td>
                                <td>
                                    <input type="radio" name="estados[{{ $alumno->id }}]" value="excusado" {{ $estadoActual === 'excusado' ? 'checked' : '' }} required>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>

                <!-- Botones -->
                <div class="d-flex flex-column flex-sm-row justify-content-end gap-2 mt-4">
                    <a href="{{ route('asistencias.index') }}" class="btn btn-outline-secondary">
                        <i class="fas fa-arrow-left me-1"></i> Volver
                    </a>
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-save me-1"></i> Guardar Cambios
                    </button>
                </div>
            </form>
        </div>
    </div>
</x-guest-layout>

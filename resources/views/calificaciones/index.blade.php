<x-guest-layout>
    <div class="container py-4">
        <div class="px-4 py-4 shadow rounded-4 border" style="background-color: #fafafa;">

            @if(session('status'))
                <div class="toast align-items-center border-0 show position-fixed top-0 end-0 m-4 text-white"
                     role="alert" style="background-color: #388e3c;">
                    <div class="d-flex">
                        <div class="toast-body">{{ session('status') }}</div>
                        <button type="button" class="btn-close btn-close-white me-2 m-auto"
                                data-bs-dismiss="toast" aria-label="Cerrar"></button>
                    </div>
                </div>
            @endif

            <!-- Encabezado -->
            <div class="d-flex flex-column flex-md-row justify-content-between align-items-start align-items-md-center mb-4 gap-3">
                <h2 class="h4 fw-bold m-0" style="color: #6200ea;">Calificaciones Generales</h2>

                <div class="d-flex flex-wrap align-items-stretch gap-2">
                    <form method="GET" action="{{ route('calificaciones.index') }}" class="d-flex" style="min-width: 240px;">
                        <div class="input-group">
                            <input type="text" name="search" value="{{ request('search') }}"
                                   class="form-control" placeholder="Buscar por alumno">
                            <button type="submit" class="btn" style="border-color: #6200ea; color: #6200ea;">
                                <i class="fas fa-search"></i>
                            </button>
                        </div>
                    </form>

                    <a href="{{ route('calificaciones.index') }}" class="btn" style="border-color: #03dac6; color: #03dac6;">
                        <i class="fas fa-sync-alt"></i>
                    </a>

                    <a href="{{ route('calificaciones.create') }}" class="btn text-white rounded-pill px-3"
                       style="background-color: #6200ea;">
                        <i class="fas fa-plus"></i> <span class="d-none d-sm-inline ms-1">Nueva</span>
                    </a>
                </div>
            </div>

            @if($promedios->count())
                <div class="table-responsive">
                    <table class="table table-bordered table-hover align-middle text-center table-sm">
                        <thead class="table-dark">
                        <tr>
                            <th>#</th>
                            <th>Alumno</th>
                            <th>Grado</th>
                            <th>Promedio General</th>
                            <th>Acciones</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($promedios as $index => $registro)
                            <tr>
                                <td>{{ $promedios->firstItem() + $index }}</td>
                                <td class="text-start fw-semibold">
                                    {{ $registro->matricula?->alumno?->nombre_completo ?? 'N/D' }}
                                </td>
                                <td>
                                    {{ $registro->matricula?->grado?->curso ?? 'N/D' }}
                                    - {{ $registro->matricula?->grado?->seccion ?? '' }}
                                    ({{ $registro->matricula?->grado?->jornada ?? '' }})
                                </td>
                                <td>
                                    <span class="badge rounded-pill px-3 py-2 text-white"
                                          style="background-color: #388e3c;">
                                        {{ number_format($registro->promedio_general, 2) }}
                                    </span>
                                </td>
                                <td>
                                    <a href="{{ route('calificaciones.edit', ['calificacion' => $registro->matricula_id]) }}"
                                       class="btn btn-sm text-white rounded-pill px-3" style="background-color: #fbc02d;">
                                        <i class="fas fa-edit"></i>
                                    </a>

                                    <a href="{{ route('calificaciones.show', ['matricula' => $registro->matricula_id]) }}"
                                       class="btn btn-sm text-white rounded-pill px-3" style="background-color: #0288d1;">
                                        <i class="fas fa-eye"></i>
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>

                <!-- Paginación -->
                @if ($promedios->hasPages())
                    <div class="d-flex justify-content-between align-items-center mt-4">
                        <div class="text-muted small">
                            Mostrando {{ $promedios->firstItem() }} a {{ $promedios->lastItem() }} de {{ $promedios->total() }} resultados
                        </div>
                        <div>
                            {!! $promedios->onEachSide(1)->links('pagination::bootstrap-5') !!}
                        </div>
                    </div>
                @endif

            @else
                <div class="text-center text-muted py-4">
                    No se encontraron calificaciones registradas.
                </div>
            @endif

        </div>

        <script>
            setTimeout(() => {
                document.querySelectorAll('.toast').forEach(toast => toast.classList.remove('show'));
            }, 3500);
        </script>
    </div>
</x-guest-layout>

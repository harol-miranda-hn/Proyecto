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
                <h2 class="h4 fw-bold m-0" style="color: #6200ea;">Matrículas</h2>

                <div class="d-flex flex-wrap align-items-stretch gap-2">
                    <form method="GET" action="{{ route('matriculas.index') }}" class="d-flex" style="flex: 1 1 auto; min-width: 240px;">
                        <div class="input-group">
                            <input type="text" name="search" value="{{ request('search') }}" class="form-control" placeholder="Buscar alumno">
                            <button type="submit" class="btn" style="border-color: #6200ea; color: #6200ea;" title="Buscar">
                                <i class="fas fa-search"></i>
                            </button>
                        </div>
                    </form>

                    <a href="{{ route('matriculas.index') }}" class="btn" style="border-color: #03dac6; color: #03dac6;" title="Restablecer">
                        <i class="fas fa-sync-alt"></i>
                    </a>

                    <a href="{{ route('matriculas.create') }}" class="btn text-white rounded-pill px-3" style="background-color: #0288d1;" title="Matricular alumnos">
                        <i class="fas fa-user-graduate"></i> <span class="d-none d-sm-inline ms-1">Matricular</span>
                    </a>
                </div>
            </div>

            @if($matriculas->count())
                <!-- Tabla para escritorio -->
                <div class="table-responsive d-none d-md-block">
                    <table class="table table-bordered table-hover align-middle text-center table-sm">
                        <thead class="table-dark">
                        <tr>
                            <th style="width: 50px;">N°</th>
                            <th class="text-start">Alumno</th>
                            <th class="text-start">Grado</th>
                            <th class="text-start">Fecha</th>
                            <th>Acciones</th>
                        </tr>
                        </thead>
                        <tbody style="background-color: #ffffff;">
                        @foreach($matriculas as $index => $matricula)
                            <tr>
                                <td>{{ $matriculas->firstItem() + $index }}</td>
                                <td class="text-start fw-semibold small">
                                    {{ $matricula->alumno->nombre_completo }}
                                </td>

                                <td class="text-start small">
                                    @php
                                        $curso = $matricula->grado->curso ?? 'N/D';
                                        $modalidadOriginal = $matricula->grado->modalidad ?? '';
                                        $modalidad = match (true) {
                                            str_contains(strtolower($modalidadOriginal), 'informática con orientación a robótica') => 'BTP en Robótica',
                                            str_contains(strtolower($modalidadOriginal), 'informática') => 'BTP en Informática',
                                            default => $modalidadOriginal,
                                        };
                                        $seccion = $matricula->grado->seccion ?? '';
                                        $jornada = $matricula->grado->jornada ?? '';
                                    @endphp

                                    {{ $curso }} de {{ $modalidad }} <strong>'{{ $seccion }}'</strong> ({{ $jornada }})
                                </td>


                                <td class="text-start">
                                    <span class="badge bg-light text-dark small">
                                        {{ \Carbon\Carbon::parse($matricula->fecha_matricula)->locale('es')->translatedFormat('d \d\e F, Y') }}
                                    </span>
                                </td>

                                <td>
                                    <div class="d-flex justify-content-center gap-2">
                                        <a href="{{ route('matriculas.show', $matricula->id) }}" class="btn btn-sm text-white rounded-circle" style="background-color: #0288d1;" title="Ver">
                                            <i class="fas fa-eye"></i>
                                        </a>
                                        <a href="{{ route('matriculas.edit', $matricula->id) }}" class="btn btn-sm text-white rounded-circle" style="background-color: #fbc02d;" title="Editar">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        <button class="btn btn-sm text-white rounded-circle delete-btn" style="background-color: #b00020;" data-id="{{ $matricula->id }}" title="Eliminar">
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
                    @foreach($matriculas as $index => $matricula)
                        <div class="card shadow-sm mb-3 border-0 rounded-4">
                            <div class="card-body">
                                <div class="d-flex justify-content-between align-items-center mb-2">
                                    <h6 class="mb-0 fw-bold" style="color: #6200ea;">{{ $matricula->alumno->nombre_completo }}</h6>
                                    <span class="badge" style="background-color: #eeeeee; color: #757575;">
                                        #{{ $matriculas->firstItem() + $index }}
                                    </span>
                                </div>
                                <ul class="list-group list-group-flush small mb-2">
                                    <li class="list-group-item px-0 py-1 border-0 d-flex align-items-center">
                                        <i class="fas fa-graduation-cap me-2 text-secondary"></i>
                                        {{ $matricula->grado->curso }}
                                    </li>
                                    <li class="list-group-item px-0 py-1 border-0 d-flex align-items-center">
                                        <i class="fas fa-school me-2 text-secondary"></i>
                                        {{ $matricula->grado->modalidad }}
                                    </li>
                                    <li class="list-group-item px-0 py-1 border-0 d-flex align-items-center">
                                        <i class="fas fa-clock me-2 text-secondary"></i>
                                        {{ $matricula->grado->jornada }}
                                    </li>
                                    <li class="list-group-item px-0 py-1 border-0 d-flex align-items-center">
                                        <i class="fas fa-calendar-alt me-2 text-secondary"></i>
                                        {{ strtoupper(\Carbon\Carbon::parse($matricula->fecha_matricula)->format('d-M-Y')) }}
                                    </li>
                                </ul>
                                <div class="d-flex justify-content-end gap-2">
                                    <a href="{{ route('matriculas.show', $matricula->id) }}" class="btn btn-sm text-white rounded-circle" style="background-color: #0288d1;" title="Ver">
                                        <i class="fas fa-eye"></i>
                                    </a>
                                    <a href="{{ route('matriculas.edit', $matricula->id) }}" class="btn btn-sm text-white rounded-circle" style="background-color: #fbc02d;" title="Editar">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <button class="btn btn-sm text-white rounded-circle delete-btn" style="background-color: #b00020;" data-id="{{ $matricula->id }}" title="Eliminar">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            @else
                <div class="text-center text-muted py-3">No se encontraron matrículas registradas.</div>
            @endif

            <!-- Paginación -->
            @if ($matriculas->hasPages())
                <div class="d-flex flex-column flex-md-row justify-content-between align-items-center mt-4 gap-2">
                    <div class="text-muted small mb-2 mb-md-0">
                        Mostrando {{ $matriculas->firstItem() }} a {{ $matriculas->lastItem() }} de {{ $matriculas->total() }} resultados
                    </div>
                    <div>
                        {!! $matriculas->onEachSide(1)->appends(request()->query())->links('pagination::bootstrap-5') !!}
                    </div>
                </div>
            @endif
        </div>

        <!-- Modal de Confirmación de Eliminación -->
        <div id="confirm-delete-modal" class="modal fade" tabindex="-1">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header text-white" style="background-color: #b00020;">
                        <h5 class="modal-title">¿Estás seguro de eliminar?</h5>
                        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Cerrar"></button>
                    </div>
                    <div class="modal-body">
                        <p>Esta acción no se puede deshacer. La matrícula será eliminada permanentemente.</p>
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
                    const userId = this.getAttribute('data-id');
                    const form = document.getElementById('delete-form');
                    form.action = `/matriculas/${userId}`;
                    new bootstrap.Modal(document.getElementById('confirm-delete-modal')).show();
                });
            });

            setTimeout(() => {
                document.querySelectorAll('.toast').forEach(toast => toast.classList.remove('show'));
            }, 3500);
        </script>

    </div>
</x-guest-layout>

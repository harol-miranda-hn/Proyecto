<x-guest-layout>
    <div class="container py-4">
        <div class="px-4 py-4 shadow rounded-4 border" style="background-color: #fafafa;">

            {{-- Toasts --}}
            @if(session('status'))
                <div class="toast show position-fixed top-0 end-0 m-4 text-white border-0" style="background-color: #388e3c;">
                    <div class="d-flex">
                        <div class="toast-body">{{ session('status') }}</div>
                        <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast" aria-label="Cerrar"></button>
                    </div>
                </div>
            @endif
            @if(session('error'))
                <div class="toast show position-fixed top-0 end-0 m-4 text-white border-0" style="background-color: #b00020;">
                    <div class="d-flex">
                        <div class="toast-body">{{ session('error') }}</div>
                        <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast" aria-label="Cerrar"></button>
                    </div>
                </div>
            @endif

            {{-- Encabezado --}}
            <div class="mb-4">
                <h2 class="h4 fw-bold" style="color: #6200ea;">Control de Asistencias</h2>
                <p class="text-muted small mb-2">Revisa y gestiona los registros de asistencia</p>

                {{-- Filtros --}}
                <form method="GET" action="{{ route('asistencias.index') }}" class="row row-cols-1 row-cols-md-auto g-2 align-items-center">
                    <div class="col">
                        <input type="text" name="search" value="{{ request('search') }}" class="form-control form-control-sm" placeholder="Buscar grado o sección">
                    </div>
                    <div class="col">
                        <input type="date" name="fecha" value="{{ request('fecha', now()->toDateString()) }}" class="form-control form-control-sm">
                    </div>
                    <div class="col">
                        <button type="submit" class="btn btn-sm btn-outline-primary">
                            <i class="fas fa-filter me-1"></i> Filtrar
                        </button>
                        <a href="{{ route('asistencias.index') }}" class="btn btn-sm btn-outline-secondary">
                            <i class="fas fa-sync-alt"></i>
                        </a>
                        <a href="{{ route('asistencias.create') }}" class="btn btn-sm text-white rounded-pill px-3" style="background-color: #6200ea;">
                            <i class="fas fa-calendar-plus"></i> <span class="d-none d-sm-inline">Nueva</span>
                        </a>
                    </div>
                </form>
            </div>

            {{-- Tabla (escritorio) --}}
            @if($asistencias->count())
                <div class="table-responsive d-none d-md-block">
                    <table class="table table-bordered table-hover align-middle table-sm text-center">
                        <thead class="table-dark">
                        <tr>
                            <th>#</th>
                            <th>Fecha</th>
                            <th>Grado</th>
                            <th>Acciones</th>
                        </tr>
                        </thead>
                        <tbody style="background-color: #ffffff;">
                        @foreach($asistencias as $index => $asistencia)
                            <tr class="small">
                                <td>{{ $asistencias->firstItem() + $index }}</td>
                                <td>{{ ucfirst(\Carbon\Carbon::parse($asistencia->fecha)->locale('es')->translatedFormat('l d \d\e F, Y')) }}</td>
                                <td>
                                    @php
                                        $curso = $asistencia->grado->curso ?? 'N/D';
                                        $mod = $asistencia->grado->modalidad ?? '';
                                        $mod = str_contains(strtolower($mod), 'robótica') ? 'BTP en Robótica' : (str_contains(strtolower($mod), 'informática') ? 'BTP en Informática' : $mod);
                                        $sec = $asistencia->grado->seccion ?? '';
                                        $jor = $asistencia->grado->jornada ?? '';
                                    @endphp
                                    {{ $curso }} de {{ $mod }} <strong>'{{ $sec }}'</strong> ({{ $jor }})
                                </td>
                                <td>
                                    <div class="d-flex justify-content-center gap-2">
                                        <a href="{{ route('asistencias.show', $asistencia->id) }}" class="btn btn-sm text-white rounded-circle" style="background-color: #0288d1;">
                                            <i class="fas fa-eye"></i>
                                        </a>
                                        <a href="{{ route('asistencias.edit', $asistencia->id) }}" class="btn btn-sm text-white rounded-circle" style="background-color: #fbc02d;">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        <form method="POST" action="{{ route('asistencias.destroy', $asistencia->id) }}" onsubmit="return confirm('¿Estás seguro de eliminar esta asistencia?')">
                                            @csrf @method('DELETE')
                                            <button type="submit" class="btn btn-sm text-white rounded-circle" style="background-color: #b00020;">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>

                {{-- Tarjetas (móvil) --}}
                <div class="d-md-none">
                    @foreach($asistencias as $index => $asistencia)
                        @php
                            $curso = $asistencia->grado->curso ?? 'N/D';
                            $mod = $asistencia->grado->modalidad ?? '';
                            $mod = str_contains(strtolower($mod), 'robótica') ? 'BTP en Robótica' : (str_contains(strtolower($mod), 'informática') ? 'BTP en Informática' : $mod);
                            $sec = $asistencia->grado->seccion ?? '';
                            $jor = $asistencia->grado->jornada ?? '';
                        @endphp
                        <div class="card shadow-sm mb-3 border-0 rounded-4">
                            <div class="card-body small">
                                <div class="d-flex justify-content-between mb-1">
                                    <strong style="color: #6200ea;">{{ ucfirst(\Carbon\Carbon::parse($asistencia->fecha)->locale('es')->translatedFormat('l d \d\e F, Y')) }}</strong>
                                    <span class="badge bg-secondary">#{{ $asistencias->firstItem() + $index }}</span>
                                </div>
                                <div class="mb-2">
                                    {{ $curso }} de {{ $mod }} <strong>'{{ $sec }}'</strong> ({{ $jor }})
                                </div>
                                <div class="d-flex justify-content-end gap-2">
                                    <a href="{{ route('asistencias.show', $asistencia->id) }}" class="btn btn-sm text-white rounded-circle" style="background-color: #0288d1;">
                                        <i class="fas fa-eye"></i>
                                    </a>
                                    <a href="{{ route('asistencias.edit', $asistencia->id) }}" class="btn btn-sm text-white rounded-circle" style="background-color: #fbc02d;">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <form method="POST" action="{{ route('asistencias.destroy', $asistencia->id) }}" onsubmit="return confirm('¿Eliminar esta asistencia?')">
                                        @csrf @method('DELETE')
                                        <button type="submit" class="btn btn-sm text-white rounded-circle" style="background-color: #b00020;">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            @else
                <div class="text-center text-muted py-3">No hay asistencias registradas.</div>
            @endif

            {{-- Paginación --}}
            @if ($asistencias->hasPages())
                <div class="d-flex flex-column flex-md-row justify-content-between align-items-center mt-4 gap-2">
                    <div class="text-muted small mb-2 mb-md-0">
                        Mostrando {{ $asistencias->firstItem() }} a {{ $asistencias->lastItem() }} de {{ $asistencias->total() }} resultados
                    </div>
                    <div>{!! $asistencias->onEachSide(1)->links('pagination::bootstrap-5') !!}</div>
                </div>
            @endif
        </div>
    </div>
</x-guest-layout>

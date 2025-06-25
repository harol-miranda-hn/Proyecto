<x-guest-layout>
    <div class="container py-4">

        <!-- Encabezado del formulario -->
        <div class="bg-primary bg-gradient text-white rounded-3 p-3 mb-4 d-flex flex-wrap align-items-start gap-3">
            <div class="rounded-circle bg-white bg-opacity-25 d-flex align-items-center justify-content-center" style="width: 48px; height: 48px;">
                <i class="fas fa-chalkboard-teacher fs-5"></i>
            </div>
            <div class="flex-grow-1">
                <h2 class="h6 mb-1">Registro de Nuevo Grado</h2>
                <p class="mb-0 small">Complete todos los campos requeridos para registrar un nuevo grado</p>
            </div>
        </div>

        <!-- Contenedor del formulario -->
        <div class="bg-white rounded-3 shadow-sm p-4">
            <form action="{{ route('grados.store') }}" method="POST" id="gradoForm">
                @csrf

                <!-- Información del Grado -->
                <div class="mb-4">
                    <div class="d-flex align-items-center text-primary mb-3">
                        <div class="bg-light rounded-circle d-flex justify-content-center align-items-center me-2" style="width: 32px; height: 32px;">
                            <i class="fas fa-layer-group small"></i>
                        </div>
                        <h5 class="mb-0">Información del Grado</h5>
                    </div>

                    <div class="row g-3">
                        <div class="col-md-6">
                            <label for="curso" class="form-label">Curso *</label>
                            <input type="text" class="form-control" id="curso" name="curso" value="{{ old('curso') }}" placeholder="Ej: Décimo">
                            @error('curso') <div class="text-danger small">{{ $message }}</div> @enderror
                        </div>

                        <div class="col-md-6">
                            <label for="modalidad" class="form-label">Modalidad *</label>
                            <input type="text" class="form-control" id="modalidad" name="modalidad" value="{{ old('modalidad') }}" placeholder="Ej: Bachillerato Técnico Profesional en Informática">
                            @error('modalidad') <div class="text-danger small">{{ $message }}</div> @enderror
                        </div>

                        <div class="col-md-6">
                            <label for="jornada" class="form-label">Jornada *</label>
                            <select class="form-select" id="jornada" name="jornada">
                                <option value="">Seleccione...</option>
                                @foreach(['Matutina', 'Vespertina', 'Nocturna', 'ISEMED'] as $jornada)
                                    <option value="{{ $jornada }}" {{ old('jornada') == $jornada ? 'selected' : '' }}>{{ $jornada }}</option>
                                @endforeach
                            </select>
                            @error('jornada') <div class="text-danger small">{{ $message }}</div> @enderror
                        </div>

                        <div class="col-md-6">
                            <label for="seccion" class="form-label">Sección *</label>
                            <select class="form-select" id="seccion" name="seccion">
                                <option value="">Seleccione...</option>
                                @foreach(['A', 'B', 'C', 'D', 'E', 'F', 'G'] as $seccion)
                                    <option value="{{ $seccion }}" {{ old('seccion') == $seccion ? 'selected' : '' }}>{{ $seccion }}</option>
                                @endforeach
                            </select>
                            @error('seccion') <div class="text-danger small">{{ $message }}</div> @enderror
                        </div>
                    </div>
                </div>

                <!-- Campo oculto: matrícula -->
                <input type="hidden" name="matricula" value="0">

                <!-- Botones -->
                <div class="d-flex flex-column flex-sm-row justify-content-end gap-2 mt-4">
                    <a href="{{ route('grados.index') }}" class="btn btn-outline-secondary">
                        <i class="fas fa-times me-1"></i> Cancelar
                    </a>
                    <button type="reset" class="btn btn-warning text-white">
                        <i class="fas fa-broom me-1"></i> Limpiar
                    </button>
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-plus me-1"></i> Registrar Grado
                    </button>
                </div>
            </form>
        </div>
    </div>

    <!-- Capitalización automática -->
    <script>
        function capitalizeWords(input) {
            let caret = input.selectionStart;
            input.value = input.value
                .toLowerCase()
                .replace(/\s{2,}/g, ' ')
                .replace(/\b\p{L}/gu, char => char.toUpperCase())
                .slice(0, 100);
            input.setSelectionRange(caret, caret);
        }

        document.addEventListener('DOMContentLoaded', () => {
            const campos = ['curso', 'modalidad'];
            campos.forEach(id => {
                const el = document.getElementById(id);
                if (el) el.addEventListener('input', () => capitalizeWords(el));
            });
        });
    </script>
</x-guest-layout>

<x-guest-layout>
    <div class="container py-4">

        <!-- Encabezado -->
        <div class="bg-warning bg-gradient text-white rounded-3 p-3 mb-4 d-flex align-items-start gap-3">
            <div class="rounded-circle bg-white bg-opacity-25 d-flex align-items-center justify-content-center"
                 style="width: 48px; height: 48px;">
                <i class="fas fa-book-open fs-5"></i>
            </div>
            <div class="flex-grow-1">
                <h2 class="h6 mb-1">Editar Asignatura</h2>
                <p class="mb-0 small">Modifique el nombre de la asignatura si es necesario</p>
            </div>
        </div>

        <!-- Formulario -->
        <div class="bg-white rounded-3 shadow-sm p-4">
            <form action="{{ route('asignaturas.update', $asignatura->id) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="mb-3">
                    <label for="nombre" class="form-label">Nombre de la Asignatura *</label>
                    <input type="text" name="nombre" id="nombre" class="form-control"
                           value="{{ old('nombre', $asignatura->nombre) }}">
                    @error('nombre') <div class="text-danger small">{{ $message }}</div> @enderror
                </div>

                <div class="d-flex justify-content-end gap-2 mt-4">
                    <a href="{{ route('asignaturas.index') }}" class="btn btn-outline-secondary">
                        <i class="fas fa-arrow-left me-1"></i> Volver
                    </a>
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-save me-1"></i> Guardar Cambios
                    </button>
                </div>
            </form>
        </div>
    </div>

    <script>
        document.getElementById('nombre').addEventListener('input', function () {
            let text = this.value.toLowerCase().replace(/\s{2,}/g, ' ');
            this.value = text.replace(/\b\p{L}/gu, c => c.toUpperCase()).slice(0, 100);
        });
    </script>
</x-guest-layout>

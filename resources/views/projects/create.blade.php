<x-guest-layout>
    <div class="container py-4">

        <!-- Encabezado del formulario -->
        <div class="bg-primary bg-gradient text-white rounded-3 p-3 mb-4 d-flex flex-wrap align-items-start gap-3">
            <div class="rounded-circle bg-white bg-opacity-25 d-flex align-items-center justify-content-center" style="width: 48px; height: 48px;">
                <i class="fas fa-folder-plus fs-5"></i>
            </div>
            <div class="flex-grow-1">
                <h2 class="h6 mb-1">Registrar Proyecto</h2>
                <p class="mb-0 small">Complete todos los campos para registrar un nuevo proyecto</p>
            </div>
        </div>

        <!-- Contenedor del formulario -->
        <div class="bg-white rounded-3 shadow-sm p-4">
            @if(session('status'))
                <div class="alert alert-success small">{{ session('status') }}</div>
            @endif

            <form action="{{ route('projects.store') }}" method="POST">
                @csrf

                <!-- Información General -->
                <div class="mb-4 border-bottom pb-3">
                    <div class="d-flex align-items-center text-primary mb-3">
                        <div class="bg-light rounded-circle d-flex justify-content-center align-items-center me-2" style="width: 32px; height: 32px;">
                            <i class="fas fa-info-circle small"></i>
                        </div>
                        <h5 class="mb-0">Información del Proyecto</h5>
                    </div>

                    <div class="row g-3">
                        <div class="col-md-6">
                            <label for="name" class="form-label">Nombre del Proyecto *</label>
                            <input type="text" class="form-control" id="project_name" name="name" value="{{ old('name') }}" placeholder="Ej: Sistema de Control Escolar" maxlength="60">
                            @error('name') <div class="text-danger small">{{ $message }}</div> @enderror
                        </div>

                        <div class="col-md-6">
                            <label for="status" class="form-label">Estado *</label>
                            <select class="form-select" id="status" name="status">
                                <option value="">Seleccionar estado</option>
                                <option value="activo" {{ old('status') == 'activo' ? 'selected' : '' }}>Activo</option>
                                <option value="completado" {{ old('status') == 'completado' ? 'selected' : '' }}>Completado</option>
                            </select>
                            @error('status') <div class="text-danger small">{{ $message }}</div> @enderror
                        </div>

                        <div class="col-md-6">
                            <label for="student_id" class="form-label">Estudiante *</label>
                            <select class="form-select" id="student_id" name="student_id">
                                <option value="">Seleccionar estudiante</option>
                                @foreach($students as $student)
                                    <option value="{{ $student->id }}" {{ old('student_id') == $student->id ? 'selected' : '' }}>
                                        {{ $student->name }}
                                    </option>
                                @endforeach
                            </select>
                            @error('student_id') <div class="text-danger small">{{ $message }}</div> @enderror
                        </div>

                        <div class="col-md-6">
                            <label for="professor_id" class="form-label">Profesor *</label>
                            <select class="form-select" id="professor_id" name="professor_id">
                                <option value="">Seleccionar profesor</option>
                                @foreach($professors as $professor)
                                    <option value="{{ $professor->id }}" {{ old('professor_id') == $professor->id ? 'selected' : '' }}>
                                        {{ $professor->name }}
                                    </option>
                                @endforeach
                            </select>
                            @error('professor_id') <div class="text-danger small">{{ $message }}</div> @enderror
                        </div>

                        <div class="col-md-12">
                            <label for="description" class="form-label">Descripción del Proyecto</label>
                            <textarea class="form-control" id="project_description" name="description" rows="4" placeholder="Breve descripción del proyecto..." >{{ old('description') }}</textarea>
                            @error('description') <div class="text-danger small">{{ $message }}</div> @enderror
                        </div>
                    </div>
                </div>

                <!-- Botones -->
                <div class="d-flex flex-column flex-sm-row justify-content-end gap-2 mt-4">
                    <a href="{{ route('projects.index') }}" class="btn btn-outline-secondary">
                        <i class="fas fa-arrow-left me-1"></i> Cancelar
                    </a>
                    <button type="reset" class="btn btn-warning text-white">
                        <i class="fas fa-broom me-1"></i> Limpiar
                    </button>
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-folder-plus me-1"></i> Crear Proyecto
                    </button>
                </div>
            </form>
        </div>
    </div>

    <script>
        function cleanAndFormatProjectName(input) {
            let text = input.value;

            // Solo letras, espacios y signos básicos; elimina números y símbolos especiales
            text = text
                .replace(/[^\p{L}\s]/gu, '') // solo letras y espacios
                .replace(/\s{2,}/g, ' ');    // múltiples espacios → uno

            // Capitaliza solo la primera letra de la primera palabra
            text = text.charAt(0).toUpperCase() + text.slice(1).toLowerCase();

            // Límite de palabras (ej. 8 palabras máx.)
            const maxWords = 8;
            const words = text.split(' ');
            if (words.length > maxWords) {
                text = words.slice(0, maxWords).join(' ');
            }

            input.value = text;
        }

        function cleanAndFormatDescription(input) {
            let text = input.value;

            text = text
                .replace(/\s{2,}/g, ' ') // múltiples espacios → uno
                .replace(/[^\p{L}\d\s.,:;()¿?¡!'"-]/gu, ''); // limpia símbolos extraños

            // Capitaliza solo la primera letra
            text = text.charAt(0).toUpperCase() + text.slice(1);

            // Limita a 100 palabras
            const maxWords = 100;
            const words = text.split(' ');
            if (words.length > maxWords) {
                text = words.slice(0, maxWords).join(' ');
            }

            input.value = text;
        }

        document.addEventListener('DOMContentLoaded', () => {
            const projectName = document.getElementById('project_name');
            const projectDesc = document.getElementById('project_description');

            if (projectName) {
                projectName.addEventListener('input', () => cleanAndFormatProjectName(projectName));
            }

            if (projectDesc) {
                projectDesc.addEventListener('input', () => cleanAndFormatDescription(projectDesc));
            }
        });
    </script>

</x-guest-layout>

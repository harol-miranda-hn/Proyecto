<x-guest-layout>
    <div class="container py-4">

        <!-- Encabezado -->
        <div class="bg-warning bg-gradient text-white rounded-3 p-3 mb-4 d-flex flex-wrap align-items-start gap-3">
            <div class="rounded-circle bg-white bg-opacity-25 d-flex align-items-center justify-content-center" style="width: 48px; height: 48px;">
                <i class="fas fa-edit fs-5"></i>
            </div>
            <div class="flex-grow-1">
                <h2 class="h6 mb-1">Editar Proyecto</h2>
                <p class="mb-0 small">Actualiza la información del proyecto</p>
            </div>
        </div>

        <!-- Formulario -->
        <div class="bg-white rounded-3 shadow-sm p-4">
            @if(session('status'))
                <div class="alert alert-success small">{{ session('status') }}</div>
            @endif

            <form action="{{ route('projects.update', $project->id) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="row g-3 mb-4">
                    <!-- Nombre del Proyecto -->
                    <div class="col-md-6">
                        <label for="name" class="form-label">Nombre del Proyecto *</label>
                        <input type="text" class="form-control" id="name" name="name"
                               value="{{ old('name', $project->name) }}" placeholder="Ej: Sistema de Gestión Académica">
                        @error('name') <div class="text-danger small">{{ $message }}</div> @enderror
                    </div>

                    <!-- Estado -->
                    <div class="col-md-6">
                        <label for="status" class="form-label">Estado *</label>
                        <select class="form-select" id="status" name="status">
                            <option value="">Seleccionar estado</option>
                            <option value="activo" {{ old('status', $project->status) == 'activo' ? 'selected' : '' }}>Activo</option>
                            <option value="completado" {{ old('status', $project->status) == 'completado' ? 'selected' : '' }}>Completado</option>
                        </select>
                        @error('status') <div class="text-danger small">{{ $message }}</div> @enderror
                    </div>
                </div>

                <div class="row g-3 mb-4">
                    <!-- Estudiante -->
                    <div class="col-md-6">
                        <label for="student_id" class="form-label">Estudiante *</label>
                        <select class="form-select" id="student_id" name="student_id">
                            <option value="">Seleccionar estudiante</option>
                            @foreach($students as $student)
                                <option value="{{ $student->id }}" {{ old('student_id', $project->student_id) == $student->id ? 'selected' : '' }}>
                                    {{ $student->name }} ({{ $student->email }})
                                </option>
                            @endforeach
                        </select>
                        @error('student_id') <div class="text-danger small">{{ $message }}</div> @enderror
                    </div>

                    <!-- Profesor -->
                    <div class="col-md-6">
                        <label for="professor_id" class="form-label">Profesor *</label>
                        <select class="form-select" id="professor_id" name="professor_id">
                            <option value="">Seleccionar profesor</option>
                            @foreach($professors as $professor)
                                <option value="{{ $professor->id }}" {{ old('professor_id', $project->professor_id) == $professor->id ? 'selected' : '' }}>
                                    {{ $professor->name }} ({{ $professor->email }})
                                </option>
                            @endforeach
                        </select>
                        @error('professor_id') <div class="text-danger small">{{ $message }}</div> @enderror
                    </div>
                </div>

                <!-- Descripción -->
                <div class="mb-4">
                    <label for="description" class="form-label">Descripción del Proyecto</label>
                    <textarea class="form-control" id="description" name="description" rows="4"
                              placeholder="Detalle breve del proyecto...">{{ old('description', $project->description) }}</textarea>
                    @error('description') <div class="text-danger small">{{ $message }}</div> @enderror
                </div>

                <!-- Botones -->
                <div class="d-flex flex-column flex-sm-row justify-content-end gap-2 mt-4">
                    <a href="{{ route('projects.index') }}" class="btn btn-outline-secondary">
                        <i class="fas fa-arrow-left me-1"></i> Cancelar
                    </a>
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-save me-1"></i> Actualizar Proyecto
                    </button>
                </div>
            </form>
        </div>
    </div>
</x-guest-layout>

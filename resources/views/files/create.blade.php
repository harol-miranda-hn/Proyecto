<x-guest-layout>
    <div class="container py-4">

        <!-- Encabezado del formulario -->
        <div class="bg-primary bg-gradient text-white rounded-3 p-3 mb-4 d-flex flex-wrap align-items-start gap-3">
            <div class="rounded-circle bg-white bg-opacity-25 d-flex align-items-center justify-content-center" style="width: 48px; height: 48px;">
                <i class="fas fa-upload fs-5"></i>
            </div>
            <div class="flex-grow-1">
                <h2 class="h6 mb-1">Subir Archivo</h2>
                <p class="mb-0 small">Selecciona un proyecto y adjunta el archivo correspondiente</p>
            </div>
        </div>

        <!-- Contenedor del formulario -->
        <div class="bg-white rounded-3 shadow-sm p-4">
            @if(session('status'))
                <div class="alert alert-success small">{{ session('status') }}</div>
            @endif

            <form action="{{ route('files.store') }}" method="POST" enctype="multipart/form-data">
                @csrf

                <div class="row g-3 mb-4">
                    <!-- Proyecto -->
                    <div class="col-md-6">
                        <label for="project_id" class="form-label">Proyecto *</label>
                        <select class="form-select" id="project_id" name="project_id">
                            <option value="">Seleccionar proyecto</option>
                            @foreach($projects as $project)
                                <option value="{{ $project->id }}" {{ old('project_id') == $project->id ? 'selected' : '' }}>
                                    {{ $project->name }}
                                </option>
                            @endforeach
                        </select>
                        @error('project_id') <div class="text-danger small">{{ $message }}</div> @enderror
                    </div>

                    <!-- Nombre del archivo -->
                    <div class="col-md-6">
                        <label for="name" class="form-label">Nombre del Archivo *</label>
                        <input type="text" class="form-control" id="name" name="name" value="{{ old('name') }}" placeholder="Ej: Informe final del proyecto">
                        @error('name') <div class="text-danger small">{{ $message }}</div> @enderror
                    </div>
                </div>

                <!-- Archivo -->
                <div class="mb-4">
                    <label for="file" class="form-label">Archivo *</label>
                    <input type="file" class="form-control" id="file" name="file">
                    @error('file') <div class="text-danger small">{{ $message }}</div> @enderror
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
                        <i class="fas fa-upload me-1"></i> Subir Archivo
                    </button>
                </div>
            </form>
        </div>
    </div>
</x-guest-layout>

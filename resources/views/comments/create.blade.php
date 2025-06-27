<x-guest-layout>
    <div class="container py-4">

        <!-- Encabezado del formulario -->
        <div class="bg-primary bg-gradient text-white rounded-3 p-3 mb-4 d-flex flex-wrap align-items-start gap-3">
            <div class="rounded-circle bg-white bg-opacity-25 d-flex align-items-center justify-content-center" style="width: 48px; height: 48px;">
                <i class="fas fa-comment-alt fs-5"></i>
            </div>
            <div class="flex-grow-1">
                <h2 class="h6 mb-1">Registrar Comentario</h2>
                <p class="mb-0 small">Ingresa el contenido del nuevo comentario y selecciona el usuario y el proyecto asociados</p>
            </div>
        </div>

        <!-- Contenedor del formulario -->
        <div class="bg-white rounded-3 shadow-sm p-4">
            @if(session('status'))
                <div class="alert alert-success small">{{ session('status') }}</div>
            @endif

            <form action="{{ route('comments.store') }}" method="POST">
                @csrf

                <!-- Selección del Usuario y Proyecto -->
                <div class="row g-3 mb-4">
                    <div class="col-md-6">
                        <label for="user_id" class="form-label">Usuario *</label>
                        <select class="form-select" id="user_id" name="user_id">
                            <option value="">Seleccione un usuario</option>
                            @foreach($users as $user)
                                <option value="{{ $user->id }}" {{ old('user_id') == $user->id ? 'selected' : '' }}>
                                    {{ $user->name }} ({{ $user->email }})
                                </option>
                            @endforeach
                        </select>
                        @error('user_id') <div class="text-danger small">{{ $message }}</div> @enderror
                    </div>

                    <div class="col-md-6">
                        <label for="project_id" class="form-label">Proyecto *</label>
                        <select class="form-select" id="project_id" name="project_id">
                            <option value="">Seleccione un proyecto</option>
                            @foreach($projects as $project)
                                <option value="{{ $project->id }}" {{ old('project_id') == $project->id ? 'selected' : '' }}>
                                    {{ $project->name }}
                                </option>
                            @endforeach
                        </select>
                        @error('project_id') <div class="text-danger small">{{ $message }}</div> @enderror
                    </div>
                </div>

                <!-- Contenido del Comentario -->
                <div class="mb-4">
                    <label for="content" class="form-label">Contenido del Comentario *</label>
                    <textarea class="form-control" id="content" name="content" rows="4" placeholder="Escriba aquí el comentario...">{{ old('content') }}</textarea>
                    @error('content') <div class="text-danger small">{{ $message }}</div> @enderror
                </div>

                <!-- Botones -->
                <div class="d-flex flex-column flex-sm-row justify-content-end gap-2 mt-4">
                    <a href="{{ route('comments.index') }}" class="btn btn-outline-secondary">
                        <i class="fas fa-arrow-left me-1"></i> Cancelar
                    </a>
                    <button type="reset" class="btn btn-warning text-white">
                        <i class="fas fa-broom me-1"></i> Limpiar
                    </button>
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-comment-dots me-1"></i> Crear Comentario
                    </button>
                </div>
            </form>
        </div>
    </div>
</x-guest-layout>

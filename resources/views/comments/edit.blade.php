<x-guest-layout>
    <div class="container py-4">

        <!-- Encabezado -->
        <div class="bg-warning bg-gradient text-white rounded-3 p-3 mb-4 d-flex flex-wrap align-items-start gap-3">
            <div class="rounded-circle bg-white bg-opacity-25 d-flex align-items-center justify-content-center" style="width: 48px; height: 48px;">
                <i class="fas fa-comments fs-5"></i>
            </div>
            <div class="flex-grow-1">
                <h2 class="h6 mb-1">Actualizar Comentario</h2>
                <p class="mb-0 small">Modifica el contenido del comentario y actualiza la relación con usuario y proyecto</p>
            </div>
        </div>

        <!-- Formulario -->
        <div class="bg-white rounded-3 shadow-sm p-4">
            @if(session('status'))
                <div class="alert alert-success small">{{ session('status') }}</div>
            @endif

            <form action="{{ route('comments.update', $comment->id) }}" method="POST">
                @csrf
                @method('PUT')

                <!-- Usuario y Proyecto -->
                <div class="row g-3 mb-4">
                    <div class="col-md-6">
                        <label for="user_id" class="form-label">Usuario *</label>
                        <select name="user_id" id="user_id" class="form-select" required>
                            <option value="">Seleccione un usuario</option>
                            @foreach($users as $user)
                                <option value="{{ $user->id }}" {{ old('user_id', $comment->user_id) == $user->id ? 'selected' : '' }}>
                                    {{ $user->name }} ({{ $user->email }})
                                </option>
                            @endforeach
                        </select>
                        @error('user_id') <div class="text-danger small">{{ $message }}</div> @enderror
                    </div>

                    <div class="col-md-6">
                        <label for="project_id" class="form-label">Proyecto *</label>
                        <select name="project_id" id="project_id" class="form-select" required>
                            <option value="">Seleccione un proyecto</option>
                            @foreach($projects as $project)
                                <option value="{{ $project->id }}" {{ old('project_id', $comment->project_id) == $project->id ? 'selected' : '' }}>
                                    {{ $project->name }}
                                </option>
                            @endforeach
                        </select>
                        @error('project_id') <div class="text-danger small">{{ $message }}</div> @enderror
                    </div>
                </div>

                <!-- Contenido -->
                <div class="mb-4">
                    <label for="content" class="form-label">Contenido del Comentario *</label>
                    <textarea name="content" id="content" rows="4" class="form-control"
                              placeholder="Escriba el comentario aquí..." required>{{ old('content', $comment->content) }}</textarea>
                    @error('content') <div class="text-danger small">{{ $message }}</div> @enderror
                </div>

                <!-- Botones -->
                <div class="d-flex flex-column flex-sm-row justify-content-end gap-2 mt-4">
                    <a href="{{ route('comments.index') }}" class="btn btn-outline-secondary">
                        <i class="fas fa-arrow-left me-1"></i> Cancelar
                    </a>
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-save me-1"></i> Actualizar Comentario
                    </button>
                </div>
            </form>
        </div>

    </div>
</x-guest-layout>

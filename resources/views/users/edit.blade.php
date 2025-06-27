<x-guest-layout>
    <div class="container py-4">

        <!-- Encabezado -->
        <div class="bg-warning bg-gradient text-white rounded-3 p-3 mb-4 d-flex flex-wrap align-items-start gap-3">
            <div class="rounded-circle bg-white bg-opacity-25 d-flex align-items-center justify-content-center" style="width: 48px; height: 48px;">
                <i class="fas fa-user-cog fs-5"></i>
            </div>
            <div class="flex-grow-1">
                <h2 class="h6 mb-1">Editar Usuario</h2>
                <p class="mb-0 small">Modifique los campos necesarios y guarde los cambios.</p>
            </div>
        </div>

        <!-- Formulario -->
        <div class="bg-white rounded-3 shadow-sm p-4">
            <form action="{{ route('users.update', $user->id) }}" method="POST" id="editUserForm">
                @csrf
                @method('PUT')

                <div class="row g-3 mb-4">
                    <!-- Nombre -->
                    <div class="col-md-6">
                        <label for="name" class="form-label">Nombre Completo *</label>
                        <input type="text" id="name" name="name" class="form-control"
                               value="{{ old('name', $user->name) }}" placeholder="Ej: María López">
                        @error('name') <div class="text-danger small">{{ $message }}</div> @enderror
                    </div>

                    <!-- Correo -->
                    <div class="col-md-6">
                        <label for="email" class="form-label">Correo Electrónico *</label>
                        <div class="input-group">
                            <input type="email" id="email" name="email" class="form-control"
                                   value="{{ old('email', $user->email) }}" placeholder="usuario@correo.com">
                            <span class="input-group-text"><i class="fas fa-envelope text-muted"></i></span>
                        </div>
                        @error('email') <div class="text-danger small">{{ $message }}</div> @enderror
                    </div>

                    <!-- Rol -->
                    <div class="col-md-6">
                        <label for="role" class="form-label">Rol *</label>
                        <select id="role" name="role" class="form-select">
                            <option value="">Seleccione...</option>
                            <option value="estudiante" {{ old('role', $user->role) == 'estudiante' ? 'selected' : '' }}>Estudiante</option>
                            <option value="profesor" {{ old('role', $user->role) == 'profesor' ? 'selected' : '' }}>Profesor</option>
                            <option value="administrador" {{ old('role', $user->role) == 'administrador' ? 'selected' : '' }}>Administrador</option>
                            <option value="superadmin" {{ old('role', $user->role) == 'superadmin' ? 'selected' : '' }}>Super Administrador</option>
                        </select>
                        @error('role') <div class="text-danger small">{{ $message }}</div> @enderror
                    </div>
                </div>

                <!-- Botones -->
                <div class="d-flex flex-column flex-sm-row justify-content-end gap-2 mt-4">
                    <a href="{{ route('users.index') }}" class="btn btn-outline-secondary">
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
        function formatFullName(input) {
            const caret = input.selectionStart;
            let text = input.value;

            text = text
                .replace(/[0-9]/g, '')
                .replace(/[^\p{L}\s]/gu, '')
                .replace(/\s{2,}/g, ' ');

            text = text.replace(/\b(\p{L})(\p{L}*)\b/gu, (match, first, rest) =>
                first.toUpperCase() + rest.toLowerCase()
            );

            input.value = text.slice(0, 60);
            input.setSelectionRange(caret, caret);
        }

        document.addEventListener('DOMContentLoaded', () => {
            const nameInput = document.getElementById('name');
            if (nameInput) {
                nameInput.addEventListener('input', () => formatFullName(nameInput));
            }
        });
    </script>
</x-guest-layout>

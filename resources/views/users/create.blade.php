<x-guest-layout>
    <div class="container py-4">
        <!-- Encabezado -->
        <div class="bg-primary bg-gradient text-white rounded-3 p-3 mb-4 d-flex align-items-start gap-3 flex-wrap">
            <div class="rounded-circle bg-white bg-opacity-25 d-flex align-items-center justify-content-center" style="width: 48px; height: 48px;">
                <i class="fas fa-user-cog fs-5"></i>
            </div>
            <div>
                <h2 class="h6 mb-1">Registrar Usuario</h2>
                <p class="mb-0 small">Complete la información para crear un nuevo usuario.</p>
            </div>
        </div>

        <!-- Formulario -->
        <div class="bg-white rounded-3 shadow-sm p-4">
            <form action="{{ route('users.store') }}" method="POST" id="userForm">
                @csrf

                <div class="row g-3 mb-4">
                    <!-- Nombre -->
                    <div class="col-md-6">
                        <label for="name" class="form-label">Nombre Completo *</label>
                        <input type="text" id="name" name="name" class="form-control" placeholder="Ej: María López" value="{{ old('name') }}">
                        @error('name') <div class="text-danger small">{{ $message }}</div> @enderror
                    </div>

                    <!-- Correo -->
                    <div class="col-md-6">
                        <label for="email" class="form-label">Correo Electrónico *</label>
                        <div class="input-group">
                            <input type="email" id="email" name="email" class="form-control" placeholder="usuario@correo.com" value="{{ old('email') }}">
                            <span class="input-group-text"><i class="fas fa-envelope text-muted"></i></span>
                        </div>
                        @error('email') <div class="text-danger small">{{ $message }}</div> @enderror
                    </div>

                    <!-- Rol -->
                    <div class="col-md-6">
                        <label for="role" class="form-label">Rol *</label>
                        <select id="role" name="role" class="form-select">
                            <option value="">Seleccione...</option>
                            <option value="estudiante" {{ old('role') == 'estudiante' ? 'selected' : '' }}>Estudiante</option>
                            <option value="profesor" {{ old('role') == 'profesor' ? 'selected' : '' }}>Profesor</option>
                            <option value="administrador" {{ old('role') == 'administrador' ? 'selected' : '' }}>Administrador</option>
                            <option value="superadmin" {{ old('role') == 'superadmin' ? 'selected' : '' }}>Super Administrador</option>

                        </select>
                        @error('role') <div class="text-danger small">{{ $message }}</div> @enderror
                    </div>

                    <!-- Contraseña -->
                    <div class="col-md-6">
                        <label for="password" class="form-label">Contraseña *</label>
                        <div class="input-group">
                            <input type="password" id="password" name="password" class="form-control" placeholder="********">
                            <button type="button" class="btn btn-outline-secondary" onclick="togglePassword('password')">
                                <i class="fas fa-eye"></i>
                            </button>
                        </div>
                        @error('password') <div class="text-danger small">{{ $message }}</div> @enderror
                    </div>

                    <!-- Confirmar Contraseña -->
                    <div class="col-md-6">
                        <label for="password_confirmation" class="form-label">Confirmar Contraseña *</label>
                        <div class="input-group">
                            <input type="password" id="password_confirmation" name="password_confirmation" class="form-control" placeholder="********">
                            <button type="button" class="btn btn-outline-secondary" onclick="togglePassword('password_confirmation')">
                                <i class="fas fa-eye"></i>
                            </button>
                        </div>
                    </div>
                </div>

                <!-- Botones -->
                <div class="d-flex flex-column flex-sm-row justify-content-end gap-2 mt-4">
                    <a href="{{ route('users.index') }}" class="btn btn-outline-secondary">
                        <i class="fas fa-times me-1"></i> Cancelar
                    </a>
                    <button type="reset" class="btn btn-warning text-white">
                        <i class="fas fa-broom me-1"></i> Limpiar
                    </button>
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-user-plus me-1"></i> Registrar Usuario
                    </button>
                </div>
            </form>
        </div>
    </div>

    <!-- Scripts -->
    <script>
        // Mostrar/ocultar contraseña
        function togglePassword(id) {
            const input = document.getElementById(id);
            const icon = event.currentTarget.querySelector('i');

            if (input.type === "password") {
                input.type = "text";
                icon.classList.remove("fa-eye");
                icon.classList.add("fa-eye-slash");
            } else {
                input.type = "password";
                icon.classList.remove("fa-eye-slash");
                icon.classList.add("fa-eye");
            }
        }

        // Formato de nombre completo
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

        // Activar formato al escribir
        document.addEventListener('DOMContentLoaded', () => {
            const nameInput = document.getElementById('name');
            if (nameInput) {
                nameInput.addEventListener('input', () => formatFullName(nameInput));
            }
        });
    </script>
</x-guest-layout>

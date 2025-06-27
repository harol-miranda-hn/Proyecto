<x-guest-layout>
    <div class="container py-4">

        <!-- Encabezado del formulario -->
        <div class="bg-primary bg-gradient text-white rounded-3 p-3 mb-4 d-flex flex-wrap align-items-start gap-3">
            <div class="rounded-circle bg-white bg-opacity-25 d-flex align-items-center justify-content-center" style="width: 48px; height: 48px;">
                <i class="fas fa-user-graduate fs-5"></i>
            </div>
            <div class="flex-grow-1">
                <h2 class="h6 mb-1">Registro de Nuevo Alumno</h2>
                <p class="mb-0 small">Complete todos los campos requeridos para registrar un nuevo alumno</p>
            </div>
        </div>

        <!-- Contenedor del formulario -->
        <div class="bg-white rounded-3 shadow-sm p-4">
            <form action="{{ route('alumnos.store') }}" method="POST" id="studentForm">
                @csrf

                <!-- Información Personal -->
                <div class="mb-4 border-bottom pb-3">
                    <div class="d-flex align-items-center text-primary mb-3">
                        <div class="bg-light rounded-circle d-flex justify-content-center align-items-center me-2" style="width: 32px; height: 32px;">
                            <i class="fas fa-user small"></i>
                        </div>
                        <h5 class="mb-0">Información Personal</h5>
                    </div>

                    <div class="row g-3">
                        <div class="col-md-6">
                            <label for="nombre_completo" class="form-label">Nombre Completo *</label>
                            <input type="text" class="form-control" id="nombre_completo" name="nombre_completo" value="{{ old('nombre_completo') }}" placeholder="Ej: Juan Carlos Pérez López">
                            @error('nombre_completo') <div class="text-danger small">{{ $message }}</div> @enderror
                        </div>

                        <div class="col-md-6">
                            <label for="email" class="form-label">Correo Electrónico</label>
                            <div class="input-group">
                                <input type="email" id="email" name="email" class="form-control" placeholder="Ej: alumno@instituto.edu" value="{{ old('email') }}">
                                <span class="input-group-text"><i class="fas fa-envelope text-muted"></i></span>
                            </div>
                            @error('email') <div class="text-danger small">{{ $message }}</div> @enderror
                        </div>

                        <div class="col-md-3">
                            <label for="numero_identidad" class="form-label">Número de Identidad *</label>
                            <div class="input-group">
                                <input type="text" class="form-control" id="numero_identidad" name="numero_identidad" maxlength="13" value="{{ old('numero_identidad') }}" placeholder="Ej: 0801199901234">
                                <span class="input-group-text"><i class="fas fa-id-card text-muted"></i></span>
                            </div>
                            @error('numero_identidad') <div class="text-danger small">{{ $message }}</div> @enderror
                        </div>

                        <div class="col-md-3">
                            <label for="telefono" class="form-label">Teléfono *</label>
                            <div class="input-group">
                                <input type="text" class="form-control" id="telefono" name="telefono" maxlength="8" value="{{ old('telefono') }}" placeholder="Ej: 99998888">
                                <span class="input-group-text"><i class="fas fa-phone text-muted"></i></span>
                            </div>
                            @error('telefono') <div class="text-danger small">{{ $message }}</div> @enderror
                        </div>

                        <div class="col-md-3">
                            <label for="fecha_nacimiento" class="form-label">Fecha de Nacimiento *</label>
                            <input type="date" class="form-control" id="fecha_nacimiento" name="fecha_nacimiento" value="{{ old('fecha_nacimiento') }}">
                            @error('fecha_nacimiento') <div class="text-danger small">{{ $message }}</div> @enderror
                        </div>

                        <div class="col-md-3">
                            <label for="genero" class="form-label">Género *</label>
                            <div class="input-group">
                                <select class="form-select" id="genero" name="genero">
                                    <option value="">Seleccione...</option>
                                    <option value="M" {{ old('genero') == 'M' ? 'selected' : '' }}>Masculino</option>
                                    <option value="F" {{ old('genero') == 'F' ? 'selected' : '' }}>Femenino</option>
                                </select>
                                <span class="input-group-text"><i class="fas fa-venus-mars text-muted"></i></span>
                            </div>
                            @error('genero') <div class="text-danger small">{{ $message }}</div> @enderror
                        </div>

                        <div class="col-md-12">
                            <label for="direccion" class="form-label">Dirección *</label>
                            <div class="input-group">
                                <textarea class="form-control" id="direccion" name="direccion" rows="3" placeholder="Ingrese la dirección completa">{{ old('direccion') }}</textarea>
                                <span class="input-group-text"><i class="fas fa-map-marker-alt text-muted"></i></span>
                            </div>
                            @error('direccion') <div class="text-danger small">{{ $message }}</div> @enderror
                        </div>
                    </div>
                </div>

                <!-- Información Adicional -->
                <div class="mb-4 border-bottom pb-3">
                    <div class="d-flex align-items-center text-primary mb-3">
                        <div class="bg-light rounded-circle d-flex justify-content-center align-items-center me-2" style="width: 32px; height: 32px;">
                            <i class="fas fa-info-circle small"></i>
                        </div>
                        <h5 class="mb-0">Información Adicional</h5>
                    </div>

                    <div class="row g-3">
                        <div class="col-md-4">
                            <label for="encargado_nombre" class="form-label">Nombre del Encargado *</label>
                            <input type="text" class="form-control" id="encargado_nombre" name="encargado_nombre" value="{{ old('encargado_nombre') }}" placeholder="Ej: María López">
                            @error('encargado_nombre') <div class="text-danger small">{{ $message }}</div> @enderror
                        </div>

                        <div class="col-md-4">
                            <label for="encargado_telefono" class="form-label">Teléfono del Encargado *</label>
                            <div class="input-group">
                                <input type="text" class="form-control" id="encargado_telefono" name="encargado_telefono" maxlength="8" value="{{ old('encargado_telefono') }}" placeholder="Ej: 88887777">
                                <span class="input-group-text"><i class="fas fa-mobile-alt text-muted"></i></span>
                            </div>
                            @error('encargado_telefono') <div class="text-danger small">{{ $message }}</div> @enderror
                        </div>

                        <div class="col-md-4">
                            <label for="parentesco" class="form-label">Parentesco *</label>
                            <div class="input-group">
                                <select class="form-select" id="parentesco" name="parentesco">
                                    <option value="">Seleccione...</option>
                                    <option value="madre" {{ old('parentesco') == 'madre' ? 'selected' : '' }}>Madre</option>
                                    <option value="padre" {{ old('parentesco') == 'padre' ? 'selected' : '' }}>Padre</option>
                                    <option value="tutor" {{ old('parentesco') == 'tutor' ? 'selected' : '' }}>Tutor</option>
                                    <option value="otro" {{ old('parentesco') == 'otro' ? 'selected' : '' }}>Otro</option>
                                </select>
                                <span class="input-group-text"><i class="fas fa-users text-muted"></i></span>
                            </div>
                            @error('parentesco') <div class="text-danger small">{{ $message }}</div> @enderror
                        </div>

                        <div class="col-md-6">
                            <label for="descripcion_enfermedad" class="form-label">Información de Salud</label>
                            <div class="input-group">
                                <textarea class="form-control" id="descripcion_enfermedad" name="descripcion_enfermedad" rows="3" placeholder="Detalles de enfermedades, alergias o condiciones médicas...">{{ old('descripcion_enfermedad') }}</textarea>
                                <span class="input-group-text"><i class="fas fa-heartbeat text-muted"></i></span>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <label for="descripcion_observacion" class="form-label">Observaciones</label>
                            <div class="input-group">
                                <textarea class="form-control" id="descripcion_observacion" name="descripcion_observacion" rows="3" placeholder="Observaciones conductuales o académicas...">{{ old('descripcion_observacion') }}</textarea>
                                <span class="input-group-text"><i class="fas fa-clipboard-check text-muted"></i></span>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Botones -->
                <div class="d-flex flex-column flex-sm-row justify-content-end gap-2 mt-4">
                    <a href="{{ route('alumnos.index') }}" class="btn btn-outline-secondary">
                        <i class="fas fa-times me-1"></i> Cancelar
                    </a>
                    <button type="reset" class="btn btn-warning text-white">
                        <i class="fas fa-broom me-1"></i> Limpiar
                    </button>
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-user-plus me-1"></i> Registrar Alumno
                    </button>
                </div>
            </form>
        </div>
    </div>

    <script>
        function formatFullName(input) {
            const caret = input.selectionStart;
            let text = input.value;

            // Limpieza: números y símbolos no letras
            text = text
                .replace(/[0-9]/g, '')               // elimina números
                .replace(/[^\p{L}\s]/gu, '')         // solo letras y espacios
                .replace(/\s{2,}/g, ' ')             // múltiples espacios → uno

            // Lista de vocales tildadas en minúscula
            const tildedLower = ['á', 'é', 'í', 'ó', 'ú', 'Á', 'É', 'Í'];

            // Capitalizar palabra por palabra
            text = text.replace(/\b(\p{L})(\p{L}*)\b/gu, (match, first, rest) => {
                const isTildedLower = tildedLower.includes(first);
                const isTildedUpper = first.match(/[ÁÉÍÓÚ]/);

                let capitalizedFirst;

                if (isTildedUpper) {
                    // Mantener vocal con tilde si ya fue escrita en mayúscula
                    capitalizedFirst = first;
                } else if (isTildedLower) {
                    // Si fue minúscula con tilde, quitar tilde y pasar a mayúscula
                    capitalizedFirst = first.normalize("NFD").replace(/[\u0300-\u036f]/g, '').toUpperCase();
                } else {
                    capitalizedFirst = first.toUpperCase();
                }

                return capitalizedFirst + rest.toLowerCase();
            });

            input.value = text.slice(0, 60);
            input.setSelectionRange(caret, caret);
        }

        function formatTextArea(input, capitalizarCadaPalabra = false) {
            const caret = input.selectionStart;
            let text = input.value;

            // Limpieza: elimina múltiples espacios y caracteres no válidos, sin cambiar mayúsculas aún
            text = text
                .replace(/\s{2,}/g, ' ') // múltiples espacios → uno
                .replace(/^[ ]+/, '')    // sin espacios al inicio
                .replace(/[^\p{L}\d\s.,:;()¿?¡!'"-]/gu, '') // solo letras, números y puntuación básica

            if (capitalizarCadaPalabra) {
                // Capitaliza la primera letra de cada palabra, sin modificar lo demás
                text = text.replace(/\b(\p{L})(\p{L}*)\b/gu, (match, first, rest) =>
                    first.toUpperCase() + rest.toLowerCase()
                );
            } else {
                // Solo capitaliza la primera letra de la primera palabra; mantiene mayúsculas existentes
                text = text.charAt(0).toUpperCase() + text.slice(1);
            }

            input.value = text.slice(0, 255);
            input.setSelectionRange(caret, caret);
        }

        function validateIdentity(input) {
            let value = input.value.replace(/\D/g, '');
            if (value.length > 0) {
                if (value[0] !== '0' && value[0] !== '1') {
                    value = '';
                } else if (value.length > 1) {
                    if (value[0] === '0' && !(parseInt(value[1]) >= 1 && parseInt(value[1]) <= 9)) {
                        value = value[0];
                    }
                    if (value[0] === '1' && !(parseInt(value[1]) >= 0 && parseInt(value[1]) <= 8)) {
                        value = value[0];
                    }
                }
            }
            input.value = value.slice(0, 13);
        }

        function validatePhone(input) {
            let value = input.value.replace(/\D/g, '');
            if (value.length > 0 && !/^[2389]/.test(value)) {
                value = '';
            }
            input.value = value.slice(0, 8);
        }

        function validateEmail(input) {
            input.value = input.value.replace(/[^a-zA-Z0-9@.+-_]/g, '');
        }

        document.addEventListener('DOMContentLoaded', () => {
            const nombreCampos = ['nombre_completo', 'encargado_nombre'];
            const identidadCampos = ['numero_identidad'];
            const telefonoCampos = ['telefono', 'encargado_telefono'];
            const emailCampos = ['email'];
            const textoLargoCampos = ['direccion', 'descripcion_enfermedad', 'descripcion_observacion'];

            nombreCampos.forEach(id => {
                const el = document.getElementById(id);
                if (el) el.addEventListener('input', () => formatFullName(el));
            });

            identidadCampos.forEach(id => {
                const el = document.getElementById(id);
                if (el) el.addEventListener('input', () => validateIdentity(el));
            });

            telefonoCampos.forEach(id => {
                const el = document.getElementById(id);
                if (el) el.addEventListener('input', () => validatePhone(el));
            });

            emailCampos.forEach(id => {
                const el = document.getElementById(id);
                if (el) el.addEventListener('input', () => validateEmail(el));
            });

            textoLargoCampos.forEach(id => {
                const el = document.getElementById(id);
                if (el) el.addEventListener('input', () => formatTextArea(el));
            });
        });
    </script>

</x-guest-layout>

<x-guest-layout>
    <div class="form-header">
        <div class="header-icon">
            <i class="fas fa-user-graduate"></i>
        </div>
        <div class="header-text">
            <h2>Registro de Nuevo Alumno</h2>
            <p>Complete todos los campos requeridos para registrar un nuevo alumno</p>
        </div>
    </div>

    <div class="form-container">
        <form action="{{ route('alumnos.store') }}" method="POST" id="studentForm">
            @csrf
            <!-- Información Personal -->
            <div class="form-section">
                <div class="section-title">
                    <i class="fas fa-user"></i>
                    <h3>Información Personal</h3>
                </div>

                <div class="form-grid">
                    <div class="input-group half-width">
                        <label for="nombre_completo">Nombre Completo *</label>
                        <input type="text" id="nombre_completo" name="nombre_completo" class="input-field"
                               placeholder="Ej: Juan Carlos Pérez López" value="{{ old('nombre_completo') }}">
                        @error('nombre_completo')
                        <span class="error-message">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="input-group half-width">
                        <label for="email">Correo Electrónico</label>
                        <input type="email" id="email" name="email" class="input-field"
                               placeholder="Ej: alumno@instituto.edu" value="{{ old('email') }}">
                        <i class="fas fa-envelope input-icon"></i>
                        @error('email')
                        <span class="error-message">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="input-group">
                        <label for="numero_identidad">Número de Identidad *</label>
                        <input type="text" id="numero_identidad" name="numero_identidad" class="input-field"
                               placeholder="Ej: 0801199901234" maxlength="13" value="{{ old('numero_identidad') }}">
                        <i class="fas fa-id-card input-icon"></i>
                        @error('numero_identidad')
                        <span class="error-message">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="input-group">
                        <label for="telefono">Teléfono *</label>
                        <input type="text" id="telefono" name="telefono" class="input-field"
                               placeholder="Ej: 99998888" maxlength="8" value="{{ old('telefono') }}">
                        <i class="fas fa-phone input-icon"></i>
                        @error('telefono')
                        <span class="error-message">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="input-group">
                        <label for="fecha_nacimiento">Fecha de Nacimiento *</label>
                        <input type="date" id="fecha_nacimiento" name="fecha_nacimiento" class="input-field" value="{{ old('fecha_nacimiento') }}">
                        @error('fecha_nacimiento')
                        <span class="error-message">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="input-group">
                        <label for="genero">Género *</label>
                        <select id="genero" name="genero" class="input-field">
                            <option value="">Seleccione...</option>
                            <option value="M" {{ old('genero') == 'M' ? 'selected' : '' }}>Masculino</option>
                            <option value="F" {{ old('genero') == 'F' ? 'selected' : '' }}>Femenino</option>
                        </select>
                        <i class="fas fa-venus-mars input-icon"></i>
                        @error('genero')
                        <span class="error-message">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="input-group half-width">
                        <label for="direccion">Dirección *</label>
                        <textarea id="direccion" name="direccion" class="input-field"
                                  placeholder="Ingrese la dirección completa">{{ old('direccion') }}</textarea>
                        <i class="fas fa-map-marker-alt input-icon"></i>
                        @error('direccion')
                        <span class="error-message">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
            </div>

            <!-- Información Adicional -->
            <div class="form-section">
                <div class="section-title">
                    <i class="fas fa-info-circle"></i>
                    <h3>Información Adicional</h3>
                </div>

                <div class="form-grid">
                    <div class="input-group">
                        <label for="encargado_nombre">Nombre del Encargado *</label>
                        <input type="text" id="encargado_nombre" name="encargado_nombre" class="input-field"
                               placeholder="Ej: María López" value="{{ old('encargado_nombre') }}">
                        @error('encargado_nombre')
                        <span class="error-message">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="input-group">
                        <label for="encargado_telefono">Teléfono del Encargado *</label>
                        <input type="text" id="encargado_telefono" name="encargado_telefono" class="input-field"
                               placeholder="Ej: 88887777" maxlength="8" value="{{ old('encargado_telefono') }}">
                        <i class="fas fa-mobile-alt input-icon"></i>
                        @error('encargado_telefono')
                        <span class="error-message">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="input-group">
                        <label for="parentesco">Parentesco *</label>
                        <select id="parentesco" name="parentesco" class="input-field">
                            <option value="">Seleccione...</option>
                            <option value="madre" {{ old('parentesco') == 'madre' ? 'selected' : '' }}>Madre</option>
                            <option value="padre" {{ old('parentesco') == 'padre' ? 'selected' : '' }}>Padre</option>
                            <option value="tutor" {{ old('parentesco') == 'tutor' ? 'selected' : '' }}>Tutor</option>
                            <option value="otro" {{ old('parentesco') == 'otro' ? 'selected' : '' }}>Otro</option>
                        </select>
                        <i class="fas fa-users input-icon"></i>
                        @error('parentesco')
                        <span class="error-message">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="input-group half-width">
                        <label for="descripcion_enfermedad">Información de Salud</label>
                        <textarea id="descripcion_enfermedad" name="descripcion_enfermedad" class="input-field"
                                  placeholder="Detalles de enfermedades, alergias o condiciones médicas...">{{ old('descripcion_enfermedad') }}</textarea>
                        <i class="fas fa-heartbeat input-icon"></i>
                    </div>

                    <div class="input-group half-width">
                        <label for="descripcion_observacion">Observaciones</label>
                        <textarea id="descripcion_observacion" name="descripcion_observacion" class="input-field"
                                  placeholder="Observaciones conductuales o académicas...">{{ old('descripcion_observacion') }}</textarea>
                        <i class="fas fa-clipboard-check input-icon"></i>
                    </div>
                </div>
            </div>

            <!-- Botones de acción -->
            <div class="button-group">
                <a href="{{ route('alumnos.index') }}" class="btn btn-cancel">
                    <i class="fas fa-times"></i> Cancelar
                </a>
                <button type="reset" class="btn btn-clear">
                    <i class="fas fa-broom"></i> Limpiar
                </button>
                <button type="submit" class="btn btn-submit">
                    <i class="fas fa-user-plus"></i> Registrar Alumno
                </button>
            </div>
        </form>
    </div>

    <script>
        // Capitalizar nombres, sin números, y sin dobles espacios
        function formatFullName(input) {
            let caret = input.selectionStart; // Para mantener el cursor

            let text = input.value
                .replace(/[0-9]/g, '')           // elimina números
                .replace(/\s{2,}/g, ' ')         // solo un espacio máximo
                .replace(/[^\S\r\n]+$/g, '')     // elimina espacios finales sin afectar escritura
                .toLowerCase()
                .split(' ')
                .filter(word => word !== '')
                .map(word => word.charAt(0).toUpperCase() + word.slice(1))
                .join(' ');

            input.value = text.slice(0, 100);
            input.setSelectionRange(caret, caret); // Restaura el cursor
        }

        // Solo números y validación de identidad hondureña
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

        // Teléfono: solo números, máximo 8 dígitos, empieza con 2,3,8,9
        function validatePhone(input) {
            let value = input.value.replace(/\D/g, '');
            if (value.length > 0 && !/^[2389]/.test(value)) {
                value = '';
            }
            input.value = value.slice(0, 8);
        }

        // Email: solo caracteres válidos
        function validateEmail(input) {
            input.value = input.value.replace(/[^a-zA-Z0-9@.+-]/g, '');
        }

        // Textareas: sin más de un espacio, primera letra mayúscula, 255 caracteres
        function formatTextArea(input) {
            let caret = input.selectionStart;

            let text = input.value
                .replace(/\s{2,}/g, ' ')       // solo un espacio máximo
                .replace(/[^\S\r\n]+$/g, '')   // elimina espacios finales sin eliminar el último mientras escribe
                .toLowerCase();

            text = text.charAt(0).toUpperCase() + text.slice(1);
            input.value = text.slice(0, 255);
            input.setSelectionRange(caret, caret);
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

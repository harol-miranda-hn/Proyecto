<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro de Alumnos - Instituto Técnico Danlí</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600&display=swap" rel="stylesheet">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Poppins', sans-serif;
        }

        body {
            background: linear-gradient(135deg, #f5f7fa 0%, #e4edf9 100%);
            color: #333;
            min-height: 100vh;
            padding: 20px;
        }

        .app-container {
            max-width: 1400px;
            margin: 0 auto;
            background: white;
            border-radius: 12px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.08);
            overflow: hidden;
        }

        /* Navbar */
        .navbar {
            background: linear-gradient(90deg, #1a3c6e 0%, #0d2a5a 100%);
            color: white;
            padding: 15px 30px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .logo {
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .logo-icon {
            font-size: 28px;
            color: #4da6ff;
        }

        .logo-text h1 {
            font-size: 1.4rem;
            font-weight: 600;
        }

        .logo-text p {
            font-size: 0.8rem;
            opacity: 0.8;
        }

        .user-info {
            display: flex;
            align-items: center;
            gap: 15px;
        }

        .user-avatar {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            background: #4da6ff;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 18px;
        }

        /* Layout principal */
        .main-layout {
            display: flex;
            min-height: calc(100vh - 90px);
        }

        /* Sidebar */
        .sidebar {
            width: 220px;
            background: #2c3e50;
            color: white;
            padding: 25px 0;
            transition: all 0.3s ease;
        }

        .sidebar-menu {
            padding: 0 15px;
        }

        .menu-item {
            display: flex;
            align-items: center;
            padding: 12px 15px;
            border-radius: 6px;
            margin-bottom: 5px;
            transition: all 0.2s;
            cursor: pointer;
            color: rgba(255, 255, 255, 0.85);
            text-decoration: none;
        }

        .menu-item:hover, .menu-item.active {
            background: rgba(255, 255, 255, 0.1);
            color: white;
        }

        .menu-item i {
            width: 28px;
            font-size: 16px;
            text-align: center;
        }

        .menu-text {
            font-size: 0.9rem;
        }

        /* Contenido principal */
        .main-content {
            flex: 1;
            padding: 25px;
            background: #f9fbfd;
        }

        /* Encabezado del formulario */
        .form-header {
            background: linear-gradient(135deg, #2196f3 0%, #0d47a1 100%);
            color: white;
            padding: 20px;
            border-radius: 10px;
            margin-bottom: 25px;
            display: flex;
            align-items: center;
            gap: 15px;
        }

        .header-icon {
            width: 50px;
            height: 50px;
            background: rgba(255, 255, 255, 0.2);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 22px;
        }

        .header-text h2 {
            font-size: 1.5rem;
            margin-bottom: 5px;
        }

        .header-text p {
            font-size: 0.9rem;
            opacity: 0.9;
        }

        /* Formulario */
        .form-container {
            background: white;
            border-radius: 10px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.05);
            padding: 25px;
        }

        .form-section {
            margin-bottom: 30px;
            padding-bottom: 20px;
            border-bottom: 1px solid #eee;
        }

        .section-title {
            display: flex;
            align-items: center;
            margin-bottom: 20px;
            color: #1976d2;
            font-weight: 500;
            font-size: 1.1rem;
        }

        .section-title i {
            background: #e3f2fd;
            width: 32px;
            height: 32px;
            border-radius: 50%;
            display: flex;
            justify-content: center;
            align-items: center;
            margin-right: 12px;
            font-size: 14px;
        }

        /* Grid de 4 columnas */
        .form-grid {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 18px;
        }

        .input-group {
            position: relative;
        }

        .input-group.full-width {
            grid-column: span 4;
        }

        .input-group.half-width {
            grid-column: span 2;
        }

        .input-group label {
            display: block;
            margin-bottom: 8px;
            font-size: 0.9rem;
            color: #555;
            font-weight: 500;
        }

        .input-field {
            width: 100%;
            padding: 11px 14px;
            border: 1px solid #ddd;
            border-radius: 7px;
            font-size: 0.95rem;
            transition: all 0.2s;
            background: #fafafa;
        }

        .input-field:focus {
            border-color: #2196f3;
            box-shadow: 0 0 0 3px rgba(33, 150, 243, 0.2);
            outline: none;
            background: white;
        }

        .input-icon {
            position: absolute;
            right: 14px;
            top: 38px;
            color: #777;
            font-size: 16px;
        }

        textarea.input-field {
            min-height: 100px;
            resize: vertical;
        }

        /* Botones */
        .button-group {
            display: flex;
            justify-content: flex-end;
            gap: 12px;
            margin-top: 20px;
        }

        .btn {
            padding: 11px 24px;
            border-radius: 7px;
            font-size: 0.95rem;
            font-weight: 500;
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: center;
            transition: all 0.2s;
            border: none;
        }

        .btn i {
            margin-right: 8px;
        }

        .btn-cancel {
            background: #f5f5f5;
            color: #555;
            border: 1px solid #ddd;
        }

        .btn-cancel:hover {
            background: #e0e0e0;
        }

        .btn-clear {
            background: #ff9800;
            color: white;
        }

        .btn-clear:hover {
            background: #f57c00;
        }

        .btn-submit {
            background: #2196f3;
            color: white;
        }

        .btn-submit:hover {
            background: #1976d2;
        }

        /* Mensajes de error */
        .error-message {
            color: #f44336;
            font-size: 0.85rem;
            margin-top: 5px;
            display: block;
        }

        /* Responsive */
        @media (max-width: 1200px) {
            .form-grid {
                grid-template-columns: repeat(2, 1fr);
            }
        }

        @media (max-width: 768px) {
            .main-layout {
                flex-direction: column;
            }

            .sidebar {
                width: 100%;
                padding: 15px 0;
            }

            .form-grid {
                grid-template-columns: 1fr;
            }

            .input-group.half-width {
                grid-column: span 1;
            }

            .button-group {
                flex-direction: column;
            }

            .btn {
                width: 100%;
                margin-bottom: 10px;
            }
        }
    </style>
</head>
<body>
<div class="app-container">
    <!-- Navbar -->
    <nav class="navbar">
        <div class="logo">
            <i class="fas fa-graduation-cap logo-icon"></i>
            <div class="logo-text">
                <h1>Instituto Técnico Danlí</h1>
                <p>Sistema de Gestión Académica</p>
            </div>
        </div>
        <div class="user-info">
            <div class="user-avatar">
                <i class="fas fa-user"></i>
            </div>
            <div>
                <div>Administrador</div>
                <div style="font-size: 0.85rem; opacity: 0.8;">admin@instituto.edu</div>
            </div>
        </div>
    </nav>

    <div class="main-layout">
        <!-- Sidebar -->

        <aside class="sidebar">
            <div class="sidebar-menu">
                <a href="#" class="menu-item">
                    <i class="fas fa-tachometer-alt"></i>
                    <span class="menu-text">Inicio</span>
                </a>
                <a href="#" class="menu-item">
                    <i class="fas fa-project-diagram"></i>
                    <span class="menu-text">Grados</span>
                </a>
                <a href="#" class="menu-item active">
                    <i class="fas fa-users"></i>
                    <span class="menu-text">Alumnos</span>
                </a>
                <a href="#" class="menu-item">
                    <i class="fas fa-file-contract"></i>
                    <span class="menu-text">Matrícula</span>
                </a>
                <a href="#" class="menu-item">
                    <i class="fas fa-book"></i>
                    <span class="menu-text">Asignaturas</span>
                </a>
                <a href="#" class="menu-item">
                    <i class="fas fa-graduation-cap"></i>
                    <span class="menu-text">Calificaciones</span>
                </a>
                <a href="#" class="menu-item">
                    <i class="fas fa-user-cog"></i>
                    <span class="menu-text">Usuarios</span>
                </a>
            </div>
        </aside>

        <!-- Contenido principal -->
        <main class="main-content">
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
                <form id="studentForm">
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
                                       placeholder="Ej: Juan Carlos Pérez López">
                                <span class="error-message" id="name-error"></span>
                            </div>

                            <div class="input-group half-width">
                                <label for="email">Correo Electrónico</label>
                                <input type="email" id="email" name="email" class="input-field"
                                       placeholder="Ej: alumno@instituto.edu">
                                <i class="fas fa-envelope input-icon"></i>
                                <span class="error-message" id="email-error"></span>
                            </div>

                            <div class="input-group">
                                <label for="numero_identidad">Número de Identidad *</label>
                                <input type="text" id="numero_identidad" name="numero_identidad" class="input-field"
                                       placeholder="Ej: 0801199901234" maxlength="13">
                                <i class="fas fa-id-card input-icon"></i>
                                <span class="error-message" id="id-error"></span>
                            </div>

                            <div class="input-group">
                                <label for="telefono">Teléfono *</label>
                                <input type="text" id="telefono" name="telefono" class="input-field"
                                       placeholder="Ej: 99998888" maxlength="8">
                                <i class="fas fa-phone input-icon"></i>
                                <span class="error-message" id="phone-error"></span>
                            </div>

                            <div class="input-group">
                                <label for="fecha_nacimiento">Fecha de Nacimiento *</label>
                                <input type="date" id="fecha_nacimiento" name="fecha_nacimiento" class="input-field">
                                <span class="error-message" id="birth-error"></span>
                            </div>

                            <div class="input-group">
                                <label for="genero">Género *</label>
                                <select id="genero" name="genero" class="input-field">
                                    <option value="">Seleccione...</option>
                                    <option value="M">Masculino</option>
                                    <option value="F">Femenino</option>
                                </select>
                                <i class="fas fa-venus-mars input-icon"></i>
                                <span class="error-message" id="gender-error"></span>
                            </div>





                            <div class="input-group half-width">
                                <label for="direccion">Dirección *</label>
                                <textarea id="direccion" name="direccion" class="input-field"
                                          placeholder="Ingrese la dirección completa"></textarea>
                                <i class="fas fa-map-marker-alt input-icon"></i>
                                <span class="error-message" id="address-error"></span>
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
                                       placeholder="Ej: María López">
                                <span class="error-message" id="guardian-error"></span>
                            </div>

                            <div class="input-group">
                                <label for="encargado_telefono">Teléfono del Encargado *</label>
                                <input type="text" id="encargado_telefono" name="encargado_telefono" class="input-field"
                                       placeholder="Ej: 88887777" maxlength="8">
                                <i class="fas fa-mobile-alt input-icon"></i>
                                <span class="error-message" id="guardian-phone-error"></span>
                            </div>

                            <div class="input-group">
                                <label for="parentesco">Parentesco *</label>
                                <select id="parentesco" name="parentesco" class="input-field">
                                    <option value="">Seleccione...</option>
                                    <option value="madre">Madre</option>
                                    <option value="padre">Padre</option>
                                    <option value="tutor">Tutor</option>
                                    <option value="otro">Otro</option>
                                </select>
                                <i class="fas fa-users input-icon"></i>
                                <span class="error-message" id="relationship-error"></span>
                            </div>

                            <div class="input-group half-width">
                                <label for="descripcion_enfermedad">Información de Salud</label>
                                <textarea id="descripcion_enfermedad" name="descripcion_enfermedad" class="input-field"
                                          placeholder="Detalles de enfermedades, alergias o condiciones médicas..."></textarea>
                                <i class="fas fa-heartbeat input-icon"></i>
                            </div>

                            <div class="input-group half-width">
                                <label for="descripcion_observacion">Observaciones</label>
                                <textarea id="descripcion_observacion" name="descripcion_observacion" class="input-field"
                                          placeholder="Observaciones conductuales o académicas..."></textarea>
                                <i class="fas fa-clipboard-check input-icon"></i>
                            </div>
                        </div>
                    </div>

                    <!-- Botones de acción -->
                    <div class="button-group">
                        <button type="button" class="btn btn-cancel" onclick="window.location.href='#'">
                            <i class="fas fa-times"></i> Cancelar
                        </button>
                        <button type="reset" class="btn btn-clear">
                            <i class="fas fa-broom"></i> Limpiar
                        </button>
                        <button type="submit" class="btn btn-submit">
                            <i class="fas fa-user-plus"></i> Registrar Alumno
                        </button>
                    </div>
                </form>
            </div>
        </main>


        <script>
            // Validación del formulario al enviar
            document.getElementById('studentForm').addEventListener('submit', function(e) {
                e.preventDefault();
                let isValid = true;

                // Limpiar errores previos
                document.querySelectorAll('.error-message').forEach(el => el.textContent = '');

                // Validar campos obligatorios
                const requiredFields = [
                    {id: 'numero_identidad', errorId: 'id-error', message: 'Número de identidad es obligatorio'},
                    {id: 'nombre_completo', errorId: 'name-error', message: 'Nombre completo es obligatorio'},
                    {id: 'fecha_nacimiento', errorId: 'birth-error', message: 'Fecha de nacimiento es obligatoria'},
                    {id: 'genero', errorId: 'gender-error', message: 'Seleccione el género'},
                    {id: 'telefono', errorId: 'phone-error', message: 'Teléfono es obligatorio'},
                    {id: 'direccion', errorId: 'address-error', message: 'Dirección es obligatoria'},
                    {id: 'encargado_nombre', errorId: 'guardian-error', message: 'Nombre del encargado es obligatorio'},
                    {id: 'encargado_telefono', errorId: 'guardian-phone-error', message: 'Teléfono del encargado es obligatorio'},
                    {id: 'parentesco', errorId: 'relationship-error', message: 'Parentesco es obligatorio'}
                ];

                requiredFields.forEach(field => {
                    const input = document.getElementById(field.id);
                    const error = document.getElementById(field.errorId);

                    if (!input.value.trim()) {
                        isValid = false;
                        error.textContent = field.message;
                        input.style.borderColor = '#f44336';
                    } else {
                        input.style.borderColor = '#ddd';
                    }
                });

                // Validar formato del número de identidad
                const idInput = document.getElementById('numero_identidad');
                if (idInput.value.trim() && !/^\d{13}$/.test(idInput.value)) {
                    isValid = false;
                    document.getElementById('id-error').textContent = 'El número debe tener 13 dígitos';
                    idInput.style.borderColor = '#f44336';
                }

                // Validar formato del teléfono
                const phoneInput = document.getElementById('telefono');
                if (phoneInput.value.trim() && !/^\d{8}$/.test(phoneInput.value)) {
                    isValid = false;
                    document.getElementById('phone-error').textContent = 'El teléfono debe tener 8 dígitos';
                    phoneInput.style.borderColor = '#f44336';
                }

                // Validar formato del teléfono del encargado
                const guardianPhone = document.getElementById('encargado_telefono');
                if (guardianPhone.value.trim() && !/^\d{8}$/.test(guardianPhone.value)) {
                    isValid = false;
                    document.getElementById('guardian-phone-error').textContent = 'El teléfono debe tener 8 dígitos';
                    guardianPhone.style.borderColor = '#f44336';
                }

                // Si todo es válido, mostrar mensaje de éxito
                if (isValid) {
                    alert('Formulario enviado correctamente');
                    this.reset();
                }
            });

            // Restaurar el borde normal al enfocar un campo
            document.querySelectorAll('.input-field').forEach(input => {
                input.addEventListener('focus', function() {
                    this.style.borderColor = '#2196f3';
                });

                input.addEventListener('blur', function() {
                    this.style.borderColor = '#ddd';
                });
            });

            // Validación en tiempo real para campos numéricos
            document.getElementById('numero_identidad').addEventListener('input', function() {
                this.value = this.value.replace(/\D/g, '');
            });

            document.getElementById('telefono').addEventListener('input', function() {
                this.value = this.value.replace(/\D/g, '');
            });

            document.getElementById('encargado_telefono').addEventListener('input', function() {
                this.value = this.value.replace(/\D/g, '');
            });
        </script>
</body>
</html>

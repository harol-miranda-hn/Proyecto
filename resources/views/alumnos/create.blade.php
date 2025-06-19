<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Instituto Técnico Danlí</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        /* Agregamos los estilos específicos del formulario */
        .form-container {
            max-width: 900px;
            margin: 0 auto;
        }

        .header {
            display: flex;
            align-items: center;
            padding: 20px;
            background: linear-gradient(135deg, #1976d2 0%, #0d47a1 100%);
            color: white;
            border-radius: 10px 10px 0 0;
            box-shadow: 0 4px 6px rgba(0,0,0,0.1);
        }

        .header-icon {
            background: rgba(255,255,255,0.2);
            width: 60px;
            height: 60px;
            border-radius: 50%;
            display: flex;
            justify-content: center;
            align-items: center;
            margin-right: 20px;
            font-size: 24px;
        }

        .form-card {
            background: white;
            border-radius: 0 0 10px 10px;
            box-shadow: 0 10px 20px rgba(0,0,0,0.1);
            padding: 30px;
        }

        .form-section {
            margin-bottom: 25px;
            padding-bottom: 20px;
            border-bottom: 1px solid #eee;
        }

        .section-title {
            display: flex;
            align-items: center;
            margin-bottom: 20px;
            color: #1976d2;
            font-weight: 500;
        }

        .section-title i {
            background: #e3f2fd;
            width: 36px;
            height: 36px;
            border-radius: 50%;
            display: flex;
            justify-content: center;
            align-items: center;
            margin-right: 12px;
            font-size: 16px;
        }

        .form-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 20px;
        }

        .input-group {
            position: relative;
            margin-bottom: 20px;
        }

        .input-group label {
            display: block;
            margin-bottom: 8px;
            font-size: 14px;
            color: #555;
            font-weight: 500;
        }

        .input-field {
            width: 100%;
            padding: 12px 15px;
            border: 1px solid #ddd;
            border-radius: 6px;
            font-size: 15px;
            transition: all 0.3s ease;
            background: #fafafa;
        }

        .input-field:focus {
            border-color: #2196f3;
            box-shadow: 0 0 0 2px rgba(33, 150, 243, 0.2);
            outline: none;
            background: white;
        }

        .input-icon {
            position: absolute;
            right: 15px;
            top: 38px;
            color: #777;
        }

        .toggle-group {
            display: flex;
            align-items: center;
            margin-top: 8px;
        }

        .toggle-label {
            margin-right: 20px;
            display: flex;
            align-items: center;
            cursor: pointer;
        }

        .toggle-switch {
            position: relative;
            width: 50px;
            height: 26px;
            background: #ccc;
            border-radius: 13px;
            margin-right: 8px;
            transition: background 0.3s;
        }

        .toggle-switch:after {
            content: '';
            position: absolute;
            width: 22px;
            height: 22px;
            border-radius: 50%;
            background: white;
            top: 2px;
            left: 2px;
            transition: transform 0.3s;
        }

        input[type="checkbox"] {
            display: none;
        }

        input[type="checkbox"]:checked + .toggle-switch {
            background: #4caf50;
        }

        input[type="checkbox"]:checked + .toggle-switch:after {
            transform: translateX(24px);
        }

        .toggle-text {
            color: #555;
            font-size: 14px;
        }

        textarea {
            min-height: 80px;
            resize: vertical;
        }

        .button-group {
            display: flex;
            justify-content: flex-end;
            gap: 15px;
            margin-top: 20px;
        }

        .btn {
            padding: 12px 25px;
            border-radius: 6px;
            font-size: 15px;
            font-weight: 500;
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: center;
            transition: all 0.3s ease;
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

        .status-message {
            padding: 15px;
            border-radius: 6px;
            margin-bottom: 25px;
            display: flex;
            align-items: center;
            animation: fadeIn 0.5s ease;
        }

        .status-success {
            background: #e8f5e9;
            border-left: 4px solid #4caf50;
            color: #2e7d32;
        }

        .status-error {
            background: #ffebee;
            border-left: 4px solid #f44336;
            color: #c62828;
        }

        .status-message i {
            margin-right: 10px;
            font-size: 20px;
        }

        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(-10px); }
            to { opacity: 1; transform: translateY(0); }
        }

        @media (max-width: 768px) {
            .form-card {
                padding: 20px;
            }

            .button-group {
                flex-direction: column;
            }

            .btn {
                width: 100%;
            }
        }
    </style>
</head>
<body class="font-sans antialiased">
<div class="min-h-screen bg-gray-100">
    @include('layouts.navigation')

    <!-- Page Heading -->
    @if (isset($header))
        <header class="bg-white shadow">
            <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                {{ $header }}
            </div>
        </header>
    @endif

    <div class="flex">
        <!-- Sidebar (el sidebar será oculto en dispositivos pequeños) -->
        <div class="w-64 h-screen bg-gray-800 text-white hidden md:block">
            <div class="p-6">
                <h3 class="text-2xl font-bold">{{ __('Menú') }}</h3>
            </div>
            <div class="px-6 py-4">
                <ul>
                    <!-- Nuevo item Dashboard -->
                    <li><a href="{{ route('dashboard') }}" class="text-white hover:bg-gray-700 p-2 flex items-center rounded">
                            <i class="fas fa-tachometer-alt mr-3"></i> {{ __('Inicio') }}
                        </a></li>

                    <!-- Ítem Grados con ícono -->
                    <li><a href="{{ route('grados.index') }}" class="text-white hover:bg-gray-700 p-2 flex items-center rounded">
                            <i class="fas fa-project-diagram mr-3"></i> {{ __('Grados') }}
                        </a></li>

                    <!-- Ítem Alumnos con ícono -->
                    <li><a href="{{ route('alumnos.index') }}" class="text-white hover:bg-gray-700 p-2 flex items-center rounded">
                            <i class="fas fa-users mr-3"></i> {{ __('Alumnos') }}
                        </a></li>

                    <!-- Ítem Alumnos con ícono -->
                    <li><a href="{{ route('matriculas.index') }}" class="text-white hover:bg-gray-700 p-2 flex items-center rounded">
                            <i class="fas fa-users mr-3"></i> {{ __('Matricula') }}
                        </a></li>

                    <li><a href="{{ route('asignaturas.index') }}" class="text-white hover:bg-gray-700 p-2 flex items-center rounded">
                            <i class="fas fa-file-alt mr-3"></i> {{ __('Asignaturas') }}
                        </a></li>

                    <!-- Ítem Comentarios con ícono -->
                    <li><a href="{{ route('calificaciones.index') }}" class="text-white hover:bg-gray-700 p-2 flex items-center rounded">
                            <i class="fas fa-comments mr-3"></i> {{ __('Calificaciones') }}
                        </a></li>

                    <li><a href="{{ route('users.index') }}" class="text-white hover:bg-gray-700 p-2 flex items-center rounded">
                            <i class="fas fa-users mr-3"></i> {{ __('Usuarios') }}
                        </a></li>
                    <!-- Ítem Proyectos con ícono -->
                    <li><a href="{{ route('projects.index') }}" class="text-white hover:bg-gray-700 p-2 flex items-center rounded">
                            <i class="fas fa-project-diagram mr-3"></i> {{ __('Proyectos') }}
                        </a></li>
                    <!-- Ítem Archivos con ícono -->
                    <li><a href="{{ route('files.index') }}" class="text-white hover:bg-gray-700 p-2 flex items-center rounded">
                            <i class="fas fa-file-alt mr-3"></i> {{ __('Archivos') }}
                        </a></li>
                    <!-- Ítem Comentarios con ícono -->
                    <li><a href="{{ route('comments.index') }}" class="text-white hover:bg-gray-700 p-2 flex items-center rounded">
                            <i class="fas fa-comments mr-3"></i> {{ __('Comentarios') }}
                        </a></li>
                </ul>
            </div>
        </div>

        <!-- Botón para abrir el Sidebar (solo en dispositivos móviles) -->
        <div class="md:hidden flex items-center p-4">
            <button id="sidebar-toggle" class="text-white">
                <i class="fas fa-bars"></i> <!-- Icono de hamburguesa -->
            </button>
        </div>

        <!-- Main Content - Aquí va nuestro formulario -->
        <main class="flex-1 p-4 md:p-6 bg-gray-100">
            <div class="form-container">
                <div class="header">
                    <div class="header-icon">
                        <i class="fas fa-user-graduate"></i>
                    </div>
                    <div class="header-text">
                        <h1>Registro de Nuevo Alumno</h1>
                        <p>Complete todos los campos para registrar un nuevo alumno en el sistema</p>
                    </div>
                </div>

                <div class="form-card">
                    <!-- Mensaje de estado -->
                    @if(session('status'))
                        <div class="status-message status-success">
                            <i class="fas fa-check-circle"></i>
                            <div>{{ session('status') }}</div>
                        </div>
                    @endif

                    <form method="POST" action="{{ route('alumnos.store') }}" id="studentForm">
                        @csrf

                        <!-- Información Personal -->
                        <div class="form-section">
                            <div class="section-title">
                                <i class="fas fa-user"></i>
                                <h2>Información Personal</h2>
                            </div>

                            <div class="form-grid">
                                <div class="input-group">
                                    <label for="numero_identidad">Número de Identidad *</label>
                                    <input type="text" id="numero_identidad" name="numero_identidad" class="input-field"
                                           placeholder="Ej: 0801199901234" maxlength="13"
                                           value="{{ old('numero_identidad') }}"
                                           oninput="this.value = this.value.replace(/[^0-9]/g, '')">
                                    <i class="fas fa-id-card input-icon"></i>
                                    @error('numero_identidad')
                                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                                    @enderror
                                </div>

                                <div class="input-group">
                                    <label for="nombre_completo">Nombre Completo *</label>
                                    <input type="text" id="nombre_completo" name="nombre_completo" class="input-field"
                                           placeholder="Ej: Juan Carlos Pérez López"
                                           value="{{ old('nombre_completo') }}">
                                    @error('nombre_completo')
                                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                                    @enderror
                                </div>

                                <div class="input-group">
                                    <label for="telefono">Teléfono *</label>
                                    <input type="text" id="telefono" name="telefono" class="input-field"
                                           placeholder="Ej: 99998888" maxlength="8"
                                           value="{{ old('telefono') }}"
                                           oninput="this.value = this.value.replace(/[^0-9]/g, '')">
                                    <i class="fas fa-phone input-icon"></i>
                                    @error('telefono')
                                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                                    @enderror
                                </div>

                                <div class="input-group">
                                    <label for="direccion">Dirección</label>
                                    <input type="text" id="direccion" name="direccion" class="input-field"
                                           placeholder="Ej: Barrio Los Andes, Danlí"
                                           value="{{ old('direccion') }}">
                                    <i class="fas fa-map-marker-alt input-icon"></i>
                                    @error('direccion')
                                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <!-- Información del Encargado -->
                        <div class="form-section">
                            <div class="section-title">
                                <i class="fas fa-user-friends"></i>
                                <h2>Información del Encargado</h2>
                            </div>

                            <div class="form-grid">
                                <div class="input-group">
                                    <label for="encargado_nombre">Nombre del Encargado *</label>
                                    <input type="text" id="encargado_nombre" name="encargado_nombre" class="input-field"
                                           placeholder="Ej: María López"
                                           value="{{ old('encargado_nombre') }}">
                                    @error('encargado_nombre')
                                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                                    @enderror
                                </div>

                                <div class="input-group">
                                    <label for="encargado_telefono">Teléfono del Encargado *</label>
                                    <input type="text" id="encargado_telefono" name="encargado_telefono" class="input-field"
                                           placeholder="Ej: 88887777" maxlength="8"
                                           value="{{ old('encargado_telefono') }}"
                                           oninput="this.value = this.value.replace(/[^0-9]/g, '')">
                                    <i class="fas fa-mobile-alt input-icon"></i>
                                    @error('encargado_telefono')
                                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <!-- Información de Salud -->
                        <div class="form-section">
                            <div class="section-title">
                                <i class="fas fa-heartbeat"></i>
                                <h2>Información de Salud</h2>
                            </div>

                            <div class="form-grid">
                                <div class="input-group">
                                    <label>¿Padece alguna enfermedad?</label>
                                    <div class="toggle-group">
                                        <label class="toggle-label">
                                            <input type="checkbox" id="padece_enfermedad" name="padece_enfermedad" value="1"
                                                   {{ old('padece_enfermedad') == '1' ? 'checked' : '' }} class="toggle-input">
                                            <span class="toggle-switch"></span>
                                            <span class="toggle-text">{{ old('padece_enfermedad') == '1' ? 'Sí' : 'No' }}</span>
                                        </label>
                                    </div>
                                    @error('padece_enfermedad')
                                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                                    @enderror
                                </div>

                                <div class="input-group">
                                    <label for="descripcion_enfermedad">Descripción de la enfermedad</label>
                                    <textarea id="descripcion_enfermedad" name="descripcion_enfermedad" class="input-field"
                                              placeholder="Detalles de la enfermedad o condición...">{{ old('descripcion_enfermedad') }}</textarea>
                                    @error('descripcion_enfermedad')
                                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <!-- Observaciones -->
                        <div class="form-section">
                            <div class="section-title">
                                <i class="fas fa-clipboard-check"></i>
                                <h2>Observaciones</h2>
                            </div>

                            <div class="form-grid">
                                <div class="input-group">
                                    <label>¿Tiene observaciones conductuales?</label>
                                    <div class="toggle-group">
                                        <label class="toggle-label">
                                            <input type="checkbox" id="tiene_observaciones" name="tiene_observaciones" value="1"
                                                   {{ old('tiene_observaciones') == '1' ? 'checked' : '' }} class="toggle-input">
                                            <span class="toggle-switch"></span>
                                            <span class="toggle-text">{{ old('tiene_observaciones') == '1' ? 'Sí' : 'No' }}</span>
                                        </label>
                                    </div>
                                    @error('tiene_observaciones')
                                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                                    @enderror
                                </div>

                                <div class="input-group">
                                    <label for="descripcion_observacion">Descripción de observaciones</label>
                                    <textarea id="descripcion_observacion" name="descripcion_observacion" class="input-field"
                                              placeholder="Detalles de las observaciones conductuales...">{{ old('descripcion_observacion') }}</textarea>
                                    @error('descripcion_observacion')
                                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <!-- Botones de acción -->
                        <div class="button-group">
                            <button type="button" class="btn btn-cancel" onclick="window.location.href='{{ route('alumnos.index') }}'">
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
            </div>
        </main>
    </div>
</div>

<!-- Script para abrir/cerrar el sidebar en dispositivos móviles -->
<script>
    document.getElementById('sidebar-toggle').addEventListener('click', function() {
        const sidebar = document.querySelector('.sidebar');
        sidebar.classList.toggle('hidden');
    });

    // Actualizar texto de los toggles
    document.querySelectorAll('.toggle-input').forEach(input => {
        input.addEventListener('change', function() {
            const label = this.closest('.toggle-label');
            const statusSpan = label.querySelector('.toggle-text');
            statusSpan.textContent = this.checked ? 'Sí' : 'No';
        });
    });
</script>
</body>
</html>

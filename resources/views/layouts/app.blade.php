<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Control Estudiantil</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
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
                            <i class="fas fa-tachometer-alt mr-3"></i> {{ __('Dashboard') }}
                        </a></li>
                    <!-- Ítem Usuarios con ícono -->
                    <li><a href="{{ route('alumnos.index') }}" class="text-white hover:bg-gray-700 p-2 flex items-center rounded">
                            <i class="fas fa-users mr-3"></i> {{ __('Alumnos') }}
                        </a></li>

                    <!-- Ítem Proyectos con ícono -->
                    <li><a href="{{ route('grados.index') }}" class="text-white hover:bg-gray-700 p-2 flex items-center rounded">
                            <i class="fas fa-project-diagram mr-3"></i> {{ __('Grados') }}
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

        <!-- Main Content -->
        <main class="flex-1 p-2 md:p-4 bg-gray-100">
            {{ $slot }}
        </main>

    </div>
</div>

<!-- Script para abrir/cerrar el sidebar en dispositivos móviles -->
<script>
    document.getElementById('sidebar-toggle').addEventListener('click', function() {
        const sidebar = document.querySelector('.sidebar');
        sidebar.classList.toggle('hidden');
    });
</script>

</body>
</html>

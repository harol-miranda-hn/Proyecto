<div class="d-flex flex-column flex-md-row min-vh-100">
    <!-- Sidebar -->
    <aside class="bg-dark text-white p-3" style="min-width: 220px;">
        <nav class="nav flex-column">
            <a href="{{ route('dashboard') }}" class="nav-link text-white">
                <i class="fas fa-tachometer-alt me-2"></i> Inicio
            </a>
            <a href="{{ route('grados.index') }}" class="nav-link text-white">
                <i class="fas fa-project-diagram me-2"></i> Grados
            </a>
            <a href="{{ route('alumnos.index') }}" class="nav-link text-white">
                <i class="fas fa-users me-2"></i> Alumnos
            </a>
            <a href="{{ route('matriculas.index') }}" class="nav-link text-white">
                <i class="fas fa-file-contract me-2"></i> Matrícula
            </a>
            <a href="{{ route('asignaturas.index') }}" class="nav-link text-white">
                <i class="fas fa-book me-2"></i> Asignaturas
            </a>
            <a href="{{ route('calificaciones.index') }}" class="nav-link text-white">
                <i class="fas fa-graduation-cap me-2"></i> Calificaciones
            </a>
            <a href="{{ route('users.index') }}" class="nav-link text-white">
                <i class="fas fa-user-cog me-2"></i> Usuarios
            </a>
            <a href="{{ route('projects.index') }}" class="nav-link text-white">
                <i class="fas fa-project-diagram me-2"></i> Proyectos
            </a>
            <a href="{{ route('files.index') }}" class="nav-link text-white">
                <i class="fas fa-file-alt me-2"></i> Archivos
            </a>
            <a href="{{ route('comments.index') }}" class="nav-link text-white">
                <i class="fas fa-comments me-2"></i> Comentarios
            </a>
        </nav>
    </aside>

    <!-- Contenido principal -->
    <main class="flex-fill p-4 bg-light">
        @if (isset($header))
            <div class="bg-white shadow-sm p-3 mb-4 rounded">
                {{ $header }}
            </div>
        @endif

        {{ $slot }}
    </main>
</div>

<!-- layouts/sidebar.blade.php -->
<div class="mb-3">
    <small class="text-uppercase text-secondary fw-bold px-2">General</small>
    <nav class="nav flex-column">
        <a href="{{ route('dashboard') }}" class="nav-link text-white sidebar-link" onclick="closeSidebar()">
            <i class="fas fa-tachometer-alt me-2"></i> Inicio
        </a>
    </nav>
</div>

<div class="mb-3">
    <small class="text-uppercase text-secondary fw-bold px-2">Académico</small>
    <nav class="nav flex-column">
        <a href="{{ route('grados.index') }}" class="nav-link text-white sidebar-link" onclick="closeSidebar()" >
            <i class="fas fa-chalkboard-teacher me-2"></i> Grados
        </a>
        <a href="{{ route('alumnos.index') }}" class="nav-link text-white sidebar-link" onclick="closeSidebar()">
            <i class="fas fa-user-graduate  me-2"></i> Alumnos
        </a>
        <a href="{{ route('matriculas.index') }}" class="nav-link text-white sidebar-link" onclick="closeSidebar()">
            <i class="fas fa-file-signature me-2"></i> Matrículas
        </a>
        <a href="{{ route('asignaturas.index') }}" class="nav-link text-white sidebar-link" onclick="closeSidebar()">
            <i class="fas fa-book me-2"></i> Asignaturas
        </a>
        <a href="{{ route('calificaciones.index') }}" class="nav-link text-white sidebar-link" onclick="closeSidebar()">
            <i class="fas fa-graduation-cap me-2"></i> Calificaciones
        </a>
        <a href="{{ route('asistencias.index') }}" class="nav-link text-white sidebar-link" onclick="closeSidebar()">
            <i class="fas fa-graduation-cap me-2"></i> Asistencias
        </a>
    </nav>
</div>

<div class="mb-3">
    <small class="text-uppercase text-secondary fw-bold px-2">Administración</small>
    <nav class="nav flex-column">
        <a href="{{ route('users.index') }}" class="nav-link text-white sidebar-link" onclick="closeSidebar()">
            <i class="fas fa-user-cog me-2"></i> Usuarios
        </a>
        <a href="{{ route('projects.index') }}" class="nav-link text-white sidebar-link" onclick="closeSidebar()">
            <i class="fas fa-lightbulb me-2"></i> Proyectos
        </a>
        <a href="{{ route('files.index') }}" class="nav-link text-white sidebar-link" onclick="closeSidebar()">
            <i class="fas fa-folder-open me-2"></i> Archivos
        </a>
        <a href="{{ route('comments.index') }}" class="nav-link text-white sidebar-link" onclick="closeSidebar()">
            <i class="fas fa-comments me-2"></i> Comentarios
        </a>
    </nav>
</div>

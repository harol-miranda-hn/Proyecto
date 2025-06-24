<div class="min-h-screen bg-gray-100">

    <!-- Page Heading -->
    @if (isset($header))
        <header class="bg-white shadow">
            <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                {{ $header }}
            </div>
        </header>
    @endif
    <div class="flex">
        <!-- Sidebar -->
        <aside class="sidebar">
            <div class="sidebar-menu">
                <a href="{{ route('dashboard') }}" class="menu-item">
                    <i class="fas fa-tachometer-alt"></i>
                    <span class="menu-text">Inicio</span>
                </a>
                <a href="{{ route('grados.index') }}" class="menu-item">
                    <i class="fas fa-project-diagram"></i>
                    <span class="menu-text">Grados</span>
                </a>
                <a href="{{ route('alumnos.index') }}" class="menu-item">
                    <i class="fas fa-users"></i>
                    <span class="menu-text">Alumnos</span>
                </a>
                <a href="{{ route('matriculas.index') }}" class="menu-item">
                    <i class="fas fa-file-contract"></i>
                    <span class="menu-text">Matrícula</span>
                </a>
                <a href="{{ route('asignaturas.index') }}" class="menu-item">
                    <i class="fas fa-book"></i>
                    <span class="menu-text">Asignaturas</span>
                </a>
                <a href="{{ route('calificaciones.index') }}" class="menu-item">
                    <i class="fas fa-graduation-cap"></i>
                    <span class="menu-text">Calificaciones</span>
                </a>
                <a href="{{ route('users.index') }}" class="menu-item">
                    <i class="fas fa-user-cog"></i>
                    <span class="menu-text">Usuarios</span>
                </a>
                <a href="{{ route('projects.index') }}" class="menu-item">
                    <i class="fas fa-project-diagram"></i>
                    <span class="menu-text">Proyectos</span>
                </a>
                <a href="{{ route('files.index') }}" class="menu-item">
                    <i class="fas fa-file-alt"></i>
                    <span class="menu-text">Archivos</span>
                </a>
                <a href="{{ route('comments.index') }}" class="menu-item">
                    <i class="fas fa-comments"></i>
                    <span class="menu-text">Comentarios</span>
                </a>
            </div>
        </aside>
    </div>
</div>

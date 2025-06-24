{{-- resources/views/layouts/navigation.blade.php --}}
<nav class="navbar navbar-expand-lg navbar-dark" style="background: linear-gradient(90deg, #143b66 0%, #0d2a5a 100%); padding: 1rem 2rem;">
    <div class="d-flex align-items-center">
        <i class="fas fa-graduation-cap fa-2x me-2 text-white"></i>
        <div>
            <h1 class="h5 mb-0 text-light">Instituto Técnico Danlí</h1>
            <small class="text-light">Sistema de Gestión Académica</small>
        </div>
    </div>
    <div class="dropdown ms-auto d-flex align-items-center">
        <div class="text-end me-3">
            <div class="fw-semibold text-white">{{ Auth::user()->name }}</div>
            <small class="text-light">{{ Auth::user()->email }}</small>
        </div>
        <a class="d-flex align-items-center text-white text-decoration-none dropdown-toggle" href="#" id="userDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            <i class="fas fa-user-circle fa-2x"></i>
        </a>
        <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="userDropdown">
            <li><a class="dropdown-item" href="#"><i class="fas fa-user me-2"></i> Ver perfil</a></li>
            <li><hr class="dropdown-divider"></li>
            <li>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="dropdown-item text-danger">
                        <i class="fas fa-sign-out-alt me-2"></i> Cerrar sesión
                    </button>
                </form>
            </li>
        </ul>
    </div>
</nav>

<nav class="navbar navbar-dark" style="background: linear-gradient(90deg, #143b66 0%, #0d2a5a 100%); padding: 0.75rem 1rem;">
    <div class="container-fluid d-flex justify-content-between align-items-center flex-nowrap">
        <!-- Logo e institución -->
        <div class="d-flex align-items-center me-3 flex-shrink-0">
            <i class="fas fa-graduation-cap icon-size me-2 text-white"></i>
            <div class="lh-sm text-truncate institution-text">
                <span class="text-white fw-semibold small d-block">Instituto Técnico Danlí</span>
                <small class="text-light d-block">Gestión Académica</small>
            </div>
        </div>

        <!-- Usuario y dropdown -->
        <div class="dropdown d-flex align-items-center ms-auto flex-shrink-0">
            <div class="text-end me-2 user-info text-truncate">
                <div class="text-white fw-medium user-name text-nowrap">{{ Auth::user()->name }}</div>
                <small class="text-light text-nowrap d-block user-email">{{ Auth::user()->email }}</small>
            </div>

            <a class="d-flex align-items-center text-white text-decoration-none dropdown-toggle" href="#" id="userDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                <i class="fas fa-user-circle icon-size"></i>
            </a>

            <ul class="dropdown-menu dropdown-menu-end mt-2" aria-labelledby="userDropdown">
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
    </div>
</nav>

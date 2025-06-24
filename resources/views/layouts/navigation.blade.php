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
            <div>{{ Auth::user()->name }}</div>
            <div style="font-size: 0.85rem; opacity: 0.8;">{{ Auth::user()->email }}</div>
            <!-- Dropdown en versión simplificada -->
            <form method="POST" action="{{ route('logout') }}" style="margin-top: 5px;">
                @csrf
                <button type="submit" style="font-size: 0.8rem; color: #ffdddd; background: none; border: none; cursor: pointer;">
                    <i class="fas fa-sign-out-alt"></i> Cerrar sesión
                </button>
            </form>
        </div>
    </div>
</nav>

<div class="d-flex flex-column flex-md-row min-vh-100">
    <!-- SIDEBAR -->
    <div class="bg-dark text-white p-3 d-none d-md-block" style="min-width: 220px;">
        @include('layouts.sidebar')
    </div>

    <!-- SIDEBAR OFFCANVAS para móviles -->
    <div class="offcanvas offcanvas-start bg-dark text-white" tabindex="-1" id="sidebarMenu" aria-labelledby="sidebarLabel">
        <div class="offcanvas-header">
            <h5 class="offcanvas-title" id="sidebarLabel">Menú</h5>
            <button type="button" class="btn-close btn-close-white" data-bs-dismiss="offcanvas" aria-label="Cerrar"></button>
        </div>
        <div class="offcanvas-body p-3">
            @include('layouts.sidebar')
        </div>
    </div>

    <!-- CONTENIDO -->
    <main class="flex-fill bg-light">
        <!-- Botón para móviles -->
        <div class="d-md-none p-2 bg-dark text-white">
            <button class="btn btn-outline-light" type="button" data-bs-toggle="offcanvas" data-bs-target="#sidebarMenu">
                <i class="fas fa-bars"></i> Menú
            </button>
        </div>

        <div class="p-4">
            @if (isset($header))
                <div class="bg-white shadow-sm p-3 mb-4 rounded">
                    {{ $header }}
                </div>
            @endif
            {{ $slot }}
        </div>
    </main>
</div>

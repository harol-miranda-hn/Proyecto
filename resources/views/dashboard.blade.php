<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - Instituto Técnico Danlí</title>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">

    <style>
        :root {
            --primary-color: #002147;
            --secondary-color: #0077b6;
            --accent-color: #f8b400;
            --light-bg: #f8f9fa;
            --text-dark: #212529;
            --text-light: #6c757d;
            --card-shadow: 0 4px 20px rgba(0, 0, 0, 0.08);
            --transition: all 0.3s ease;
        }

        body {
            background-color: #f5f7fa;
            color: var(--text-dark);
            font-family: 'Segoe UI', system-ui, sans-serif;
        }

        .dashboard-content {
            padding: 2rem;
        }

        /* Welcome Card */
        .welcome-card {
            background: white;
            border-radius: 16px;
            box-shadow: var(--card-shadow);
            padding: 2.5rem;
            margin-bottom: 2.5rem;
            border-left: 5px solid var(--primary-color);
        }

        .welcome-title {
            font-size: 1.8rem;
            font-weight: 700;
            color: var(--primary-color);
            margin-bottom: 1.25rem;
            display: flex;
            align-items: center;
        }

        .welcome-title i {
            margin-right: 0.8rem;
            color: var(--secondary-color);
        }

        .welcome-text {
            font-size: 1.1rem;
            color: var(--text-light);
            line-height: 1.7;
            max-width: 700px;
        }

        .highlight {
            background: linear-gradient(120deg, rgba(0, 123, 255, 0.1), transparent);
            padding: 0.2rem 0.5rem;
            border-radius: 4px;
            font-weight: 500;
        }

        /* Stats Cards */
        .stat-card {
            background-color: #fff;
            border-radius: 0.75rem;
            box-shadow: var(--card-shadow);
            padding: 1.5rem;
            display: flex;
            gap: 1rem;
            align-items: start;
            transition: var(--transition);
        }

        .stat-card:hover {
            transform: translateY(-4px);
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.08);
        }

        .stat-icon {
            width: 50px;
            height: 50px;
            border-radius: 0.5rem;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.5rem;
            color: #fff;
            flex-shrink: 0;
        }

        .stat-content {
            flex: 1;
        }

        .stat-value {
            font-size: 1.5rem;
            font-weight: 700;
            color: var(--primary-color);
            margin-bottom: 0.25rem;
        }

        .stat-label {
            font-size: 0.95rem;
            color: var(--text-light);
        }

        .stat-trend {
            font-size: 0.85rem;
            margin-top: 0.4rem;
            display: flex;
            align-items: center;
        }

        .trend-up {
            color: #28a745;
        }

        .trend-down {
            color: #dc3545;
        }

        /* Icon Backgrounds */
        .icon-bg-1 { background-color: #0d6efd; }
        .icon-bg-2 { background-color: #198754; }
        .icon-bg-3 { background-color: #0dcaf0; }
        .icon-bg-4 { background-color: #ffc107; }

        /* Quick Actions */
        .quick-actions {
            background: white;
            border-radius: 16px;
            box-shadow: var(--card-shadow);
            padding: 2rem;
        }

        .section-title {
            font-size: 1.5rem;
            font-weight: 700;
            color: var(--primary-color);
            margin-bottom: 1.5rem;
            display: flex;
            align-items: center;
        }

        .section-title i {
            margin-right: 0.75rem;
            color: var(--secondary-color);
        }

        .actions-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(220px, 1fr));
            gap: 1.5rem;
        }

        .action-card {
            background: #fff;
            padding: 1rem;
            border-radius: 0.75rem;
            text-align: center;
            transition: transform 0.2s ease, box-shadow 0.3s;
            cursor: pointer;
            height: 100%;
            border: 1px solid rgba(0, 0, 0, 0.05);
        }

        .action-card:hover {
            transform: translateY(-4px);
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.08);
            border-color: rgba(0, 33, 71, 0.15);
        }

        .action-icon {
            font-size: 1.75rem;
            margin-bottom: 0.75rem;
            color: #fff;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            width: 48px;
            height: 48px;
            border-radius: 50%;
        }

        .action-title {
            font-size: 1.1rem;
            font-weight: 600;
            color: var(--text-dark);
            margin-bottom: 0.25rem;
        }

        .action-desc {
            font-size: 0.9rem;
            color: var(--text-light);
        }

        /* Responsive */
        @media (max-width: 768px) {
            .dashboard-content {
                padding: 1.5rem;
            }

            .welcome-card {
                padding: 1.75rem;
            }

            .welcome-title {
                font-size: 1.5rem;
            }

            .stat-value {
                font-size: 1.4rem;
            }
        }

        @media (max-width: 576px) {
            .actions-grid {
                grid-template-columns: 1fr;
            }
        }

    </style>
</head>
<body>
<x-guest-layout>
    <!-- Main Content -->
    <div class="flex-1 dashboard-content">

        <!-- Tarjeta de Bienvenida -->
        <div class="welcome-card mb-4">
            <h1 class="welcome-title">
                <i class="fas fa-tachometer-alt me-2"></i>Bienvenido al Dashboard
            </h1>
            <p class="welcome-text">
                ¡Estás logueado y listo para gestionar los proyectos del <span class="highlight">Instituto Técnico Danlí</span>!
                Desde este panel podrás administrar estudiantes, cursos, eventos y generar reportes institucionales.
            </p>
        </div>

        <!-- Estadísticas -->
        <div class="row g-4 mb-5">
            <div class="col-12 col-sm-6 col-lg-3">
                <div class="stat-card h-100 p-3 d-flex gap-2 align-items-start">
                    <div class="stat-icon icon-bg-1 small">
                        <i class="fas fa-users fa-lg"></i>
                    </div>
                    <div class="stat-content">
                        <div class="stat-value fw-bold fs-5 mb-1">{{ $totalAlumnos }}</div>
                        <div class="stat-label text-muted small">Estudiantes</div>
                        <div class="stat-trend small {{ $alumnoCambioPorciento >= 0 ? 'text-success' : 'text-danger' }}">
                            <i class="fas fa-arrow-{{ $alumnoCambioPorciento >= 0 ? 'up' : 'down' }} me-1"></i>
                            {{ $alumnoCambioPorciento !== null ? abs($alumnoCambioPorciento) . '%' : 'N/D' }} desde el mes pasado
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-12 col-sm-6 col-lg-3">
                <div class="stat-card h-100 p-3 d-flex gap-2 align-items-start">
                    <div class="stat-icon icon-bg-2 small">
                        <i class="fas fa-book-open fa-lg"></i>
                    </div>
                    <div class="stat-content">
                        <div class="stat-value fw-bold fs-5 mb-1">{{ $totalGrados }}</div>
                        <div class="stat-label text-muted small">Grados</div>
                        <div class="stat-trend text-success small">
                            <i class="fas fa-arrow-up me-1"></i> {{ $gradosEsteMes }} este mes
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-12 col-sm-6 col-lg-3">
                <div class="stat-card h-100 p-3 d-flex gap-2 align-items-start">
                    <div class="stat-icon icon-bg-3 small">
                        <i class="fas fa-calendar-check fa-lg"></i>
                    </div>
                    <div class="stat-content">
                        <div class="stat-value fw-bold fs-5 mb-1">{{ $totalMatriculas }}</div>
                        <div class="stat-label text-muted small">Matrículas</div>
                        <div class="stat-trend text-info small">
                            <i class="fas fa-calendar me-1"></i> {{ now()->year }}
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-12 col-sm-6 col-lg-3">
                <div class="stat-card h-100 p-3 d-flex gap-2 align-items-start">
                    <div class="stat-icon icon-bg-4 small">
                        <i class="fas fa-graduation-cap fa-lg"></i>
                    </div>
                    <div class="stat-content">
                        <div class="stat-value fw-bold fs-5 mb-1">{{ $totalProyectos }}</div>
                        <div class="stat-label text-muted small">Proyectos</div>
                        <div class="stat-trend text-primary small">
                            <i class="fas fa-circle me-1"></i> {{ $proyectosActivos }} activos
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Acciones Rápidas -->
        <div class="quick-actions mb-5">
            <h2 class="section-title mb-3">
                <i class="fas fa-bolt me-2"></i>Acciones Rápidas
            </h2>

            <div class="actions-grid">

                <!-- Nuevo Estudiante -->
                <a href="{{ route('alumnos.create') }}" class="text-decoration-none text-dark">
                    <div class="action-card">
                        <div class="action-icon icon-bg-1">
                            <i class="fas fa-user-plus"></i>
                        </div>
                        <h3 class="action-title">Nuevo Estudiante</h3>
                        <p class="action-desc">Registrar nuevo estudiante</p>
                    </div>
                </a>

                <!-- Crear Curso -->
                <a href="{{ route('grados.create') }}" class="text-decoration-none text-dark">
                    <div class="action-card">
                        <div class="action-icon icon-bg-2">
                            <i class="fas fa-book-medical"></i>
                        </div>
                        <h3 class="action-title">Crear Curso</h3>
                        <p class="action-desc">Añadir nuevo curso académico</p>
                    </div>
                </a>

                <!-- Generar Comentario -->
                <a href="{{ route('comments.index') }}" class="text-decoration-none text-dark">
                    <div class="action-card">
                        <div class="action-icon icon-bg-3">
                            <i class="fas fa-file-invoice"></i>
                        </div>
                        <h3 class="action-title">Generar Comentario</h3>
                        <p class="action-desc">Crear comentario institucional</p>
                    </div>
                </a>

                <!-- Subir Archivo -->
                <a href="{{ route('files.create') }}" class="text-decoration-none text-dark">
                    <div class="action-card">
                        <div class="action-icon icon-bg-4">
                            <i class="fas fa-calendar-plus"></i>
                        </div>
                        <h3 class="action-title">Subir Archivo</h3>
                        <p class="action-desc">Subir un archivo a la plataforma</p>
                    </div>
                </a>

            </div>
        </div>
    </div>

</x-guest-layout>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

<script>
    // Animación suave al cargar
    document.addEventListener('DOMContentLoaded', function() {
        const cards = document.querySelectorAll('.stat-card, .action-card');
        cards.forEach((card, index) => {
            setTimeout(() => {
                card.style.opacity = '1';
                card.style.transform = 'translateY(0)';
            }, 150 * index);
        });
    });
</script>
</body>
</html>

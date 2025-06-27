<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bienvenido - Sistema de Orientación Estudiantil</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@300;400;600;700&display=swap" rel="stylesheet">

    <!-- Iconos -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <!-- Styles -->
    <style>
        :root {
            --primary: #2563eb;
            --primary-dark: #1d4ed8;
            --secondary: #10b981;
            --accent: #8b5cf6;
            --light: #f9fafb;
            --dark: #1f2937;
            --success: #10b981;
            --warning: #f59e0b;
            --danger: #ef4444;
            --gray-100: #f3f4f6;
            --gray-200: #e5e7eb;
            --gray-300: #d1d5db;
            --gray-700: #374151;
            --gray-900: #111827;
        }

        .dark {
            --light: #1f2937;
            --dark: #f9fafb;
            --gray-100: #374151;
            --gray-200: #4b5563;
            --gray-300: #6b7280;
            --gray-700: #e5e7eb;
            --gray-900: #f3f4f6;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Nunito', sans-serif;
            background-color: var(--light);
            color: var(--dark);
            transition: background-color 0.3s, color 0.3s;
            min-height: 100vh;
            position: relative;
            overflow-x: hidden;
        }

        .dark body {
            background-color: var(--gray-900);
            color: var(--gray-200);
        }

        /* Patrón de fondo educativo */
        .bg-pattern {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-image:
                radial-gradient(circle at 10% 20%, rgba(37, 99, 235, 0.1) 0%, transparent 20%),
                radial-gradient(circle at 90% 80%, rgba(16, 185, 129, 0.1) 0%, transparent 20%),
                radial-gradient(circle at 50% 30%, rgba(139, 92, 246, 0.1) 0%, transparent 30%);
            z-index: -1;
        }

        .dark .bg-pattern {
            background-image:
                radial-gradient(circle at 10% 20%, rgba(37, 99, 235, 0.05) 0%, transparent 20%),
                radial-gradient(circle at 90% 80%, rgba(16, 185, 129, 0.05) 0%, transparent 20%),
                radial-gradient(circle at 50% 30%, rgba(139, 92, 246, 0.05) 0%, transparent 30%);
        }

        /* Header */
        .header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 1.5rem 2rem;
            background-color: rgba(255, 255, 255, 0.8);
            backdrop-filter: blur(10px);
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.05);
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            z-index: 100;
        }

        .dark .header {
            background-color: rgba(31, 41, 55, 0.8);
        }

        .logo {
            display: flex;
            align-items: center;
            gap: 0.75rem;
        }

        .logo-icon {
            width: 40px;
            height: 40px;
            background: linear-gradient(135deg, var(--primary), var(--accent));
            border-radius: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-size: 1.25rem;
        }

        .logo-text {
            font-size: 0.95rem;
            font-weight: 700;
            color: var(--primary);
        }

        .dark .logo-text {
            color: var(--primary);
        }

        .nav-links {
            display: flex;
            gap: 1.5rem;
        }

        .nav-link {
            text-decoration: none;
            color: var(--gray-700);
            font-weight: 600;
            transition: color 0.2s;
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }

        .dark .nav-link {
            color: var(--gray-300);
        }

        .nav-link:hover {
            color: var(--primary);
        }

        .login-btn {
            background: var(--primary);
            color: white;
            padding: 0.5rem 1.25rem;
            border-radius: 0.5rem;
            font-weight: 600;
            transition: background 0.2s;
            text-decoration: none;
        }

        .login-btn:hover {
            background: var(--primary-dark);
        }

        /* Hero Section */
        .hero {
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            min-height: 100vh;
            padding: 6rem 2rem 2rem;
            text-align: center;
            position: relative;
        }

        .hero-content {
            max-width: 800px;
            z-index: 2;
        }

        .hero-title {
            font-size: 2.2rem;
            font-weight: 800;
            margin-top: 1.5rem;
            margin-bottom: 1.5rem;
            background: linear-gradient(90deg, var(--primary), var(--accent));
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            line-height: 1.2;
        }

        .hero-subtitle {
            font-size: 1.5rem;
            color: var(--gray-700);
            margin-bottom: 2rem;
            font-weight: 400;
            max-width: 700px;
            margin-left: auto;
            margin-right: auto;
        }

        .dark .hero-subtitle {
            color: var(--gray-300);
        }

        .hero-btns {
            display: flex;
            justify-content: center;
            gap: 1rem;
            margin-top: 2rem;
        }

        .btn {
            padding: 0.8rem 1.75rem;
            border-radius: 0.75rem;
            font-weight: 600;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            transition: all 0.2s;
            font-size: 1.1rem;
        }

        .btn-primary {
            background: var(--primary);
            color: white;
            box-shadow: 0 4px 6px rgba(37, 99, 235, 0.3);
        }

        .btn-primary:hover {
            background: var(--primary-dark);
            transform: translateY(-2px);
            box-shadow: 0 6px 10px rgba(37, 99, 235, 0.4);
        }

        .btn-secondary {
            background: white;
            color: var(--primary);
            border: 2px solid var(--primary);
        }

        .btn-secondary:hover {
            background: var(--primary);
            color: white;
            transform: translateY(-2px);
        }

        .dark .btn-secondary {
            background: transparent;
            color: var(--primary);
        }

        .hero-image {
            width: 100%;
            max-width: 800px;
            margin: 3rem auto 0;
            position: relative;
        }

        .hero-image-container {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 1.5rem;
            margin-top: 3rem;
        }

        .image-card {
            background: white;
            border-radius: 1rem;
            overflow: hidden;
            box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1);
            transition: transform 0.3s, box-shadow 0.3s;
            position: relative;
            display: flex;
            flex-direction: column;
        }

        .dark .image-card {
            background: var(--gray-100);
        }

        .image-card:hover {
            transform: translateY(-10px);
            box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.1);
        }

        .card-image {
            height: 180px;
            background-size: cover;
            background-position: center;
            position: relative;
            overflow: hidden;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 1.5rem;
        }

        /* ANIMACIONES PARA LAS TARJETAS DE IMAGEN */
        /* Animación de olas para la primera tarjeta */
        .card-image:nth-child(1) {
            background-color: #dbeafe;
            background-image:
                radial-gradient(circle at 10% 20%, rgba(255,255,255,0.6) 0%, transparent 20%),
                radial-gradient(circle at 90% 80%, rgba(255,255,255,0.4) 0%, transparent 25%);
            background-size: 200% 200%;
            animation: waveAnimation 8s linear infinite;
        }

        /* Animación de burbujas para la segunda tarjeta */
        .card-image:nth-child(2) {
            background-color: #d1fae5;
            position: relative;
            overflow: hidden;
        }

        .card-image:nth-child(2)::before {
            content: '';
            position: absolute;
            width: 100%;
            height: 100%;
            background:
                radial-gradient(circle, rgba(255,255,255,0.6) 0%, transparent 15%),
                radial-gradient(circle, rgba(255,255,255,0.4) 0%, transparent 20%);
            background-size: 80px 80px;
            animation: bubbles 12s linear infinite;
        }

        /* Animación de líneas diagonales para la tercera tarjeta */
        .card-image:nth-child(3) {
            background-color: #ede9fe;
            background-image:
                linear-gradient(45deg, rgba(255,255,255,0.2) 25%, transparent 25%,
                transparent 50%, rgba(255,255,255,0.2) 50%,
                rgba(255,255,255,0.2) 75%, transparent 75%, transparent);
            background-size: 40px 40px;
            animation: diagonalLines 6s linear infinite;
        }

        /* Keyframes para las animaciones */
        @keyframes waveAnimation {
            0% {
                background-position: 0% 50%;
            }
            50% {
                background-position: 100% 50%;
            }
            100% {
                background-position: 0% 50%;
            }
        }

        @keyframes bubbles {
            0% {
                background-position: 0 0, 40px 40px;
            }
            100% {
                background-position: 300px 300px, 340px 340px;
            }
        }

        @keyframes diagonalLines {
            0% {
                background-position: 0 0;
            }
            100% {
                background-position: 80px 80px;
            }
        }

        /* Animación para el modo oscuro */
        .dark .card-image:nth-child(1) {
            background-image:
                radial-gradient(circle at 10% 20%, rgba(255,255,255,0.15) 0%, transparent 20%),
                radial-gradient(circle at 90% 80%, rgba(255,255,255,0.1) 0%, transparent 25%);
        }

        .dark .card-image:nth-child(2)::before {
            background:
                radial-gradient(circle, rgba(255,255,255,0.15) 0%, transparent 15%),
                radial-gradient(circle, rgba(255,255,255,0.1) 0%, transparent 20%);
        }

        .dark .card-image:nth-child(3) {
            background-image:
                linear-gradient(45deg, rgba(255,255,255,0.1) 25%, transparent 25%,
                transparent 50%, rgba(255,255,255,0.1) 50%,
                rgba(255,255,255,0.1) 75%, transparent 75%, transparent);
        }

        .card-content {
            padding: 1.5rem;
        }

        .card-title {
            font-size: 1.25rem;
            font-weight: 700;
            margin-bottom: 0.5rem;
            color: var(--primary);
        }

        .card-description {
            color: var(--gray-700);
            font-size: 0.95rem;
        }

        .dark .card-description {
            color: var(--gray-300);
        }

        /* Estilos para las imágenes PNG */
        .card-icon {
            max-width: 100%;
            max-height: 120px;
            object-fit: contain;
            filter: drop-shadow(0 4px 6px rgba(0,0,0,0.1));
            transition: transform 0.3s ease;
        }

        .image-card:hover .card-icon {
            transform: scale(1.1);
        }

        /* Features Section */
        .features {
            padding: 5rem 2rem;
            background: linear-gradient(to bottom, var(--light), rgba(255, 255, 255, 0.8));
        }

        .dark .features {
            background: linear-gradient(to bottom, var(--gray-900), rgba(31, 41, 55, 0.8));
        }

        .section-title {
            text-align: center;
            font-size: 2.5rem;
            font-weight: 800;
            margin-bottom: 1rem;
            color: var(--primary);
        }

        .section-subtitle {
            text-align: center;
            max-width: 700px;
            margin: 0 auto 3rem;
            font-size: 1.1rem;
            color: var(--gray-700);
        }

        .dark .section-subtitle {
            color: var(--gray-300);
        }

        .features-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 2rem;
            max-width: 1200px;
            margin: 0 auto;
        }

        .feature-card {
            background: white;
            border-radius: 1rem;
            padding: 2rem;
            box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.05);
            transition: transform 0.3s;
            border: 1px solid var(--gray-200);
            display: flex;
            flex-direction: column;
            align-items: center;
            text-align: center;
        }

        .dark .feature-card {
            background: var(--gray-100);
            border-color: var(--gray-300);
        }

        .feature-card:hover {
            transform: translateY(-10px);
            box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.1);
        }

        .feature-icon {
            width: 80px;
            height: 80px;
            background: linear-gradient(135deg, var(--primary), var(--accent));
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-size: 2rem;
            margin-bottom: 1.5rem;
        }

        .feature-title {
            font-size: 1.5rem;
            font-weight: 700;
            margin-bottom: 1rem;
            color: var(--primary);
        }

        .feature-description {
            color: var(--gray-700);
            line-height: 1.6;
        }

        .dark .feature-description {
            color: var(--gray-300);
        }

        /* Stats Section */
        .stats {
            padding: 4rem 2rem;
            background: linear-gradient(to right, var(--primary), var(--accent));
            color: white;
        }

        .stats-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 2rem;
            max-width: 1200px;
            margin: 0 auto;
        }

        .stat-item {
            text-align: center;
            padding: 1.5rem;
        }

        .stat-number {
            font-size: 3rem;
            font-weight: 800;
            margin-bottom: 0.5rem;
        }

        .stat-label {
            font-size: 1.25rem;
            font-weight: 600;
        }

        /* Footer */
        .footer {
            background: var(--dark);
            color: white;
            padding: 3rem 2rem;
        }

        .footer-content {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 3rem;
            max-width: 1200px;
            margin: 0 auto;
        }

        .footer-section h3 {
            font-size: 1.5rem;
            margin-bottom: 1.5rem;
            color: var(--primary);
        }

        .footer-links {
            list-style: none;
        }

        .footer-links li {
            margin-bottom: 0.75rem;
        }

        .footer-links a {
            color: var(--gray-300);
            text-decoration: none;
            transition: color 0.2s;
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }

        .footer-links a:hover {
            color: var(--primary);
        }

        .copyright {
            text-align: center;
            padding-top: 2rem;
            margin-top: 2rem;
            border-top: 1px solid var(--gray-700);

        }

        /* Theme Toggle */
        .theme-toggle {
            position: fixed;
            bottom: 2rem;
            right: 2rem;
            width: 50px;
            height: 50px;
            border-radius: 50%;
            background: var(--primary);
            color: white;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
            z-index: 100;
            transition: transform 0.3s;
        }

        .theme-toggle:hover {
            transform: rotate(15deg);
        }

        /* Responsive */
        @media (max-width: 768px) {
            .hero-title {
                font-size: 2.5rem;
            }

            .hero-subtitle {
                font-size: 1.1rem;
            }

            .hero-btns {
                flex-direction: column;
                align-items: center;
            }

            .btn {
                width: 100%;
                max-width: 300px;
                justify-content: center;
            }

            .hero-image-container {
                grid-template-columns: 1fr;
            }

            .nav-links {
                display: none;
            }
        }
    </style>
</head>
<body>
<!-- Fondo educativo -->
<div class="bg-pattern"></div>

<!-- Header -->
<header class="header">
    <div class="logo">
        <div class="logo-icon">
            <i class="fas fa-graduation-cap"></i>
        </div>
        <div class="logo-text">Instituto Técnico Danlí</div>
    </div>

    <a href="{{ auth()->check() ? route('dashboard') : route('login') }}" class="login-btn">
        {{ auth()->check() ? 'Inicio' : 'Acceder' }}
    </a>

</header>

<!-- Hero Section -->
<section class="hero">
    <div class="hero-content">
        <h1 class="hero-title">Control Estudiantil</h1>
        <p class="hero-subtitle">Optimiza el control de asistencia, seguimiento académico y reportes estudiantiles con nuestra plataforma todo en uno diseñada para instituciones educativas.</p>

        <div class="hero-image-container">
            <div class="image-card">
                <div class="card-image" style="background-color: #dbeafe;">
                    <!-- Vector PNG para Asistencia en Tiempo Real -->

                    <img src="data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 100 100'%3E%3Ccircle cx='50' cy='40' r='20' fill='%233763eb'/%3E%3Cpath d='M30,85 Q50,65 70,85' stroke='%233763eb' stroke-width='10' fill='none'/%3E%3C/svg%3E" alt="Estudiante" class="card-icon">

                </div>
                <div class="card-content">
                    <h3 class="card-title">Asistencia</h3>
                    <p class="card-description">Registro preciso de asistencia con tecnología innovadora.</p>
                </div>
            </div>

            <div class="image-card">
                <div class="card-image" style="background-color: #d1fae5;">
                    <!-- Vector PNG para Seguimiento Académico: gráfico de progreso -->
                    <img src="data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 100 80'%3E%3Cpath d='M10,60 L30,40 L50,50 L70,30 L90,40' stroke='%2310b981' stroke-width='5' fill='none'/%3E%3Ccircle cx='10' cy='60' r='5' fill='%2310b981'/%3E%3Ccircle cx='30' cy='40' r='5' fill='%2310b981'/%3E%3Ccircle cx='50' cy='50' r='5' fill='%2310b981'/%3E%3Ccircle cx='70' cy='30' r='5' fill='%2310b981'/%3E%3Ccircle cx='90' cy='40' r='5' fill='%2310b981'/%3E%3C/svg%3E" alt="Seguimiento" class="card-icon">

                </div>
                <div class="card-content">
                    <h3 class="card-title">Seguimiento Académico</h3>
                    <p class="card-description">Monitorea el progreso de cada estudiante de forma individual.</p>
                </div>
            </div>

            <div class="image-card">
                <div class="card-image" style="background-color: #ede9fe;">
                    <!-- Vector PNG para Reportes Automatizados: documento con gráficos -->
                    <img src="data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 100 80'%3E%3Crect x='20' y='20' width='60' height='50' rx='5' fill='white' stroke='%238b5cf6' stroke-width='3'/%3E%3Crect x='25' y='30' width='50' height='5' fill='%238b5cf6'/%3E%3Crect x='25' y='40' width='40' height='5' fill='%238b5cf6'/%3E%3Crect x='25' y='50' width='30' height='5' fill='%238b5cf6'/%3E%3C/svg%3E" alt="Reportes" class="card-icon">
                </div>
                <div class="card-content">
                    <h3 class="card-title">Reportes Automatizados</h3>
                    <p class="card-description">Genera reportes detallados con solo un clic.</p>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Features Section -->
<section class="features">
    <h2 class="section-title">Características Principales</h2>
    <p class="section-subtitle">Nuestra plataforma facilita la gestión educativa con herramientas esenciales para una administración eficiente y segura.</p>

    <div class="features-grid">
        <div class="feature-card">
            <div class="feature-icon">
                <i class="fas fa-layer-group"></i>
            </div>
            <h3 class="feature-title">Control de Grados</h3>
            <p class="feature-description">Organiza y gestiona los diferentes niveles o grados escolares con facilidad, manteniendo una estructura académica clara.</p>
        </div>

        <div class="feature-card">
            <div class="feature-icon">
                <i class="fas fa-book"></i>
            </div>
            <h3 class="feature-title">Gestión de Asignaturas</h3>
            <p class="feature-description">Administra asignaturas por grado, con opciones para definir docentes, horarios y contenidos académicos.</p>
        </div>

        <div class="feature-card">
            <div class="feature-icon">
                <i class="fas fa-user-graduate"></i>
            </div>
            <h3 class="feature-title">Control de Alumnos</h3>
            <p class="feature-description">Registra y administra la información de los estudiantes de manera ordenada y segura.</p>
        </div>

        <div class="feature-card">
            <div class="feature-icon">
                <i class="fas fa-clipboard-check"></i>
            </div>
            <h3 class="feature-title">Calificaciones</h3>
            <p class="feature-description">Registra y consulta calificaciones de forma clara, con reportes por materia, periodo o alumno.</p>
        </div>

        <div class="feature-card">
            <div class="feature-icon">
                <i class="fas fa-user-clock"></i>
            </div>
            <h3 class="feature-title">Asistencia</h3>
            <p class="feature-description">Control de asistencia diario, con opciones para justificar inasistencias y generar reportes por grupo o alumno.</p>
        </div>

        <div class="feature-card">
            <div class="feature-icon">
                <i class="fas fa-users-cog"></i>
            </div>
            <h3 class="feature-title">Gestión de Usuarios</h3>
            <p class="feature-description">Crea y administra cuentas con distintos niveles de acceso para directivos, docentes y personal administrativo.</p>
        </div>

        <div class="feature-card">
            <div class="feature-icon">
                <i class="fas fa-shield-alt"></i>
            </div>
            <h3 class="feature-title">Plataforma Segura y Responsiva</h3>
            <p class="feature-description">Diseñada con medidas de seguridad modernas y accesible desde cualquier dispositivo con diseño responsivo.</p>
        </div>
    </div>
</section>

<!-- Stats Section -->
<section class="stats">
    <div class="stats-grid">
        <div class="stat-item">
            <div class="stat-number">95%</div>
            <div class="stat-label">Reducción en tiempo administrativo</div>
        </div>

        <div class="stat-item">
            <div class="stat-number">300+</div>
            <div class="stat-label">Estudiantes beneficiados</div>
        </div>

        <div class="stat-item">
            <div class="stat-number">24/7</div>
            <div class="stat-label">Soporte técnico</div>
        </div>
    </div>
</section>

<!-- Footer -->
<footer class="footer">
    <div class="footer-content">
        <div class="footer-section">
            <h3>Control Estudiantil</h3>
            <p>Plataforma integral para la gestión de asistencia, seguimiento académico y orientación estudiantil en instituciones educativas.</p>
        </div>

        <div class="footer-section">
            <h3>Contacto</h3>
            <ul class="footer-links">
                <li>
                    <a href="https://maps.app.goo.gl/rA9iZaknnP3y6LX99" target="_blank" rel="noopener">
                        <i class="fas fa-map-marker-alt"></i> Colonia Nueva Esperanza, Danlí, El Paraíso
                    </a>
                </li>
                <li>
                    <a href="#"><i class="fas fa-clock"></i> Lunes - Viernes: 08:00 AM - 05:00 PM</a>
                </li>
                <li>
                    <a href="https://www.facebook.com/p/Instituto-Tecnico-Danli-100057593133747/" target="_blank" rel="noopener">
                        <i class="fab fa-facebook"></i> Instituto Técnico Danlí
                    </a>
                </li>
            </ul>
        </div>

    </div>

    <div class="copyright"><strong>&copy; 2025 Instituto Técnico Danlí. Todos los derechos reservados.</strong> v.0.0.1
    </div>
</footer>

<!-- Theme Toggle -->
<div class="theme-toggle" id="themeToggle">
    <i class="fas fa-moon"></i>
</div>

<script>
    // Toggle de modo oscuro
    const themeToggle = document.getElementById('themeToggle');
    const body = document.body;

    themeToggle.addEventListener('click', () => {
        body.classList.toggle('dark');

        const icon = themeToggle.querySelector('i');
        if (body.classList.contains('dark')) {
            icon.classList.remove('fa-moon');
            icon.classList.add('fa-sun');
        } else {
            icon.classList.remove('fa-sun');
            icon.classList.add('fa-moon');
        }
    });

    // Animación para elementos al hacer scroll
    document.addEventListener('DOMContentLoaded', function() {
        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    entry.target.classList.add('animate');
                }
            });
        }, {
            threshold: 0.1
        });

        // Observar elementos con la clase 'feature-card'
        document.querySelectorAll('.feature-card').forEach(card => {
            observer.observe(card);
        });

        // Observar elementos con la clase 'stat-item'
        document.querySelectorAll('.stat-item').forEach(stat => {
            observer.observe(stat);
        });
    });
</script>
</body>
</html>

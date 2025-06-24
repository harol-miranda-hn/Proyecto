<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Instituto Técnico Danlí</title>

    <!-- Fonts and Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600&display=swap" rel="stylesheet">

    <!-- CSS -->
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <link rel="stylesheet" href="{{ asset('css/forms.css') }}">

    <style>
        /* Mantener solo estilos específicos del layout */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Poppins', sans-serif;
        }

        body {
            background: linear-gradient(135deg, #f5f7fa 0%, #e4edf9 100%);
            color: #333;
            min-height: 100vh;
        }

        .navbar {
            background: linear-gradient(90deg, #1a3c6e 0%, #0d2a5a 100%);
            color: white;
            padding: 15px 30px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .logo {
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .logo-icon {
            font-size: 28px;
            color: #4da6ff;
        }

        .logo-text h1 {
            font-size: 1.4rem;
            font-weight: 600;
        }

        .logo-text p {
            font-size: 0.8rem;
            opacity: 0.8;
        }

        .main-layout {
            display: flex;
            min-height: calc(100vh - 90px);
        }

        .sidebar {
            width: 220px;
            background: #2c3e50;
            color: white;
            padding: 25px 0;
        }

        .sidebar-menu {
            padding: 0 15px;
        }

        .menu-item {
            display: flex;
            align-items: center;
            padding: 12px 15px;
            border-radius: 6px;
            margin-bottom: 5px;
            text-decoration: none;
            color: rgba(255, 255, 255, 0.85);
        }

        .menu-item:hover, .menu-item.active {
            background: rgba(255, 255, 255, 0.1);
            color: white;
        }

        .menu-item i {
            width: 28px;
            text-align: center;
        }

        .main-content {
            flex: 1;
            padding: 25px;
            background: #f9fbfd;
        }

        @media (max-width: 768px) {
            .main-layout {
                flex-direction: column;
            }

            .sidebar {
                width: 100%;
                padding: 15px;
            }
        }
    </style>
</head>
<body class="antialiased">

<!-- Navbar -->
@include('layouts.navigation')

<!-- Layout -->
<div class="main-layout">
    <!-- Sidebar -->
    @include('layouts.app')

    <!-- Contenido Principal -->
    <main class="main-content">
        {{ $slot }}
    </main>
</div>
<!-- JS -->
<script src="{{ asset('js/app.js') }}" defer></script>
</body>
</html>

<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta name="csrf-token" content="{{ csrf_token() }}" />

    <title>Instituto Técnico Danlí</title>

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600&display=swap" rel="stylesheet">

    <!-- Bootstrap 5 CDN -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Font Awesome CDN -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <style>
        body {
            font-family: 'Poppins', sans-serif;
            background: linear-gradient(135deg, #f5f7fa 0%, #e4edf9 100%);
        }

        .nav-link:hover {
            background-color: rgba(255, 255, 255, 0.1);
            border-radius: 0.375rem;
        }

        .nav-link i {
            width: 20px;
            text-align: center;
        }

        .icon-size {
            font-size: 1.75rem;
        }

        .user-name, .user-email {
            font-size: 0.85rem;
        }

        .institution-text span,
        .institution-text small {
            font-size: 0.85rem;
        }

        @media (max-width: 576px) {
            .icon-size {
                font-size: 1.4rem;
            }

            .user-name,
            .user-email,
            .institution-text span,
            .institution-text small {
                font-size: 0.7rem;
            }

            .user-info {
                max-width: 120px;
            }

            .institution-text {
                max-width: 140px;
            }
        }

        .sidebar-link {
            transition: background 0.2s;
            border-radius: 0.375rem;
            padding: 0.5rem 0.75rem;
            display: flex;
            align-items: center;
        }

        .sidebar-link:hover {
            background-color: rgba(255, 255, 255, 0.1);
            text-decoration: none;
        }

        .nav.flex-column {
            gap: 0.25rem;
        }

        .offcanvas .nav.flex-column a {
            padding-left: 0.5rem;
        }

        .offcanvas .text-secondary {
            font-size: 0.75rem;
        }
    </style>


</head>
<body>

<!-- Navbar -->
@include('layouts.navigation')

<!-- Main Layout -->
@include('layouts.app')

<script>
    function closeSidebar() {
        const sidebar = bootstrap.Offcanvas.getInstance(document.getElementById('sidebarMenu'));
        if (sidebar) {
            sidebar.hide();
        }
    }
</script>

<!-- JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" defer></script>
</body>
</html>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Acceso Profesional - Instituto Técnico Danlí</title>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" />

    <!-- Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet" />

    <style>
        :root {
            --primary-color: #002147;
            --secondary-color: #0077b6;
            --accent-color: #f8b400;
            --light-bg: rgba(255, 255, 255, 0.12);
            --card-bg: rgba(255, 255, 255, 0.08);
            --border-color: rgba(255, 255, 255, 0.2);
        }

        body {
            background: linear-gradient(135deg, #00162e, #004a7c);
            background-size: cover;
            background-attachment: fixed;
            font-family: 'Segoe UI', system-ui, sans-serif;
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            color: #fff;
            padding: 1rem;
            position: relative;
            overflow-x: hidden;
        }

        /* Background effects */
        body::before {
            content: "";
            position: absolute;
            inset: 0;
            background:
                linear-gradient(to bottom right, rgba(0, 0, 0, 0.3), rgba(0, 33, 71, 0.4)),
                radial-gradient(circle at center, rgba(255, 255, 255, 0.05) 0%, transparent 70%),
                radial-gradient(circle at 80% 20%, rgba(0, 119, 182, 0.1) 0%, transparent 40%);
            z-index: -1;
            transition: background 0.5s ease;
        }

        .login-container {
            max-width: 420px;
            width: 100%;
            animation: fadeIn 0.6s ease-out;
        }

        .login-card {
            background: var(--card-bg);
            backdrop-filter: blur(16px);
            border: 1px solid var(--border-color);
            border-radius: 20px;
            box-shadow: 0 16px 50px rgba(0, 0, 0, 0.45);
            transition: transform 0.4s ease, box-shadow 0.4s ease;
        }

        .login-card:hover {
            transform: translateY(-2px);
            box-shadow: 0 20px 60px rgba(0, 0, 0, 0.55);
        }

        .card-header {
            background: var(--light-bg);
            border-bottom: 1px solid var(--border-color);
            padding: 1.75rem 2rem;
            text-align: center;
        }

        .card-body {
            padding: 2rem;
        }

        .brand-logo {
            width: 80px;
            height: 80px;
            background: linear-gradient(135deg, var(--primary-color), var(--secondary-color));
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 1rem;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.2);
        }

        .brand-logo i {
            font-size: 2.5rem;
            color: #fff;
        }

        .institute-name {
            font-size: 1.6rem;
            font-weight: 700;
            letter-spacing: 0.5px;
            color: #fff;
            margin-bottom: 0.25rem;
        }

        .institute-tagline {
            font-size: 0.95rem;
            font-weight: 400;
            opacity: 0.85;
            margin-bottom: 0;
        }

        .login-title {
            font-size: 1.5rem;
            font-weight: 600;
            margin-bottom: 0.5rem;
            position: relative;
            display: inline-block;
        }

        .login-title::after {
            content: "";
            position: absolute;
            bottom: -8px;
            left: 0;
            width: 50px;
            height: 3px;
            background: var(--accent-color);
            border-radius: 3px;
        }

        .login-subtitle {
            font-size: 0.95rem;
            opacity: 0.85;
            margin-bottom: 1.75rem;
        }

        .form-label {
            font-weight: 500;
            margin-bottom: 0.5rem;
            display: flex;
            align-items: center;
        }

        .input-group {
            margin-bottom: 1.25rem;
        }

        .input-group-text {
            background: rgba(255, 255, 255, 0.1);
            border: 1px solid var(--border-color);
            border-right: none;
            color: rgba(255, 255, 255, 0.7);
            transition: all 0.3s ease;
        }

        .form-control {
            background: rgba(255, 255, 255, 0.1);
            border: 1px solid var(--border-color);
            color: #fff;
            padding: 0.75rem;
            height: calc(2.5rem + 2px);
            transition: all 0.3s ease;
        }

        .form-control:focus {
            background: rgba(255, 255, 255, 0.15);
            border-color: rgba(255, 255, 255, 0.4);
            color: #fff;
            box-shadow: 0 0 0 0.2rem rgba(0, 123, 255, 0.2);
        }

        .form-control::placeholder {
            color: rgba(255, 255, 255, 0.5);
        }

        .password-toggle {
            background: rgba(255, 255, 255, 0.1);
            border: 1px solid var(--border-color);
            border-left: none;
            color: rgba(255, 255, 255, 0.7);
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .password-toggle:hover {
            background: rgba(255, 255, 255, 0.15);
            color: #fff;
        }

        .btn-login {
            background: linear-gradient(135deg, var(--accent-color), #ffc107);
            color: #212529;
            border: none;
            border-radius: 40px;
            font-weight: 600;
            padding: 0.75rem 1.25rem;
            transition: all 0.3s ease;
            box-shadow: 0 6px 14px rgba(248, 180, 0, 0.4);
            letter-spacing: 0.4px;
            height: 50px;
        }

        .btn-login:hover {
            background: linear-gradient(135deg, #e0a800, #ffca2c);
            transform: translateY(-2px);
            box-shadow: 0 10px 20px rgba(248, 180, 0, 0.5);
        }

        .btn-login:active {
            transform: scale(0.97);
            box-shadow: inset 0 2px 5px rgba(0, 0, 0, 0.2);
        }

        .footer-links {
            display: flex;
            justify-content: space-between;
            margin-top: 1.5rem;
            font-size: 0.9rem;
        }

        .footer-links a {
            color: rgba(255, 255, 255, 0.7);
            text-decoration: none;
            transition: all 0.3s ease;
        }

        .footer-links a:hover {
            color: var(--accent-color);
            text-decoration: underline;
        }

        .copyright {
            text-align: center;
            margin-top: 2rem;
            font-size: 0.85rem;
            opacity: 0.7;
        }

        /* Animation effects */
        @keyframes fadeIn {
            0% {
                opacity: 0;
                transform: translateY(30px) scale(0.98);
            }
            100% {
                opacity: 1;
                transform: translateY(0) scale(1);
            }
        }

        /* Responsive adjustments */
        @media (max-width: 575.98px) {
            .login-card {
                border-radius: 12px;
            }

            .card-body {
                padding: 1.75rem;
            }
        }
    </style>
</head>
<body>
<div class="login-container">
    <div class="login-card">
        <div class="card-header">
            <div class="brand-logo">
                <i class="fas fa-graduation-cap"></i>
            </div>
            <div class="institute-name">Instituto Técnico Danlí</div>
            <div class="institute-tagline">Iniciar sesión</div>
        </div>

        <div class="card-body">
            <form method="POST" action="{{ route('login') }}" novalidate>
                @csrf

                <!-- Correo electrónico -->
                <div class="mb-3">
                    <label for="email" class="form-label">
                        <i class="fas fa-envelope me-2"></i>Correo electrónico
                    </label>
                    <div class="input-group">
                        <span class="input-group-text"><i class="fas fa-at"></i></span>
                        <input
                            type="email"
                            id="email"
                            name="email"
                            class="form-control"
                            placeholder="usuario@itdanli.edu.hn"
                            required
                            autofocus
                        />
                    </div>
                    @error('email')
                    <div class="form-text text-warning mt-1">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Contraseña -->
                <div class="mb-4">
                    <label for="password" class="form-label">
                        <i class="fas fa-lock me-2"></i>Contraseña
                    </label>
                    <div class="input-group">
                        <span class="input-group-text"><i class="fas fa-key"></i></span>
                        <input
                            type="password"
                            id="password"
                            name="password"
                            class="form-control"
                            placeholder="••••••••"
                            required
                        />
                        <span class="input-group-text password-toggle" onclick="togglePassword()">
                                <i class="fas fa-eye" id="toggle-icon"></i>
                            </span>
                    </div>
                    @error('password')
                    <div class="form-text text-warning mt-1">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Botón de Ingreso -->
                <div class="d-grid">
                    <button type="submit" class="btn btn-login">
                        <i class="fas fa-sign-in-alt me-2"></i>Acceder al sistema
                    </button>
                </div>
            </form>
        </div>
    </div>

    <div class="copyright">
        &copy; 2023 Instituto Técnico Danlí. Todos los derechos reservados.
    </div>
</div>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

<!-- Mostrar/Ocultar contraseña -->
<script>
    function togglePassword() {
        const input = document.getElementById('password');
        const icon = document.getElementById('toggle-icon');

        if (input.type === 'password') {
            input.type = 'text';
            icon.classList.remove('fa-eye');
            icon.classList.add('fa-eye-slash');
        } else {
            input.type = 'password';
            icon.classList.remove('fa-eye-slash');
            icon.classList.add('fa-eye');
        }
    }
</script>
</body>
</html>

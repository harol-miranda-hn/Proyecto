<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Iniciar Sesión</title>

    <!-- Estilos y librerías -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" />
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            darkMode: 'class',
            theme: {
                extend: {
                    colors: {
                        primary: {
                            600: '#2563eb',
                            700: '#1d4ed8',
                        },
                    },
                },
            },
        };
    </script>
    <style type="text/tailwindcss">
        .input-icon {
            @apply absolute left-3 top-1/2 -translate-y-1/2 text-gray-400;
        }
        .toggle-password {
            @apply absolute right-3 top-1/2 -translate-y-1/2 text-gray-400 cursor-pointer;
        }
        .input-field {
            @apply w-full pl-10 pr-10 py-2.5 rounded-lg border bg-gray-50 dark:bg-gray-700 text-gray-900 dark:text-white border-gray-300 dark:border-gray-600 focus:ring-2 focus:ring-primary-600 focus:border-transparent;
        }
    </style>
</head>
<body class="bg-gray-100 dark:bg-gray-900 min-h-screen flex items-center justify-center p-4">
<main class="w-full max-w-md bg-white dark:bg-gray-800 rounded-xl shadow-lg overflow-hidden">
    <header class="bg-primary-600 py-3 text-center">
        <h1 class="text-white text-xl font-bold">INICIAR SESIÓN</h1>
    </header>

    <section class="p-6">
        <!-- Mensajes de estado -->
        @if(session('status'))
            <div class="mb-4 px-4 py-3 rounded-lg bg-green-100 dark:bg-green-900 text-green-700 dark:text-green-200">
                {{ session('status') }}
            </div>
        @endif

        <form method="POST" action="{{ route('login') }}" class="space-y-5" novalidate>
            @csrf

            <!-- Email -->
            <div>
                <label for="email" class="block mb-2 text-sm font-medium text-gray-700 dark:text-gray-300">Correo electrónico</label>
                <div class="relative">
                    <i class="fas fa-envelope input-icon"></i>
                    <input
                        id="email"
                        type="email"
                        name="email"
                        value="{{ old('email') }}"
                        required
                        autofocus
                        autocomplete="email"
                        placeholder="tu@correo.com"
                        class="input-field"
                    />
                </div>
                @error('email')
                <p class="mt-2 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                @enderror
            </div>

            <!-- Contraseña -->
            <div>
                <div class="flex justify-between mb-2">
                    <label for="password" class="text-sm font-medium text-gray-700 dark:text-gray-300">Contraseña</label>
                    @if (Route::has('password.request'))
                        <a href="{{ route('password.request') }}" class="text-sm text-primary-600 hover:text-primary-800 dark:text-primary-400 dark:hover:text-primary-300">
                            ¿Olvidaste tu contraseña?
                        </a>
                    @endif
                </div>
                <div class="relative">
                    <i class="fas fa-lock input-icon"></i>
                    <input
                        id="password"
                        type="password"
                        name="password"
                        required
                        autocomplete="current-password"
                        placeholder="••••••••"
                        class="input-field"
                    />
                    <span class="toggle-password" onclick="togglePassword()">
              <i class="fas fa-eye"></i>
            </span>
                </div>
                @error('password')
                <p class="mt-2 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                @enderror
            </div>

            <!-- Recordarme -->
            <div class="flex items-center">
                <input
                    id="remember_me"
                    type="checkbox"
                    name="remember"
                    class="w-4 h-4 text-primary-600 bg-gray-100 border-gray-300 rounded focus:ring-2 focus:ring-primary-500 dark:focus:ring-primary-600 dark:ring-offset-gray-800 dark:bg-gray-700 dark:border-gray-600"
                />
                <label for="remember_me" class="ml-2 text-sm text-gray-700 dark:text-gray-300">Recordar mi sesión</label>
            </div>

            <!-- Botón de login -->
            <button type="submit" class="w-full flex items-center justify-center gap-2 py-3 px-4 rounded-lg bg-primary-600 hover:bg-primary-700 text-white font-medium transition duration-200">
                Ingresar
            </button>

            <!-- Enlace de registro -->
            @if(Route::has('register'))
                <div class="mt-5 pt-3 border-t border-gray-200 dark:border-gray-700 text-center">
                    <p class="text-sm text-gray-600 dark:text-gray-400">
                        ¿No tienes cuenta?
                        <a href="{{ route('register') }}" class="font-medium text-primary-600 hover:text-primary-800 dark:text-primary-400 dark:hover:text-primary-300 ml-1">
                            Regístrate aquí
                        </a>
                    </p>
                </div>
            @endif
        </form>
    </section>
</main>

<!-- Script para alternar visibilidad de contraseña -->
<script>
    function togglePassword() {
        const input = document.getElementById('password');
        const icon = document.querySelector('.toggle-password i');
        const isHidden = input.type === 'password';
        input.type = isHidden ? 'text' : 'password';
        icon.classList.toggle('fa-eye');
        icon.classList.toggle('fa-eye-slash');
    }
</script>
</body>
</html>

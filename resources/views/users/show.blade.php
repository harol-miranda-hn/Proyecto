<!-- resources/views/users/show.blade.php -->
<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-lg sm:rounded-lg">
                <div class="p-6">
                    <!-- Título de la Sección -->
                    <div class="mb-6">
                        <h3 class="text-2xl font-semibold text-gray-900 dark:text-gray-100">{{ __('Detalles del Usuario') }}</h3>
                        <p class="text-gray-600 dark:text-gray-300">{{ __('Información completa del usuario seleccionado') }}</p>
                        <hr>
                    </div>

                    <!-- Información del Usuario -->
                    <div class="space-y-4">
                        <!-- Nombre -->
                        <div class="flex items-center justify-between bg-gray-100 dark:bg-gray-700 p-4 rounded-md shadow-sm">
                            <span class="text-lg font-medium text-gray-700 dark:text-gray-300">{{ __('Nombre') }}: <strong>{{ $user->name }}</strong></span>
                        </div>

                        <!-- Correo Electrónico -->
                        <div class="flex items-center justify-between bg-gray-100 dark:bg-gray-700 p-4 rounded-md shadow-sm">
                            <span class="text-lg font-medium text-gray-700 dark:text-gray-300">{{ __('Correo Electrónico') }}: <strong>{{ $user->email }}</span>
                        </div>
                        <br>
                        <!-- Rol -->
                        <div class="flex items-center justify-between bg-gray-100 dark:bg-gray-700 p-4 rounded-md shadow-sm">
                            <span class="text-lg font-medium text-gray-700 dark:text-gray-300">{{ __('Rol') }}: <strong>{{ ucfirst($user->role) }}</span>
                        </div>
                    </div>

                    <!-- Botón Volver -->
                    <div class="mt-6 text-right">
                        <a href="{{ route('users.index') }}" class="bg-blue-600 text-white py-2 px-4 rounded-md hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500">
                            {{ __('REGRESAR') }}
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <!-- Título de la Sección -->
                    <div class="mb-6">
                        <h3 class="text-2xl font-semibold text-gray-900 dark:text-gray-100">{{ __('ACTUALIZAR USUARIO') }}</h3>
                        <p class="text-gray-600 dark:text-gray-300">{{ __('Actualiza la información completa del usuario seleccionado') }}</p>
                        <hr>
                    </div>

                    <!-- Mensaje de Éxito -->
                    @if(session('status'))
                        <div class="mb-4 p-4 bg-green-100 text-green-700 rounded">
                            {{ session('status') }}
                        </div>
                    @endif

                    <!-- Formulario Editar Usuario -->
                    <form action="{{ route('users.update', $user->id) }}" method="POST">
                        @csrf
                        @method('PUT')

                        <!-- Nombre -->
                        <div class="mb-6">
                            <label for="name" class="block text-gray-700 dark:text-gray-300 font-medium">{{ __('Nombre') }}</label>
                            <input type="text" name="name" id="name" value="{{ old('name', $user->name) }}" class="mt-1 block w-full p-3 border border-gray-300 dark:border-gray-600 rounded-md text-gray-900 dark:text-gray-200 bg-white dark:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-blue-400" required>
                            @error('name')
                            <div class="text-red-600 text-sm mt-2">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Correo Electrónico -->
                        <div class="mb-6">
                            <label for="email" class="block text-gray-700 dark:text-gray-300 font-medium">{{ __('Correo Electrónico') }}</label>
                            <input type="email" name="email" id="email" value="{{ old('email', $user->email) }}" class="mt-1 block w-full p-3 border border-gray-300 dark:border-gray-600 rounded-md text-gray-900 dark:text-gray-200 bg-white dark:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-blue-400" required>
                            @error('email')
                            <div class="text-red-600 text-sm mt-2">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Rol -->
                        <div class="mb-6">
                            <label for="role" class="block text-gray-700 dark:text-gray-300 font-medium">{{ __('Rol') }}</label>
                            <select name="role" id="role" class="mt-1 block w-full p-3 border border-gray-300 dark:border-gray-600 rounded-md text-gray-900 dark:text-gray-200 bg-white dark:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-blue-400" required>
                                <option value="estudiante" {{ old('role', $user->role) == 'estudiante' ? 'selected' : '' }}>{{ __('Estudiante') }}</option>
                                <option value="profesor" {{ old('role', $user->role) == 'profesor' ? 'selected' : '' }}>{{ __('Profesor') }}</option>
                            </select>
                            @error('role')
                            <div class="text-red-600 text-sm mt-2">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Contenedor para los botones -->
                        <div class="flex space-x-4">
                            <!-- Botón Regresar -->
                            <a href="{{ route('users.index') }}" class="w-1/2 bg-blue-600 text-white py-3 px-6 rounded-md hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 text-center transition-all">
                                {{ __('REGRESAR') }}
                            </a>

                            <!-- Botón Actualizar Usuario -->
                            <button type="submit" class="w-1/2 bg-yellow-500 text-white py-3 px-6 rounded-md hover:bg-yellow-600 focus:outline-none focus:ring-2 focus:ring-yellow-500 text-center transition-all">
                                {{ __('ACTUALIZAR') }}
                            </button>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <!-- Título de la Sección -->
                    <div class="mb-6">
                        <h3 class="text-2xl font-semibold text-gray-900 dark:text-gray-100">{{ __('REGISTRAR COMENTARIO') }}</h3>
                        <p class="text-gray-600 dark:text-gray-300">{{ __('Ingresa el contenido del nuevo comentario y selecciona el usuario y el proyecto asociados.') }}</p>
                        <hr>
                    </div>

                    <!-- Mensaje de Éxito -->
                    @if(session('status'))
                        <div class="mb-4 p-4 bg-green-100 text-green-700 rounded">
                            {{ session('status') }}
                        </div>
                    @endif

                    <!-- Formulario Crear Comentario -->
                    <form action="{{ route('comments.store') }}" method="POST">
                        @csrf

                        <!-- Selección del Usuario y Proyecto en la misma fila -->
                        <div class="mb-3 flex space-x-4">
                            <!-- Selección del Usuario -->
                            <div class="flex-1">
                                <label for="user_id" class="block text-gray-700 dark:text-gray-300 font-medium">{{ __('Usuario') }}</label>
                                <select name="user_id" id="user_id" class="mt-1 block w-full p-3 border border-gray-300 dark:border-gray-600 rounded-md text-gray-900 dark:text-gray-200 bg-white dark:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-blue-400">
                                    <option value="">{{ __('Seleccione un usuario') }}</option>
                                    @foreach($users as $user)
                                        <option value="{{ $user->id }}" {{ old('user_id') == $user->id ? 'selected' : '' }}>
                                            {{ $user->name }} ({{ $user->email }})
                                        </option>
                                    @endforeach
                                </select>
                                @error('user_id')
                                <div class="text-red-600 text-sm mt-2">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Selección del Proyecto -->
                            <div class="flex-1">
                                <label for="project_id" class="block text-gray-700 dark:text-gray-300 font-medium">{{ __('Proyecto') }}</label>
                                <select name="project_id" id="project_id" class="mt-1 block w-full p-3 border border-gray-300 dark:border-gray-600 rounded-md text-gray-900 dark:text-gray-200 bg-white dark:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-blue-400">
                                    <option value="">{{ __('Seleccione un proyecto') }}</option>
                                    @foreach($projects as $project)
                                        <option value="{{ $project->id }}" {{ old('project_id') == $project->id ? 'selected' : '' }}>
                                            {{ $project->name }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('project_id')
                                <div class="text-red-600 text-sm mt-2">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <!-- Contenido del Comentario -->
                        <div class="mb-6">
                            <label for="content" class="block text-gray-700 dark:text-gray-300 font-medium">{{ __('Contenido') }}</label>
                            <textarea name="content" id="content" rows="4" class="mt-1 block w-full p-3 border border-gray-300 dark:border-gray-600 rounded-md text-gray-900 dark:text-gray-200 bg-white dark:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-blue-400">{{ old('content') }}</textarea>
                            @error('content')
                            <div class="text-red-600 text-sm mt-2">{{ $message }}</div>
                            @enderror
                        </div>


                        <!-- Contenedor para los botones -->
                        <div class="flex space-x-4">
                            <!-- Botón Regresar -->
                            <a href="{{ route('comments.index') }}" class="w-1/2 bg-blue-600 text-white py-3 px-6 rounded-md hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 text-center transition-all">
                                {{ __('REGRESAR') }}
                            </a>

                            <!-- Botón Crear Comentario -->
                            <button type="submit" class="w-1/2 bg-yellow-500 text-white py-3 px-6 rounded-md hover:bg-yellow-600 focus:outline-none focus:ring-2 focus:ring-yellow-500 text-center transition-all">
                                {{ __('CREAR') }}
                            </button>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

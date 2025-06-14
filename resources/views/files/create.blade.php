<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">

                    <!-- Título de la Sección -->
                    <div class="mb-6">
                        <h3 class="text-2xl font-semibold text-gray-900 dark:text-gray-100">{{ __('SUBIR ARCHIVO') }}</h3>
                        <p class="text-gray-600 dark:text-gray-300">{{ __('Selecciona un proyecto y adjunta el archivo correspondiente') }}</p>
                        <hr>
                    </div>

                    <!-- Mensaje de Éxito -->
                    @if(session('status'))
                        <div class="mb-4 p-4 bg-green-100 text-green-700 rounded">
                            {{ session('status') }}
                        </div>
                    @endif

                    <!-- Formulario Subir Archivo -->
                    <form action="{{ route('files.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf

                        <!-- Selección del Proyecto -->
                        <div class="mb-6">
                            <label for="project_id" class="block text-gray-700 dark:text-gray-300 font-medium">{{ __('Proyecto') }}</label>
                            <select name="project_id" id="project_id" class="mt-1 block w-full p-3 border border-gray-300 dark:border-gray-600 rounded-md text-gray-900 dark:text-gray-200 bg-white dark:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-blue-400">
                                <option value="">{{ __('Seleccionar proyecto') }}</option>
                                @foreach($projects as $project)
                                    <option value="{{ $project->id }}" {{ old('project_id') == $project->id ? 'selected' : '' }}>{{ $project->name }}</option>
                                @endforeach
                            </select>
                            @error('project_id')
                            <div class="text-red-600 text-sm mt-2">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Nombre del Archivo -->
                        <div class="mb-6">
                            <label for="name" class="block text-gray-700 dark:text-gray-300 font-medium">{{ __('Nombre del Archivo') }}</label>
                            <input type="text" name="name" id="name" value="{{ old('name') }}" class="mt-1 block w-full p-3 border border-gray-300 dark:border-gray-600 rounded-md text-gray-900 dark:text-gray-200 bg-white dark:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-blue-400">
                            @error('name')
                            <div class="text-red-600 text-sm mt-2">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Campo para Subir el Archivo -->
                        <div class="mb-6">
                            <label for="file" class="block text-gray-700 dark:text-gray-300 font-medium">{{ __('Archivo') }}</label>
                            <input type="file" name="file" id="file" class="mt-1 block w-full p-3 border border-gray-300 dark:border-gray-600 rounded-md text-gray-900 dark:text-gray-200 bg-white dark:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-blue-400">
                            @error('file')
                            <div class="text-red-600 text-sm mt-2">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Botones de Acción -->
                        <div class="flex space-x-4">
                            <!-- Botón Regresar -->
                            <a href="{{ route('projects.index') }}" class="w-1/2 bg-blue-600 text-white py-3 px-6 rounded-md hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 text-center transition-all">
                                {{ __('REGRESAR') }}
                            </a>

                            <!-- Botón Subir Archivo -->
                            <button type="submit" class="w-1/2 bg-yellow-500 text-white py-3 px-6 rounded-md hover:bg-yellow-600 focus:outline-none focus:ring-2 focus:ring-yellow-500 text-center transition-all">
                                {{ __('SUBIR ARCHIVO') }}
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

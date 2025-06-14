<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">

                    <!-- Título de la Sección -->
                    <div class="mb-6">
                        <h3 class="text-2xl font-semibold text-gray-900 dark:text-gray-100">{{ __('CREAR PROYECTO') }}</h3>
                        <p class="text-gray-600 dark:text-gray-300">{{ __('Registra la información completa del proyecto') }}</p>
                        <hr>
                    </div>

                    <!-- Mensaje de Éxito -->
                    @if(session('status'))
                        <div class="mb-4 p-4 bg-green-100 text-green-700 rounded">
                            {{ session('status') }}
                        </div>
                    @endif

                    <!-- Formulario Crear Proyecto -->
                    <form action="{{ route('projects.store') }}" method="POST">
                        @csrf

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                            <!-- Nombre del Proyecto -->
                            <div>
                                <label for="name" class="block text-gray-700 dark:text-gray-300 font-medium">{{ __('Nombre del Proyecto') }}</label>
                                <input type="text" name="name" id="name" value="{{ old('name') }}" class="mt-1 block w-full p-3 border border-gray-300 dark:border-gray-600 rounded-md text-gray-900 dark:text-gray-200 bg-white dark:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-blue-400">
                                @error('name')
                                <div class="text-red-600 text-sm mt-2">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Estado del Proyecto -->
                            <div>
                                <label for="status" class="block text-gray-700 dark:text-gray-300 font-medium">{{ __('Estado') }}</label>
                                <select name="status" id="status" class="mt-1 block w-full p-3 border border-gray-300 dark:border-gray-600 rounded-md text-gray-900 dark:text-gray-200 bg-white dark:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-blue-400">
                                    <option value="">{{ __('Seleccionar estado') }}</option>
                                    <option value="activo" {{ old('status') == 'activo' ? 'selected' : '' }}>{{ __('Activo') }}</option>
                                    <option value="completado" {{ old('status') == 'completado' ? 'selected' : '' }}>{{ __('Completado') }}</option>
                                </select>
                                @error('status')
                                <div class="text-red-600 text-sm mt-2">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                            <!-- Estudiante -->
                            <div>
                                <label for="student_id" class="block text-gray-700 dark:text-gray-300 font-medium">{{ __('Estudiante') }}</label>
                                <select name="student_id" id="student_id" class="mt-1 block w-full p-3 border border-gray-300 dark:border-gray-600 rounded-md text-gray-900 dark:text-gray-200 bg-white dark:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-blue-400">
                                    <option value="">{{ __('Seleccionar estudiante') }}</option>
                                    @foreach($students as $student)
                                        <option value="{{ $student->id }}" {{ old('student_id') == $student->id ? 'selected' : '' }}>{{ $student->name }} ({{ $student->email }})</option>
                                    @endforeach
                                </select>
                                @error('student_id')
                                <div class="text-red-600 text-sm mt-2">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Profesor -->
                            <div>
                                <label for="professor_id" class="block text-gray-700 dark:text-gray-300 font-medium">{{ __('Profesor') }}</label>
                                <select name="professor_id" id="professor_id" class="mt-1 block w-full p-3 border border-gray-300 dark:border-gray-600 rounded-md text-gray-900 dark:text-gray-200 bg-white dark:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-blue-400">
                                    <option value="">{{ __('Seleccionar profesor') }}</option>
                                    @foreach($professors as $professor)
                                        <option value="{{ $professor->id }}" {{ old('professor_id') == $professor->id ? 'selected' : '' }}>{{ $professor->name }} ({{ $professor->email }})</option>
                                    @endforeach
                                </select>
                                @error('professor_id')
                                <div class="text-red-600 text-sm mt-2">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <!-- Descripción del Proyecto -->
                        <div class="mb-6">
                            <label for="description" class="block text-gray-700 dark:text-gray-300 font-medium">{{ __('Descripción del Proyecto') }}</label>
                            <textarea name="description" id="description" rows="4" class="mt-1 block w-full p-3 border border-gray-300 dark:border-gray-600 rounded-md text-gray-900 dark:text-gray-200 bg-white dark:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-blue-400">{{ old('description') }}</textarea>
                            @error('description')
                            <div class="text-red-600 text-sm mt-2">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Contenedor para los botones -->
                        <div class="flex space-x-4">
                            <!-- Botón Regresar -->
                            <a href="{{ route('projects.index') }}" class="w-1/2 bg-blue-600 text-white py-3 px-6 rounded-md hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 text-center transition-all">
                                {{ __('REGRESAR') }}
                            </a>

                            <!-- Botón Crear Proyecto -->
                            <button type="submit" class="w-1/2 bg-yellow-500 text-white py-3 px-6 rounded-md hover:bg-yellow-600 focus:outline-none focus:ring-2 focus:ring-yellow-500 text-center transition-all">
                                {{ __('CREAR PROYECTO') }}
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

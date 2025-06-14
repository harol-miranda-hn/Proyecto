<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-lg sm:rounded-lg">
                <div class="p-6">
                    <!-- Título de la Sección -->
                    <div class="mb-6">
                        <h3 class="text-2xl font-semibold text-gray-900 dark:text-gray-100">{{ __('Detalles del Proyecto') }}</h3>
                        <p class="text-gray-600 dark:text-gray-300">{{ __('Información completa del proyecto seleccionado') }}</p>
                        <hr>
                    </div>

                    <!-- Información del Proyecto -->
                    <div class="space-y-4">
                        <!-- Nombre del Proyecto -->
                        <div class="flex items-center justify-between bg-gray-100 dark:bg-gray-700 p-4 rounded-md shadow-sm">
                            <span class="text-lg font-medium text-gray-700 dark:text-gray-300">{{ __('Nombre del Proyecto') }}: <strong>{{ $project->name }}</strong></span>
                        </div>

                        <!-- Descripción del Proyecto -->
                        <div class="flex flex-col bg-gray-100 dark:bg-gray-700 p-4 rounded-md shadow-sm">
                            <span class="text-lg font-medium text-gray-700 dark:text-gray-300">{{ __('Descripción') }}:</span>
                            <p class="mt-2 text-gray-700 dark:text-gray-300">{{ $project->description }}</p>
                        </div>

                        <!-- Estudiante -->
                        <div class="flex items-center justify-between bg-gray-100 dark:bg-gray-700 p-4 rounded-md shadow-sm">
                            <span class="text-lg font-medium text-gray-700 dark:text-gray-300">{{ __('Estudiante') }}: <strong>{{ $project->student->name }} ({{ $project->student->email }})</strong></span>
                        </div>

                        <!-- Profesor -->
                        <div class="flex items-center justify-between bg-gray-100 dark:bg-gray-700 p-4 rounded-md shadow-sm">
                            <span class="text-lg font-medium text-gray-700 dark:text-gray-300">{{ __('Profesor') }}: <strong>{{ $project->professor->name }} ({{ $project->professor->email }})</strong></span>
                        </div>

                        <!-- Estado del Proyecto -->
                        <div class="flex items-center justify-between bg-gray-100 dark:bg-gray-700 p-4 rounded-md shadow-sm">
                            <span class="text-lg font-medium text-gray-700 dark:text-gray-300">{{ __('Estado') }}: <strong><span class="px-3 py-1 rounded-full text-white
                                                {{ $project->status == 'activo' ? 'bg-green-500' : 'bg-blue-950' }}">
                                                {{ ucfirst($project->status) }}
                                            </span></strong></span>
                        </div>
                    </div>

                    <!-- Botón Volver -->
                    <div class="mt-6 text-right">
                        <a href="{{ route('projects.index') }}" class="bg-blue-600 text-white py-2 px-4 rounded-md hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500">
                            {{ __('REGRESAR') }}
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

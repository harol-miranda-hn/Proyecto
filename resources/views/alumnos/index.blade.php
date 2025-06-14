<x-app-layout>

    <div>
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-lg sm:rounded-lg">
                <div class="p-6 text-gray-900">

                    <!-- Mensaje de éxito (Toast) -->
                    @if(session('status'))
                        <div id="toast-message" class="fixed top-5 right-25 bg-green-500 text-white px-6 py-3 rounded-lg shadow-lg">
                            {{ session('status') }}
                        </div>
                    @endif

                    @if(session('error'))
                        <div id="toast-message" class="fixed top-1 right-5 bg-red-700 text-white px-6 py-3 rounded-lg shadow-lg">
                            {{ session('error') }}
                        </div>
                    @endif

                    <!-- Botón Agregar Alumno alineado a la derecha -->
                    <div class="mb-4 flex justify-end">
                        <a href="{{ route('alumnos.create') }}" class="inline-flex items-center bg-blue-600 text-white py-2 px-6 rounded-lg shadow-md hover:bg-blue-700 focus:outline-none transition ease-in-out duration-300 transform hover:scale-105">
                            <i class="mr-2 text-lg"></i> {{ __('Agregar alumno') }}
                        </a>
                    </div>

                    <!-- Tabla de Alumnos -->
                    <div class="overflow-x-auto bg-gray-50 shadow-md rounded-lg">

                        <!-- Tabla de Alumnos -->
                        <div class="overflow-x-auto bg-gray-50 shadow-md rounded-lg">
                            <table id="users-table" class="min-w-full text-sm text-left text-gray-600">
                                <thead class="text-xs text-gray-700 uppercase bg-gray-200 border-b">
                                <tr>
                                    <th class="px-3 sm:px-6 py-3 text-center whitespace-nowrap">Nombre</th>
                                    <th class="px-3 sm:px-6 py-3 text-center whitespace-nowrap">Grado</th>
                                    <th class="px-3 sm:px-6 py-3 text-center whitespace-nowrap">Teléfono</th>
                                    <th class="px-3 sm:px-6 py-3 text-center whitespace-nowrap">Acciones</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($alumnos as $alumno)
                                    <tr class="bg-white border-b hover:bg-gray-100 transition-colors duration-300">
                                        <td class="px-3 sm:px-6 py-4 text-center font-medium text-gray-900 whitespace-nowrap">
                                            {{ $alumno->nombre_completo }}
                                        </td>
                                        <td class="px-3 sm:px-6 py-4 text-center text-gray-700 whitespace-nowrap">
                                            <span class="inline-block bg-gray-300 text-gray-800 text-xs px-2 py-1 rounded-full">
                                                {{ $alumno->grado->nombre }} - Sección {{ $alumno->grado->seccion }}
                                            </span>
                                        </td>
                                        <td class="px-3 sm:px-6 py-4 text-center text-gray-700 whitespace-nowrap">
                                            {{ substr($alumno->telefono, 0, 4) . ' - ' . substr($alumno->telefono, 4, 4) }}
                                        </td>

                                        <td class="px-3 sm:px-6 py-4 text-center space-x-4 whitespace-nowrap">
                                            <a href="{{ route('alumnos.show', $alumno->id) }}" class="text-blue-600 hover:text-blue-800">
                                                <i class="fas fa-eye"></i>
                                            </a>
                                            <a href="{{ route('alumnos.edit', $alumno->id) }}" class="text-yellow-500 hover:text-yellow-700">
                                                <i class="fas fa-edit"></i>
                                            </a>
                                            <button class="text-red-600 hover:text-red-800 delete-btn" data-user-id="{{ $alumno->id }}">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>

                            <!-- Paginación -->
                            <div class="mt-6 mb-4 mr-4 ml-4">
                                {{ $alumnos->links('pagination::tailwind') }}
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal para Confirmar Eliminación -->
    <div id="confirm-delete-modal" class="fixed inset-0 flex justify-center items-center bg-black bg-opacity-50 hidden">
        <div class="bg-white p-6 rounded-lg shadow-lg w-96">
            <h3 class="text-lg font-semibold text-gray-700">{{ __('¿Estás seguro de que deseas eliminar este alumno?') }}</h3>
            <p class="mt-2 text-sm text-gray-600">{{ __('Esta acción no se puede deshacer.') }}</p>
            <div class="mt-4 flex justify-end space-x-4">
                <button id="cancel-delete" class="bg-gray-300 text-gray-700 px-4 py-2 rounded-md hover:bg-gray-400">
                    {{ __('Cancelar') }}
                </button>
                <form id="delete-form" method="POST" action="" class="inline-block">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="bg-red-600 text-white px-4 py-2 rounded-md hover:bg-red-700">
                        {{ __('Eliminar') }}
                    </button>
                </form>
            </div>
        </div>
    </div>

    <script>
        // Mostrar el Toast cuando hay un mensaje de éxito
        if (document.getElementById('toast-message')) {
            setTimeout(function() {
                document.getElementById('toast-message').classList.add('hidden');
            }, 3000); // 3 segundos
        }

        // Obtén los elementos relevantes para el modal
        const deleteButtons = document.querySelectorAll('.delete-btn');
        const modal = document.getElementById('confirm-delete-modal');
        const cancelButton = document.getElementById('cancel-delete');
        const deleteForm = document.getElementById('delete-form');

        // Mostrar el modal de confirmación
        deleteButtons.forEach(button => {
            button.addEventListener('click', function() {
                const userId = this.getAttribute('data-user-id');
                deleteForm.action = `/alumnos/${userId}`;  // Configura la acción del formulario para eliminar al alumno

                modal.classList.remove('hidden');
            });
        });

        // Cerrar el modal sin eliminar
        cancelButton.addEventListener('click', function() {
            modal.classList.add('hidden');
        });
    </script>
</x-app-layout>

<x-guest-layout>
    <div>
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-lg sm:rounded-lg">
                <div class="p-6 text-gray-900">

                    <!-- Título y formulario de búsqueda en línea con botón agregar -->
                    <div class="flex flex-wrap items-center justify-between gap-4 mb-4">
                        <h2 class="text-2xl font-bold">Grados / Secciones</h2>

                        <div class="flex flex-wrap items-center gap-2">
                            <!-- Formulario de búsqueda -->
                            <form method="GET" action="{{ route('grados.index') }}" class="flex items-center gap-2">
                                <input
                                    type="text"
                                    name="search"
                                    value="{{ request('search') }}"
                                    placeholder="Buscar grados"
                                    class="border border-gray-300 rounded-md px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-600"
                                />
                                <button
                                    type="submit"
                                    class="bg-blue-600 text-white px-4 py-2 rounded-md hover:bg-blue-700 transition"
                                >
                                    <i class="fas fa-search"></i>
                                </button>
                            </form>

                            <div class="flex items-center gap-2 ml-2">
                                    <!-- Botón Recargar -->
                                <button
                                    type="button"
                                    onclick="window.location.href='{{ route('grados.index') }}'"
                                    class="bg-blue-600 text-white px-4 py-2 rounded-md hover:bg-blue-700 transition"
                                    title="Recargar página"
                                >
                                    <i class="fas fa-sync-alt"></i>
                                </button>
                            </div>

                            <div class="flex items-center gap-2 ml-2">
                                <a href="{{ route('grados.create') }}" class="bg-blue-600 text-white px-4 py-2 rounded-md hover:bg-blue-700 transition" title="Agregar grado">
                                    <i class="fas fa-plus"></i>
                                </a>
                            </div>

                            <div class="flex items-center gap-2 ml-2">
                                <a href="{{ route('matriculas.create') }}" class="bg-blue-600 text-white px-4 py-2 rounded-md hover:bg-blue-700 transition" title="Agregar grado">
                                    Matricular
                                </a>
                            </div>

                        </div>
                    </div>

                    <!-- Tabla de grados -->
                    <div class="overflow-x-auto bg-gray-50 shadow-md rounded-lg">
                        <table class="min-w-full text-sm text-left text-gray-600">
                            <thead class="text-xs text-gray-700 uppercase bg-gray-200 border-b">
                            <tr>
                                <th class="px-4 py-3 text-center">Curso</th>
                                <th class="px-4 py-3 text-center">Modalidad</th>
                                <th class="px-4 py-3 text-center">Sección</th>
                                <th class="px-4 py-3 text-center">Jornada</th>
                                <th class="px-4 py-3 text-center">Alumnos matriculados</th>
                                <th class="px-3 sm:px-6 py-3 text-center whitespace-nowrap">Acciones</th>
                            </tr>
                            </thead>
                            <tbody>
                            @forelse ($grados as $grado)
                                <tr class="bg-white border-b hover:bg-gray-100 transition">
                                    <td class="px-3 sm:px-6 py-4 text-left font-medium text-gray-900 whitespace-nowrap">{{ $grado->curso }}</td>
                                    <td class="px-3 sm:px-6 py-4 text-left font-medium text-gray-900 whitespace-nowrap">{{ $grado->modalidad }}</td>
                                    <td class="px-3 sm:px-6 py-4 text-center font-medium text-gray-900 whitespace-nowrap">{{ $grado->seccion }}</td>
                                    <td class="px-3 sm:px-6 py-4 text-center font-medium text-gray-900 whitespace-nowrap">{{ $grado->jornada }}</td>
                                    <td class="px-3 sm:px-6 py-4 text-center font-medium text-gray-900 whitespace-nowrap">{{ $grado->matricula }}</td>
                                    <td class="px-3 sm:px-6 py-4 text-center whitespace-nowrap">
                                        <div class="flex justify-center items-center space-x-4">
                                            <a href="{{ route('grados.show', $grado->id) }}" class="text-blue-600 hover:text-blue-800" title="Ver">
                                                <i class="fas fa-eye"></i>
                                            </a>
                                            <a href="{{ route('grados.edit', $grado->id) }}" class="text-yellow-500 hover:text-yellow-700" title="Editar">
                                                <i class="fas fa-edit"></i>
                                            </a>
                                            <button class="text-red-600 hover:text-red-800 delete-btn" data-user-id="{{ $grado->id }}" title="Eliminar">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="text-center py-4 text-gray-500">No se encontraron grados.</td>
                                </tr>
                            @endforelse
                            </tbody>
                        </table>
                    </div>

                    <!-- Paginación -->
                    <div class="mt-6 mb-4 mr-4 ml-4">
                        {{ $grados->links('pagination::tailwind') }}
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal para Confirmar Eliminación -->
    <div id="confirm-delete-modal" class="fixed inset-0 flex justify-center items-center bg-black bg-opacity-50 hidden">
        <div class="bg-white p-6 rounded-lg shadow-lg w-96">
            <h3 class="text-lg font-semibold text-gray-700">{{ __('¿Estás seguro de que deseas eliminar este grado?') }}</h3>
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
        const deleteButtons = document.querySelectorAll('.delete-btn');
        const modal = document.getElementById('confirm-delete-modal');
        const cancelButton = document.getElementById('cancel-delete');
        const deleteForm = document.getElementById('delete-form');

        deleteButtons.forEach(button => {
            button.addEventListener('click', function() {
                const userId = this.getAttribute('data-user-id');
                deleteForm.action = `/grados/${userId}`; // Ajusta la ruta según tu configuración
                modal.classList.remove('hidden');
            });
        });

        cancelButton.addEventListener('click', function() {
            modal.classList.add('hidden');
        });
    </script>
</x-guest-layout>

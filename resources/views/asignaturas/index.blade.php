<x-guest-layout>
    <div>
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-lg sm:rounded-lg">
                <div class="p-6 text-gray-900">

                    <!-- Toasts -->
                    @if(session('status'))
                        <div id="toast-message" class="fixed top-5 right-5 bg-green-500 text-white px-6 py-3 rounded-lg shadow-lg">
                            {{ session('status') }}
                        </div>
                    @endif

                    @if(session('error'))
                        <div id="toast-message" class="fixed top-5 right-5 bg-red-700 text-white px-6 py-3 rounded-lg shadow-lg">
                            {{ session('error') }}
                        </div>
                    @endif

                    <!-- Título y acciones -->
                    <div class="flex flex-wrap items-center justify-between gap-4 mb-4">
                        <h2 class="text-2xl font-bold">Asignaturas</h2>

                        <div class="flex flex-wrap items-center gap-2">
                            <!-- Búsqueda -->
                            <form method="GET" action="{{ route('asignaturas.index') }}" class="flex items-center gap-2">
                                <input type="text" name="search" value="{{ request('search') }}" placeholder="Buscar asignaturas"
                                       class="border border-gray-300 rounded-md px-4 py-2 w-64 focus:outline-none focus:ring-2 focus:ring-blue-600" />
                                <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded-md hover:bg-blue-700 transition">
                                    <i class="fas fa-search"></i>
                                </button>
                            </form>

                            <!-- Recargar -->
                            <button type="button"
                                    onclick="window.location.href='{{ route('asignaturas.index') }}'"
                                    class="bg-blue-600 text-white px-4 py-2 rounded-md hover:bg-blue-700 transition"
                                    title="Recargar página">
                                <i class="fas fa-sync-alt"></i>
                            </button>

                            <!-- Crear -->
                            <a href="{{ route('asignaturas.create') }}"
                               class="bg-blue-600 text-white px-4 py-2 rounded-md hover:bg-blue-700 transition"
                               title="Agregar asignatura">
                                <i class="fas fa-plus"></i>
                            </a>
                        </div>
                    </div>

                    <!-- Tabla -->
                    <div class="overflow-x-auto bg-gray-50 shadow-md rounded-lg">
                        <table class="min-w-full text-sm text-left text-gray-600">
                            <thead class="text-xs text-gray-700 uppercase bg-gray-200 border-b">
                            <tr>
                                <th class="px-6 py-3 text-center">N°</th>
                                <th class="px-6 py-3 text-center">Nombre</th>
                                <th class="px-6 py-3 text-center">Acciones</th>
                            </tr>
                            </thead>
                            <tbody>
                            @forelse($asignaturas as $index => $asignatura)
                                <tr class="bg-white border-b hover:bg-gray-100 transition-colors duration-300">
                                    <td class="px-4 py-3 text-center">{{ $asignaturas->firstItem() + $index }}</td>
                                    <td class="px-6 py-4 text-left font-medium text-gray-900">
                                        {{ $asignatura->nombre }}
                                    </td>
                                    <td class="px-6 py-4 text-center whitespace-nowrap">
                                        <div class="flex justify-center items-center space-x-4">
                                            <a href="{{ route('asignaturas.show', $asignatura) }}" class="text-blue-600 hover:text-blue-800" title="Ver">
                                                <i class="fas fa-eye"></i>
                                            </a>
                                            <a href="{{ route('asignaturas.edit', $asignatura) }}" class="text-yellow-500 hover:text-yellow-700" title="Editar">
                                                <i class="fas fa-edit"></i>
                                            </a>
                                            <button class="text-red-600 hover:text-red-800 delete-btn" data-id="{{ $asignatura->id }}" title="Eliminar">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="2" class="text-center py-4 text-gray-500">
                                        No se encontraron asignaturas.
                                    </td>
                                </tr>
                            @endforelse
                            </tbody>
                        </table>
                    </div>
                    <!-- Paginación -->
                    <div class="mt-6 mb-4 mr-4 ml-4">
                        {{ $asignaturas->links('pagination::tailwind') }}
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal eliminación -->
    <div id="confirm-delete-modal" class="fixed inset-0 flex justify-center items-center bg-black bg-opacity-50 hidden">
        <div class="bg-white p-6 rounded-lg shadow-lg w-96">
            <h3 class="text-lg font-semibold text-gray-700">¿Eliminar esta asignatura?</h3>
            <p class="mt-2 text-sm text-gray-600">Esta acción no se puede deshacer.</p>
            <div class="mt-4 flex justify-end space-x-4">
                <button id="cancel-delete" class="bg-gray-300 text-gray-700 px-4 py-2 rounded-md hover:bg-gray-400">
                    Cancelar
                </button>
                <form id="delete-form" method="POST" action="">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="bg-red-600 text-white px-4 py-2 rounded-md hover:bg-red-700">
                        Eliminar
                    </button>
                </form>
            </div>
        </div>
    </div>

    <script>
        // Ocultar toast
        if (document.getElementById('toast-message')) {
            setTimeout(() => {
                document.getElementById('toast-message').classList.add('hidden');
            }, 3000);
        }

        // Modal de eliminación
        const deleteButtons = document.querySelectorAll('.delete-btn');
        const modal = document.getElementById('confirm-delete-modal');
        const cancelButton = document.getElementById('cancel-delete');
        const deleteForm = document.getElementById('delete-form');

        deleteButtons.forEach(button => {
            button.addEventListener('click', function () {
                const id = this.getAttribute('data-id');
                deleteForm.action = `/asignaturas/${id}`;
                modal.classList.remove('hidden');
            });
        });

        cancelButton.addEventListener('click', function () {
            modal.classList.add('hidden');
        });
    </script>
</x-guest-layout>

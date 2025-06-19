<x-app-layout>
    <div class="max-w-3xl mx-auto py-10 sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-6">
            <h2 class="text-xl font-bold mb-6 text-gray-900">
                Asignar Asignaturas al Grado:
                <span class="text-blue-600">{{ $grado->curso }} - Sección {{ $grado->seccion }} ({{ $grado->jornada }})</span>
            </h2>

            <form method="POST" action="{{ route('grados.asignaturas.update', $grado->id) }}">
                @csrf
                @method('PUT')

                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 mb-6">
                    @foreach($asignaturas as $asignatura)
                        <label class="flex items-center space-x-2">
                            <input
                                type="checkbox"
                                name="asignaturas[]"
                                value="{{ $asignatura->id }}"
                                @if($grado->asignaturas->contains($asignatura->id)) checked @endif
                                class="text-blue-600 focus:ring-blue-500"
                            >
                            <span>{{ $asignatura->nombre }}</span>
                        </label>
                    @endforeach
                </div>

                <div class="flex justify-end space-x-3">
                    <a href="{{ route('asignaciones.index') }}"
                       class="bg-gray-300 text-gray-800 px-4 py-2 rounded hover:bg-gray-400">
                        Cancelar
                    </a>
                    <button type="submit"
                            class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">
                        Guardar Asignaciones
                    </button>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>

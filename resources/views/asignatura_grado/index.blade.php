<x-guest-layout>
    <div class="max-w-7xl mx-auto py-10 sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-6">
            <h2 class="text-2xl font-bold mb-6 text-gray-900">Asignaturas por Grado</h2>

            <!-- Grid 2x2 Fijo -->
            <div class="grid grid-cols-2 gap-6">  <!-- Cambio clave aquí -->
                @foreach($grados as $grado)
                    <div class="border border-gray-300 rounded-md p-4 shadow hover:shadow-md transition duration-300">
                        <div class="flex justify-between items-center mb-2">
                            <h3 class="text-lg font-semibold text-blue-700">
                                {{ $grado->curso }} - {{ $grado->modalidad }} - Sección {{ $grado->seccion }} ({{ $grado->jornada }})
                            </h3>
                            <a href="{{ route('grados.asignaturas.edit', $grado->id) }}"
                               class="text-sm bg-blue-600 text-white px-3 py-1 rounded hover:bg-blue-700 transition">
                                Asignar
                            </a>
                        </div>

                        @if($grado->asignaturas->isEmpty())
                            <p class="text-gray-600 italic">No hay asignaturas asignadas a este grado.</p>
                        @else
                            <ul class="list-disc list-inside text-gray-800">
                                @foreach($grado->asignaturas as $asignatura)
                                    <li>{{ $asignatura->nombre }}</li>
                                @endforeach
                            </ul>
                        @endif
                    </div>
                @endforeach
            </div>
        </div>
        <!-- Paginación -->
        <div class="mt-8">
            {{ $grados->links('pagination::tailwind') }}
        </div>
    </div>
</x-guest-layout>

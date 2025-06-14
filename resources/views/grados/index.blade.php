<x-app-layout>
    <div>
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-lg sm:rounded-lg">
                <div class="p-6 text-gray-900">

                    <h2 class="text-2xl font-bold mb-4">Grados y secciones</h2>

                    <div class="overflow-x-auto bg-gray-50 shadow-md rounded-lg">
                        <table class="min-w-full text-sm text-left text-gray-600">
                            <thead class="text-xs text-gray-700 uppercase bg-gray-200 border-b">
                            <tr>
                                <th class="px-4 py-3 text-center">Grado</th>
                                <th class="px-4 py-3 text-center">Sección</th>
                                <th class="px-4 py-3 text-center">Jornada</th>
                                <th class="px-4 py-3 text-center">Alumnos Matriculados</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach ($grados as $nombreGrado => $secciones)
                                @foreach ($secciones as $grado)
                                    <tr class="bg-white border-b hover:bg-gray-100 transition">
                                        <td class="px-4 py-4 text-center">
                                            {{ $nombreGrado }}
                                        </td>
                                        <td class="px-4 py-4 text-center">
                                            {{ $grado->seccion }}
                                        </td>
                                        <td class="px-4 py-4 text-center">
                                            {{ $grado->jornada }}
                                        </td>
                                        <td class="px-4 py-4 text-center">
                                            {{ $grado->alumnos_count }}
                                        </td>
                                    </tr>
                                @endforeach
                            @endforeach
                            </tbody>
                        </table>
                    </div>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>

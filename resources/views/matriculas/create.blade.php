<x-app-layout>
    <div class="max-w-4xl mx-auto mt-10 bg-white shadow-lg rounded-lg p-6">
        <h2 class="text-2xl font-bold mb-4">Nueva Matrícula</h2>

        @if(session('status'))
            <div class="bg-green-500 text-white px-4 py-3 rounded mb-4">
                {{ session('status') }}
            </div>
        @endif

        <form action="{{ route('matriculas.store') }}" method="POST">
            @csrf

            <!-- Alumno -->
            <div class="mb-4">
                <label class="block mb-2 font-semibold">Alumno</label>
                <select name="alumno_id" class="w-full border rounded px-3 py-2">
                    <option value="">Seleccione un alumno</option>
                    @foreach($alumnos as $alumno)
                        <option value="{{ $alumno->id }}">{{ $alumno->nombre_completo }}</option>
                    @endforeach
                </select>
                @error('alumno_id')
                <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
            </div>

            <!-- Grado -->
            <div class="mb-4">
                <label class="block mb-2 font-semibold">Grado</label>
                <select name="grado_id" class="w-full border rounded px-3 py-2">
                    <option value="">Seleccione un grado</option>
                    @foreach($grados as $grado)
                        <option value="{{ $grado->id }}">
                            {{ $grado->curso }} de {{ $grado->modalidad }} -  sección {{ $grado->seccion }} ({{ $grado->jornada }})
                        </option>
                    @endforeach

                </select>
                @error('grado_id')
                <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
            </div>

            <!-- Fecha -->
            <div class="mb-4">
                <label class="block mb-2 font-semibold">Fecha de Matrícula</label>
                <input type="date" name="fecha_matricula" value="{{ old('fecha_matricula', date('Y-m-d')) }}" class="w-full border rounded px-3 py-2">
                @error('fecha_matricula')
                <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
            </div>

            <!-- Botón -->
            <div class="mt-6">
                <button class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">
                    Matricular Alumno
                </button>
            </div>
        </form>
    </div>
</x-app-layout>

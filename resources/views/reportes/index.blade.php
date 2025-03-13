<x-app-layout>
    <body class="bg-gray-100 p-8">
        <div class="max-w-6xl mx-auto">
            <div class="flex justify-between items-center mb-6">
                <h1 class="text-3xl font-bold text-blue-600 text-center">Reportes de Evaluación 5S</h1>
            </div>

            <!-- Contenedor del formulario y el botón de regresar -->
            <div class="mb-6 flex items-center justify-between w-full">
                <!-- Formulario de selección de semana -->
                <div class="flex items-center gap-4">
                    <label for="semana" class="text-lg font-semibold">Seleccionar Semana:</label>
                    <select name="semana" id="semana" class="border p-2 rounded-md">
                        <option value="">Selecciona una semana</option>
                        @foreach ($semanas as $index => $semana)
                            <option value="{{ $index + 1 }}" {{ request('semana') == $index + 1 ? 'selected' : '' }}>
                                {{ $semana['nombre'] }} ({{ $semana['fecha_inicio'] }} - {{ $semana['fecha_fin'] }})
                            </option>
                        @endforeach
                    </select>
                </div>
                
                <!-- Botón de regresar alineado a la derecha -->
                <a href="{{ route('welcome') }}" class="bg-green-500 text-white px-6 py-2 rounded-md text-lg hover:bg-green-600 transition">
                    Regresar
                </a>
            </div>

            <!-- Contenedor de resultados (oculto inicialmente) -->
            <div id="resultados" class="bg-white shadow-md rounded-lg p-6 {{ request('semana') ? '' : 'hidden' }}">
                <h2 class="text-xl font-semibold text-gray-700 mb-4">Resultados por Semana</h2>

                <div class="grid grid-cols-2 md:grid-cols-3 gap-4 text-center">
                    <div class="bg-blue-500 text-white p-4 rounded-lg">
                        <p class="text-lg font-semibold">Total Evaluaciones</p>
                        <p class="text-2xl font-bold">{{ $totalEvaluaciones }}</p>
                    </div>
                    <div class="bg-green-500 text-white p-4 rounded-lg">
                        <p class="text-lg font-semibold">Cumplió</p>
                        <p class="text-2xl font-bold">{{ $totalCumplio }}</p>
                        <p class="text-sm">{{ $porcentajeCumplio }}%</p>
                    </div>
                    <div class="bg-red-500 text-white p-4 rounded-lg">
                        <p class="text-lg font-semibold">No Cumplió</p>
                        <p class="text-2xl font-bold">{{ $totalNoCumplio }}</p>
                        <p class="text-sm">{{ $porcentajeNoCumplio }}%</p>
                    </div>
                </div>

                <h2 class="text-xl font-semibold text-gray-700 mt-6 mb-4">Empleados</h2>
                <table class="w-full border-collapse border">
                    <thead>
                        <tr class="bg-gray-200">
                            <th class="px-4 py-2 border">Empleado</th>
                            <th class="px-4 py-2 border">Cumplió</th>
                            <th class="px-4 py-2 border">No Cumplió</th>
                            <th class="px-4 py-2 border">Cumplimiento (%)</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($empleados as $empleado)
                            <tr class="text-center">
                                <td class="px-4 py-2 border">{{ $empleado->name }}</td>
                                <td class="px-4 py-2 border">{{ $empleado->cumplio_count }}</td>
                                <td class="px-4 py-2 border">{{ $empleado->no_cumplio_count }}</td>
                                <td class="px-4 py-2 border">
                                    {{ $empleado->cumplio_count + $empleado->no_cumplio_count > 0 ? round(($empleado->cumplio_count / ($empleado->cumplio_count + $empleado->no_cumplio_count)) * 100, 2) : 0 }}%
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>

                <h2 class="text-xl font-semibold text-gray-700 mt-6 mb-4">Empleado Menos Cumplidor</h2>
                <p class="text-lg text-center text-purple-700 font-bold">{{ $empleadoMenosCumplio->name ?? 'No hay empleados evaluados' }}</p>

                @if ($estrategias)
                    <h2 class="text-xl font-semibold text-gray-700 mt-6 mb-4">Estrategias de Mejora</h2>
                    <p class="text-lg text-center text-red-700">{{ $estrategias }}</p>
                @endif

                <!-- Botón para exportar a Excel -->
                <div class="mt-6 text-center">
                    <a href="{{ route('reportes.export') }}" 
                    class="bg-purple-500 text-white px-6 py-3 rounded-lg shadow-md hover:bg-purple-600 transition duration-300">
                        Exportar a Excel
                    </a>
                </div>
            </div>
        </div>

        <script>
            document.getElementById('semana').addEventListener('change', function() {
                if (this.value) {
                    window.location.href = `?semana=${this.value}`;
                }
            });
        </script>
    </body>
</x-app-layout>

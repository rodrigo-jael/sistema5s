<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="bg-white dark:bg-gray-800 leading-tight">Reportes de Evaluación 5S</h2>
            <a href="{{ route('welcome') }}" class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded">
                ← Regresar
            </a>
        </div>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-xl sm:rounded-lg p-6">
                
                <!-- Formulario de selección de semana -->
                <div class="mb-6 flex justify-center">
                    <div class=" bg-white dark:bg-gray-800 flex items-center gap-4">
                        <label for="semana" class="text-lg font-semibold ">Seleccionar Semana:</label>
                        <select name="semana" id="semana" class="border p-2 rounded-md">
                            <option value="">Selecciona una semana</option>
                            @foreach ($semanas as $index => $semana)
                                <option value="{{ $index + 1 }}" {{ request('semana') == $index + 1 ? 'selected' : '' }}>
                                    {{ $semana['nombre'] }} ({{ $semana['fecha_inicio'] }} - {{ $semana['fecha_fin'] }})
                                </option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <!-- Resultados -->
                <div id="resultados" class="bg-white dark:bg-gray-800  shadow-md rounded-lg p-6 {{ request('semana') ? '' : 'hidden' }}">
                    <h2 class="bg-white dark:bg-gray-800  mb-4 text-center">Resultados por Semana</h2>

                    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-6 text-center">
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

                    <!-- Tabla de empleados -->
                    <h2 class="bg-white dark:bg-gray-800  mt-6 mb-4 text-center">Empleados</h2>
                    <div class="overflow-x-auto">
                        <table class="w-full border-collapse border text-center">
                            <thead>
                                <tr class="bg-white dark:bg-gray-800 ">
                                    <th class="px-4 py-2 border">Empleado</th>
                                    <th class="px-4 py-2 border">Cumplió</th>
                                    <th class="px-4 py-2 border">No Cumplió</th>
                                    <th class="px-4 py-2 border">Cumplimiento (%)</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($empleados as $empleado)
                                    <tr>
                                        <td class="px-4 py-2 border">{{ $empleado->name }}</td>
                                        <td class="px-4 py-2 border">{{ $empleado->cumplio_count }}</td>
                                        <td class="px-4 py-2 border">{{ $empleado->no_cumplio_count }}</td>
                                        <td class="px-4 py-2 border">
                                            {{ $empleado->cumplio_count + $empleado->no_cumplio_count > 0 
                                                ? round(($empleado->cumplio_count / ($empleado->cumplio_count + $empleado->no_cumplio_count)) * 100, 2) 
                                                : 0 }}%
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                    <!-- Empleado menos cumplidor -->
                    <h2 class="bg-white dark:bg-gray-800  mt-6 mb-4 text-center">Empleado Menos Cumplidor</h2>
                    <p class="text-lg text-center text-purple-700 font-bold">{{ $empleadoMenosCumplio->name ?? 'No hay empleados evaluados' }}</p>

                    <!-- Estrategias de mejora -->
                    @if ($estrategias)
                        <h2 class="bg-white dark:bg-gray-800  mt-6 mb-4 text-center">Estrategias de Mejora</h2>
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
        </div>
    </div>

    <script>
        document.getElementById('semana').addEventListener('change', function() {
            if (this.value) {
                window.location.href = `?semana=${this.value}`;
            }
        });
    </script>
</x-app-layout>

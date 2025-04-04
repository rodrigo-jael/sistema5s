<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Historial Bimestral de Consumo y Huella de Carbono
            </h2>
            <a href="{{ route('luz.index') }}" class="bg-[#D5AC5B] text-black font-bold py-2 px-4 rounded">
                ←Regresar
            </a>
        </div>
    </x-slot>

    <div class="container mx-auto p-6">
        <div x-data="{ open: false }"> <!-- Ahora este div envuelve el botón y el modal -->
            <!-- Título y botón para abrir el modal -->
            <div class="flex justify-between items-center mb-4">
                <h1 class="text-2xl font-bold" style="color: #D5AC5B;">
                    Reportes Bimestrales de Huella de Carbono
                </h1>

                <!-- Botón para abrir el modal -->
                <button @click="open = true" class="bg-yellow-600 text-white px-6 py-3 rounded-md hover:bg-yellow-700 transition">
                    Registrar Nuevo Reporte
                </button>
            </div>

            <!-- Modal -->
            <div x-show="open" class="fixed inset-0 flex items-center justify-center bg-gray-900 bg-opacity-50 z-50">
                <div class="bg-white p-6 rounded-md shadow-md w-1/2">
                    <h2 class="text-xl font-bold mb-4" style="color: #D5AC5B;">
                        Registrar Nuevo Consumo Bimestral
                    </h2>

                    <!-- Formulario dentro del modal -->
                    <form action="{{ route('consumoenergia.store') }}" method="POST">
                        @csrf
                        
                        <!-- Fecha -->
                        <div>
                            <label class="block text-gray-700">Fecha de Registro:</label>
                            <input type="date" name="fecha" required class="w-full p-2 border rounded">
                        </div>
                        <div class="grid grid-cols-2 gap-4">
                            <!-- Fecha de inicio -->
                            <div>
                                <label class="block text-gray-700">Fecha de inicio del periodo:</label>
                                <input type="date" name="fecha_inicio" required class="w-full p-2 border rounded">
                            </div>

                            <!-- Fecha de fin -->
                            <div>
                                <label class="block text-gray-700">Fecha de fin del periodo:</label>
                                <input type="date" name="fecha_fin" required class="w-full p-2 border rounded">
                            </div>

                            <!-- Consumo de energía -->
                            <div>
                                <label class="block text-gray-700">Consumo (kWh):</label>
                                <input type="number" name="kwh_consumidos" step="0.01" required class="w-full p-2 border rounded">
                            </div>
                        </div>

                        <!-- Botones en el modal -->
                        <div class="flex justify-between w-full mt-4">
                            <button type="button" @click="open = false" class="bg-red-500 text-white px-4 py-2 rounded-md hover:bg-red-700 transition w-1/3">
                                Cancelar
                            </button>
                            <button type="submit" class="bg-green-600 text-white px-6 py-2 rounded-md hover:bg-green-700 transition w-1/3">
                                Guardar Registro
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <!-- Tabla de registros -->
        <table class="w-full bg-white shadow-md rounded">
            <thead style="background-color: #D5AC5B; color: white;">
                <tr>
                    <th class="p-2">fecha_inicio</th>
                    <th class="p-2">fecha_fin</th>
                    <th class="p-2">Mes</th>
                    <th class="p-2">Consumo (kWh)</th>
                    <th class="p-2">Huella de Carbono (Kg CO₂)</th>
                    <th class="p-2">Acciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($consumos as $consumo)
                @php
                    // Calcular bimestre a partir del mes
                    $mes = $consumo->mes;
                    $bimestre = match($mes) {
                        'Enero', 'Febrero' => 'Enero - Febrero',
                        'Marzo', 'Abril' => 'Marzo - Abril',
                        'Mayo', 'Junio' => 'Mayo - Junio',
                        'Julio', 'Agosto' => 'Julio - Agosto',
                        'Septiembre', 'Octubre' => 'Septiembre - Octubre',
                        'Noviembre', 'Diciembre' => 'Noviembre - Diciembre',
                        default => 'Desconocido'
                    };
                @endphp
                <tr class="border-b">
                    <td class="p-2">{{ $consumo->fecha_inicio }}</td>
                    <td class="p2">{{ $consumo->fecha_fin}}</td>
                    <td class="p2">{{$consumo->mes}}</td>
                    <td class="p-2">{{ $consumo->kwh_consumidos }}</td>
                    <td class="p-2">
                        {{ number_format($consumo->kwh_consumidos * 0.455, 2) }} {{-- Factor CO2 --}}
                    </td>
                    <td class="p-2 flex justify-center">
                        @if($consumo->pdf_recibo)
                            <a href="{{ route('consumoenergia.descargarRecibo', $consumo->id) }}" 
                               class="text-white px-3 py-1 rounded-md hover:bg-blue-600" style="background-color: #D5AC5B;">
                                Descargar PDF
                            </a>
                        @else
                            <form action="{{ route('consumoenergia.subirRecibo', $consumo->id) }}" method="POST" enctype="multipart/form-data" class="flex">
                                @csrf
                                <input type="file" name="pdf_recibo" accept="application/pdf" required class="mr-2">
                                <button type="submit" class="text-white px-3 py-1 rounded-md hover:bg-yellow-600" style="background-color: #D5AC5B;">
                                    Subir PDF
                                </button>
                            </form>
                        @endif
                    </td>
                </tr>
                @endforeach

                <!-- Fila de Total General -->
                <tr class="bg-gray-200 font-bold">
                    <td class="p-2 text-center" colspan="2">Total General</td>
                    <td class="p-2 text-center">{{ $totalConsumoGeneral }} kWh</td>
                    <td class="p-2 text-center">{{ number_format($totalConsumoGeneral * 0.455, 2) }} Kg CO₂</td>
                    <td class="p-2"></td>
                </tr>
            </tbody>
        </table>
    </div>
</x-app-layout>

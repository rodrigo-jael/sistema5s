<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">Reporte del consumo de agua</h2>
            <a href="{{ route('consumo_agua.index') }}" class="bg-[#D5AC5B] text-black font-bold py-2 px-4 rounded">
                ← Regresar
            </a>
        </div>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-6">
                <h3 class="text-lg font-bold mb-4">Análisis del Consumo de Agua</h3>

                <!-- Mostrar errores si existen -->
                @if (session('error'))
                    <div class="bg-red-500 text-white p-3 rounded mb-4">
                        {{ session('error') }}
                    </div>
                @endif

                @if(isset($periodos) && count($periodos) > 0)
                    <h2 class="text-xl font-bold mt-4">
                        Análisis del Consumo de Agua ({{ $periodoInicio->format('d/m/Y') }} - {{ $periodoFin->format('d/m/Y') }})
                    </h2>

                    <p class="mb-2">
                        Promedio de consumo en el periodo seleccionado: 
                        <strong>{{ number_format($promedioConsumo, 2) }} L</strong>
                    </p>

                    @isset($huellaTotalCarbono)
                        <p class="mb-4">
                            🌍 Huella de Carbono Total del Periodo: 
                            <span class="font-bold text-green-700">{{ number_format($huellaTotalCarbono, 4) }} kg CO₂</span>
                        </p>
                    @endisset

                    <div class="overflow-x-auto">
                        <table class="w-full table-auto border-collapse border border-gray-300 text-sm">
                            <thead>
                                <tr class="bg-[#D5AC5B] text-center text-white">
                                    <th class="border border-gray-300 px-4 py-2">Fecha</th>
                                    <th class="border border-gray-300 px-4 py-2">Litros Utilizados</th>
                                    <th class="border border-gray-300 px-4 py-2">Estado</th>
                                    <th class="border border-gray-300 px-4 py-2">Huella de Carbono (kg CO₂)</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($periodos as $periodo)
                                    <tr class="{{ $periodo['es_sobre_promedio'] ? 'bg-red-200' : 'bg-green-200' }}">
                                        <td class="border border-gray-300 px-4 py-2 text-center">
                                            {{ \Carbon\Carbon::parse($periodo['fecha'])->format('d/m/Y') }}
                                        </td>
                                        <td class="border border-gray-300 px-4 py-2 font-bold text-center">
                                            {{ number_format($periodo['litros_utilizados'], 2) }} L
                                        </td>
                                        <td class="border border-gray-300 px-4 py-2 text-center">
                                            <span class="font-bold {{ $periodo['es_sobre_promedio'] ? 'text-red-600' : 'text-green-600' }}">
                                                {{ $periodo['es_sobre_promedio'] ? 'Sobre Promedio' : 'Dentro del Promedio' }}
                                            </span>
                                        </td>
                                        <td class="border border-gray-300 px-4 py-2 text-center">
                                            {{ number_format($periodo['litros_utilizados'] * 0.000298, 4) }} kg CO₂
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @else
                    <p class="text-gray-600 mt-4">No hay registros disponibles para el periodo seleccionado.</p>
                @endif
            </div>
        </div>
    </div>
</x-app-layout>

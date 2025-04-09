<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="bg-white dark:bg-gray-800 leading-tight">Control Vehicular</h2>
            <a href="{{ route('vehicular.index') }}" class="bg-[#D5AC5B] text-black font-bold py-2 px-4 rounded">
                ← Regresar
            </a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8 w-full">
            <div class="bg-white dark:bg-gray-700 overflow-hidden shadow-sm sm:rounded-lg p-6">
                <h2 class="text-2xl font-bold mb-4">Lista de Vehículos</h2>

                @if (session('success'))
                    <div class="bg-green-500 text-white p-4 rounded-md mb-4">
                        {{ session('success') }}
                    </div>
                @endif

                <div class="mt-6 overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-600">
                        <thead class="bg-[#D5AC5B] dark:bg-gray-700">
                            <tr>
                                <th class="px-4 py-2 text-left text-sm font-semibold text-white-700">Vehículo</th>
                                <th class="px-4 py-2 text-left text-sm font-semibold text-white-700">Placa</th>
                                <th class="px-4 py-2 text-left text-sm font-semibold text-white-700">Acciones</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white dark:bg-gray-700 divide-y divide-gray-200 dark:divide-gray-600">
                            @foreach ($vehiculos as $vehiculo)
                                <tr>
                                    <td class="px-4 py-2">{{ $vehiculo->nombre }}</td>
                                    <td class="px-4 py-2">{{ $vehiculo->placa }}</td>
                                    <td class="px-4 py-2">
                                        <div class="flex space-x-2">
                                            <a href="{{ route('inspeccion.create', ['vehiculo_id' => $vehiculo->id]) }}"
                                               class="bg-blue-500 text-white text-sm px-3 py-1.5 rounded hover:bg-blue-600 transition">
                                               Hacer inspección
                                            </a>

                                            <a href="{{ route('vehiculo.inspecciones', $vehiculo->id) }}" 
                                               class="bg-green-600 text-white text-sm px-3 py-1.5 rounded hover:bg-green-700 transition">
                                               Ver Inspecciones
                                            </a>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
